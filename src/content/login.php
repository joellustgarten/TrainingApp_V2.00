<?php

require_once('config.php'); // Include the database connection and session handling

// Error handling configuration
error_reporting(E_ALL); // Report all PHP errors
ini_set('display_errors', 0); // Don't show errors to users
ini_set('log_errors', 1); // Enable error logging
ini_set('error_log', dirname(__DIR__) . '/logs/error.log'); // Set log file path

// If accessed directly (not through AJAX), ensure clean session
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
    // Only clear session if explicitly requested (logout)
    if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
        // Clear any existing session data
        $_SESSION = array();

        // Get session cookie parameters
        $params = session_get_cookie_params();

        // Delete the session cookie
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );

        // Start a new session
        session_regenerate_id(true);
    }
} else {
    // For AJAX requests, ensure session is started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

// Log session variables for debugging
error_log("Current session state: " . print_r($_SESSION, true));

// Helper function to send JSON response
function sendJSON($data)
{
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

// Helper function to check if a training is active
function isTrainingActive($pdo, $training_id)
{
    $stmt = $pdo->prepare("
        SELECT e.id, e.training_id, t.training_name 
        FROM events e
        JOIN training t ON e.training_id = t.training_id
        WHERE e.training_id = ? 
        AND CURDATE() BETWEEN e.start_date AND e.end_date
    ");
    $stmt->execute([$training_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Handle POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Phase 1: Email Check
        if (isset($_POST['email'])) {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            if (!$email) {
                sendJSON(['status' => 'error', 'message' => 'Invalid email format']);
            }

            // First check if user is a trainer
            $stmt = $pdo->prepare("
                SELECT id, role, email 
                FROM users 
                WHERE email = ? AND role = 'trainer'
            ");
            $stmt->execute([$email]);
            $trainer = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($trainer) {
                // Trainer login - get all active trainings
                $stmt = $pdo->prepare("
                    SELECT DISTINCT e.training_id, t.training_name, e.id as event_id
                    FROM events e
                    JOIN training t ON e.training_id = t.training_id
                    WHERE CURDATE() BETWEEN e.start_date AND e.end_date
                    ORDER BY t.training_name
                ");
                $stmt->execute();
                $activeTrainings = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Set trainer session
                $_SESSION['user_id'] = $trainer['id'];
                $_SESSION['role'] = 'trainer';
                $_SESSION['accessible_cards'] = ['1', '2', '3', '4', '5', '6', '7', '8', '9'];

                sendJSON([
                    'status' => 'success',
                    'role' => 'trainer',
                    'activeTrainings' => $activeTrainings,
                    'accessible_cards' => $_SESSION['accessible_cards']
                ]);
                exit;
            }

            // If not trainer, check for student registration
            $stmt = $pdo->prepare("
                SELECT u.id, u.role, u.email, e.training_id, e.room_code, t.training_name
                FROM users u
                LEFT JOIN event_registrations er ON u.id = er.user_id
                LEFT JOIN events e ON er.event_id = e.id
                LEFT JOIN training t ON e.training_id = t.training_id
                WHERE u.email = ? 
                AND (e.id IS NULL OR CURDATE() BETWEEN e.start_date AND e.end_date)
            ");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                if ($user['training_id']) {
                    // Student with active registration
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['role'] = 'student';
                    $_SESSION['training_id'] = $user['training_id'];
                    $_SESSION['training_name'] = $user['training_name'];
                    $_SESSION['accessible_cards'] = ['1', '2', '3', '4', '5', '6'];
                    $_SESSION['room_code'] = $user['room_code'];

                    sendJSON([
                        'status' => 'success',
                        'role' => 'student',
                        'training_name' => $user['training_name'],
                        'accessible_cards' => $_SESSION['accessible_cards']
                    ]);
                } else {
                    // Student needs registration
                    sendJSON(['status' => 'needRegistration']);
                }
            } else {
                // New user
                sendJSON(['status' => 'needNewUser']);
            }
        }

        // Phase 2: Training Selection (for trainers)
        if (isset($_POST['event_id'])) {
            // Check if user is logged in and is a trainer
            if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'trainer') {
                sendJSON(['status' => 'error', 'message' => 'Unauthorized access']);
                exit;
            }

            $event_id = filter_input(INPUT_POST, 'event_id', FILTER_VALIDATE_INT);
            $training_name = htmlspecialchars($_POST['training_name'] ?? '', ENT_QUOTES, 'UTF-8');

            if (!$event_id || !$training_name) {
                sendJSON(['status' => 'error', 'message' => 'Invalid input']);
                exit;
            }

            // Verify the event exists and is active
            $stmt = $pdo->prepare("
                SELECT e.id, e.training_id, e.room_code, t.training_name
                FROM events e
                JOIN training t ON e.training_id = t.training_id
                WHERE e.id = ? 
                AND CURDATE() BETWEEN e.start_date AND e.end_date
            ");
            $stmt->execute([$event_id]);
            $event = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$event) {
                sendJSON(['status' => 'error', 'message' => 'Invalid or expired training']);
                exit;
            }

            // Update session with selected training
            $_SESSION['training_id'] = $event['training_id'];
            $_SESSION['training_name'] = $event['training_name'];
            $_SESSION['event_id'] = $event['id'];
            $_SESSION['room_code'] = $event['room_code'];

            // Ensure trainer role and accessible cards are set
            $_SESSION['role'] = 'trainer';
            $_SESSION['accessible_cards'] = ['1', '2', '3', '4', '5', '6', '7', '8', '9'];

            // Log session state for debugging
            error_log("Session after training selection: " . print_r($_SESSION, true));

            sendJSON([
                'status' => 'success',
                'training_name' => $event['training_name'],
                'accessible_cards' => $_SESSION['accessible_cards'],
                'role' => 'trainer'
            ]);
            exit;
        }

        // Phase 3: Registration/New User (only for students)
        if (isset($_POST['email']) && isset($_POST['code']) && isset($_POST['acceptTnc']) && isset($_POST['acceptDisclaimer'])) {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $code = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_NUMBER_INT);

            // Verify training code is active
            $training = isTrainingActive($pdo, $code);

            if (!$training) {
                sendJSON(['status' => 'error', 'message' => 'Invalid or expired training code']);
            }

            // Begin transaction
            $pdo->beginTransaction();
            try {
                // Check/Create user (always as student)
                $stmt = $pdo->prepare("SELECT id, role FROM users WHERE email = ?");
                $stmt->execute([$email]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$user) {
                    // Create new student
                    $stmt = $pdo->prepare("
                        INSERT INTO users (email, role, terms_accepted_at) 
                        VALUES (?, 'student', NOW())
                    ");
                    $stmt->execute([$email]);
                    $userId = $pdo->lastInsertId();
                } else {
                    $userId = $user['id'];
                    // Update terms acceptance
                    $stmt = $pdo->prepare("
                        UPDATE users SET terms_accepted_at = NOW() 
                        WHERE id = ?
                    ");
                    $stmt->execute([$userId]);
                }

                // Register for event
                $stmt = $pdo->prepare("
                    INSERT INTO event_registrations (event_id, user_id, first_joined, last_joined)
                    VALUES (?, ?, NOW(), NOW())
                    ON DUPLICATE KEY UPDATE last_joined = NOW()
                ");
                $stmt->execute([$training['id'], $userId]);

                // Set session
                $_SESSION['user_id'] = $userId;
                $_SESSION['role'] = 'student';
                $_SESSION['training_id'] = $training['training_id'];
                $_SESSION['training_name'] = $training['training_name'];
                $_SESSION['accessible_cards'] = ['1', '2', '3', '4', '5', '6'];

                $pdo->commit();

                sendJSON([
                    'status' => 'success',
                    'role' => 'student',
                    'training_name' => $training['training_name'],
                    'accessible_cards' => $_SESSION['accessible_cards']
                ]);
            } catch (Exception $e) {
                $pdo->rollBack();
                error_log("Transaction failed: " . $e->getMessage());
                sendJSON(['status' => 'error', 'message' => 'Registration failed']);
            }
        }
    } catch (Exception $e) {
        error_log("Login error: " . $e->getMessage());
        sendJSON(['status' => 'error', 'message' => 'An unexpected error occurred']);
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Author: Joel Lustgarten, Organization: Technical training center, Area: MA-AA/TSS2-LA, Company: Robert Bosch Ltda., Country: Brazil, Content: Technical training material">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="imagetoolbar" content="no" />
    <meta name="rating" content="general" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="copyright" content="© Robert Bosch Ltda." />
    <meta name="keywords" content="Bosch, Technical training, Techical training center, Mechanics">
    <link rel="icon" type="image/x-icon" href="../style/resources/favicon.ico" />
    <link rel="stylesheet" href="../style/style.css">
    <script defer="" src="../js/main.js"></script>
    <title>CTA | Training App</title>

</head>
<style>
    body {
        overflow: hidden;
        margin: 0;
    }

    main {
        height: calc(100vh - 161px);
    }

    .main_container {
        height: calc(100vh - 161px);
        /* Full height minus header (70px) and footer (70px) */
        display: flex;
        flex-direction: column;
        overflow-y: auto;
        /* Allow vertical scrolling */
    }

    #index_container {
        flex-grow: 1;
        /* Allow it to grow and fill the available space */
        display: flex;
        flex-direction: column;
        /* Ensure it stacks its children vertically */
        margin-bottom: 70px;
    }

    #login_form>:first-child {
        margin-bottom: 30px;
    }

    .footer {
        position: sticky;
        /* Keeps it at the bottom */
        bottom: 0;
        background-color: var(--bosch-white);
        z-index: 10;
    }

    @media (min-width: 992px) {
        #index_container {
            margin-left: auto;
            margin-top: auto;
        }
    }

    @media (max-height: 780px) {
        #index_container {
            margin-bottom: 150px;
        }
    }

    .i_container {
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    }

    @media (min-width: 768px) {
        .i_container {
            width: 750px;
        }
    }

    @media (min-width: 992px) {
        .i_container {
            width: 970px;
        }
    }

    @media (min-width: 1200px) {
        .i_container {
            width: 1170px;
        }
    }

    .menu_title {
        display: inline-block;
        width: 100%;
    }

    .menu_title p {
        margin-left: 40px;
        margin-bottom: 30px;
    }

    .menu_title p {
        font-size: 20px;
        color: var(--bosch-gray-35);
        line-height: 1.3em;
        font-weight: 400;
    }

    @media (min-width: 992px) {
        .card_section {
            margin-left: 20px;
        }
    }

    .card_section {
        display: flex;
        justify-content: flex-start;
        flex-wrap: wrap;
        justify-content: center;
        gap: 40px;
    }

    @media (min-width: 1000px) {
        .card_section {
            gap: 20px;
        }
    }

    .card {
        width: 240px;
        height: 140px;
        margin: 20px;
        border-radius: 0;
        background: var(--bosch-blue-50);
        color: var(--bosch-white);
        box-sizing: border-box;
        -webkit-transition: -webkit-transform 0.1s ease-in-out;
        -moz-transition: -moz-transform 0.1s ease-in-out;
        transition: transform 0.1s ease-in-out;
    }

    .card:active {
        transform: scale(0.95);
        background-color: var(--bosch-blue-40);
    }

    .card[disabled] {
        pointer-events: none;
        background: var(--bosch-gray-80);
        color: var(--bosch-gray-45);
    }

    .card[disabled] .card_text {
        color: var(--bosch-gray-45);
    }

    .c-icon {
        font-size: 45px;
        position: relative;
        top: 20px;
        left: 15px;
    }

    .card_text {
        font-size: 1em;
        font-weight: 700;
        margin-left: 15px;
        margin-top: 30px;
        color: var(--bosch-white);
    }

    .lower {
        display: none;
    }

    .course_name {
        font-size: 2rem;
    }

    .widget-container {
        width: 100%;
        display: flex;
        justify-content: center;
        padding: 1rem 0;
    }

    .mc-container {
        display: flex;
        justify-content: space-between;
        gap: 2rem;
        width: 100%;
        max-width: 800px;
    }

    .microcard {
        flex: 1;
        max-width: 100px;
        aspect-ratio: 1 / 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.2s;
        padding: 0.5rem;
        text-align: center;
        background-color: var(--bosch-blue-50);
    }

    .microcard:hover {
        background: var(--bosch-blue-40);
    }

    .mc-icon {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .md-icon {
        font-size: 2rem;
        color: var(--bosch-white);
        margin-top: 0.25rem;
    }

    .mc-label {
        font-size: 0.8rem;
        color: var(--bosch-white);
        margin-top: 0.25rem;
        line-height: 1.1;
        max-height: 2.4rem;
        overflow: hidden;
        margin-top: 15px;
    }

    /* -----------  DISCLAIMER DIALOG STYLE --------*/


    .m-dialog__actions span {
        margin-top: 1.5rem;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        -ms-flex-pack: end;
        justify-content: flex-end;
        gap: 1rem;
        width: 100%;
    }

    .a-box {
        max-width: 52rem;
        max-height: 92vh;
        overflow-y: scroll;
    }

    .second-p {
        margin-top: 2rem;
    }

    .checkboxes {
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .a-checkbox label {
        font-size: 0.9rem;
        --font-size: 0.9rem;
    }

    .a-checkbox label::before {
        height: 1rem;
        width: 1rem;
    }

    input[type="checkbox"]:focus-visible+label::before {
        outline: auto;
        outline-offset: 3px;
    }

    bbg-button>button {
        width: 100%;
        margin-left: 0 !important;
    }

    .a-checkbox input[type="checkbox"]:checked~label:after {
        font-size: 1rem;
        height: 1rem;
        line-height: 1;
        width: 1rem;
    }

    .a-che .small-print-link {
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
        font-size: var(--pwc-font-size);
        color: var(--bosch-blue-50);
    }

    .m-form-field {
        margin-top: 2rem;
    }

    .read-more {
        margin-top: 0.75rem;
        margin-left: 32.5px;
    }

    .smallprint-links {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-pack: center;
        justify-content: center;
        -ms-flex-direction: row;
        flex-direction: row;
    }

    .smallprint-links span:nth-child(2) {
        -ms-flex-pack: start;
        justify-content: flex-start;
        padding-left: 1rem;
    }

    .smallprint-links span:last-child:after {
        content: "";
        margin: 0;
        padding-top: 0.1rem;
    }

    .desc1,
    .desc2,
    .desc3 {
        font-style: italic;
        font-size: 0.9rem;
        --font-size: 0.9rem;
        text-align: justify;
        margin-block-start: 2em;
        margin-block-end: 2em;
    }

    .m-dialog__headline {
        font-size: 1.2rem;
        --font-size: 1.2rem;
    }

    .m-dialog__code {
        --font-size: 0.75rem;
        font-size: 0.75rem;
        color: var(--bosch-red-50);
    }

    @media (max-width: 48rem) {
        .smallprint-links {
            -ms-flex-direction: column;
            flex-direction: column;
            -ms-flex-align: center;
            align-items: center;
            -ms-flex-pack: center;
            justify-content: center;
        }

        .smallprint-links span {
            padding: 0.75rem 0;
            -ms-flex-pack: center !important;
            justify-content: center !important;
        }

        .smallprint-links span:nth-child(2) {
            padding-left: 0rem;
            margin-top: 0;
        }

        .smallprint-links span:after {
            display: none;
        }
    }
</style>

<body>
    <header class="o-header">
        <div class="o-header__top-container">
            <div class="e-container">
                <div class="o-header__top">
                    <a href="/" class="o-header__logo" aria-label="Bosch Logo">
                        <svg
                            width="108px"
                            height="24px"
                            viewBox="0 0 108 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                id="bosch-logo-text"
                                d="M78.19916,15.03735c0,3.46057-3.1618,5.1535-6.12445,5.1535c-3.41083,0-5.17847-1.29462-6.57263-2.96265 l2.51453-2.48962c1.07056,1.36926,2.46472,2.0415,4.0083,2.0415c1.29462,0,2.14105-0.62244,2.14105-1.56848 c0-0.99585-0.77179-1.31952-2.83813-1.74274l-0.54773-0.12451c-2.48962-0.52283-4.53113-1.91699-4.53113-4.75519 c0-3.112,2.53943-4.97925,5.87549-4.97925c2.8382,0,4.65564,1.21991,5.77594,2.48962l-2.46472,2.43988 c-0.82831-0.91748-2.00061-1.44946-3.23651-1.46893c-0.89624,0-1.91699,0.42328-1.91699,1.46893 c0,0.97095,1.07056,1.31946,2.41492,1.59332l0.54773,0.12451C75.51038,10.73029,78.24896,11.42737,78.19916,15.03735z  M64.80499,11.92529c0,4.65558-2.66394,8.29047-7.26971,8.29047c-4.58093,0-7.26971-3.63489-7.26971-8.29047 c0-4.63068,2.68878-8.29047,7.26971-8.29047C62.14105,3.63483,64.80499,7.29462,64.80499,11.92529z M60.92114,11.92529 c0-2.46472-1.1452-4.48132-3.38586-4.48132s-3.36102,1.9917-3.36102,4.48132s1.12036,4.50623,3.36102,4.50623 S60.92114,14.43982,60.92114,11.92529z M87.06226,16.43152c-1.74274,0-3.56018-1.44397-3.56018-4.60583 c0-2.81323,1.69293-4.38171,3.46057-4.38171c1.39423,0,2.21576,0.64728,2.8631,1.76764l3.18671-2.11621 c-1.59338-2.41492-3.48547-3.43567-6.09961-3.43567c-4.78009,0-7.36926,3.70953-7.36926,8.19086 c0,4.70544,2.86304,8.39008,7.31946,8.39008c3.13696,0,4.63074-1.09546,6.24902-3.43567l-3.21167-2.16602 C89.25311,15.68463,88.55603,16.43152,87.06226,16.43152z M48.97095,15.46057c0,2.66388-2.43982,4.40662-4.92944,4.40662H35.9502 V4.0332h7.44397c2.8382,0,4.9046,1.44397,4.9046,4.35681c0.01666,1.43036-0.85675,2.72058-2.19086,3.23651 C46.10791,11.65143,48.97095,12.29877,48.97095,15.46057z M39.80914,10.25726h2.83813 c0.02155,0.00134,0.04309,0.00226,0.06464,0.00269c0.81476,0.01575,1.48804-0.6319,1.50385-1.44666 c0.00342-0.0567,0.00342-0.11353,0-0.17017c-0.047-0.77802-0.71576-1.37061-1.49377-1.32361h-2.88794L39.80914,10.25726z  M44.76349,14.98755c0-0.92114-0.67218-1.54358-2.09131-1.54358h-2.81323v3.11206h2.88794 C43.91699,16.55603,44.76349,16.13275,44.76349,14.98755z M103.64313,4.03326v5.82568H98.8382V4.03326h-4.15771v15.83398h4.15771 v-6.24896h4.80493v6.24896h4.15771V4.03326H103.64313z" />
                            <path
                                id="bosch-logo-anker"
                                d="M12,0C5.37256,0,0,5.37256,0,12c0,6.62738,5.37256,12,12,12s12-5.37262,12-12C23.99646,5.37402,18.62598,0.00354,12,0z  M12,22.87964C5.99133,22.87964,1.12036,18.00867,1.12036,12S5.99133,1.1203,12,1.1203S22.87964,5.99133,22.87964,12 C22.87354,18.0061,18.0061,22.87354,12,22.87964z M19.50293,7.05475c-0.66852-1.01306-1.53552-1.88-2.54858-2.54852h-0.82159 v4.10785H7.89209V4.50623H7.04565c-4.13873,2.73114-5.27972,8.30029-2.54858,12.43896 c0.66852,1.01306,1.53552,1.88007,2.54858,2.54858h0.84644v-4.10791h8.24066v4.10791h0.82159 C21.09308,16.76257,22.23407,11.19348,19.50293,7.05475z M6.74689,17.87549c-3.24493-2.88354-3.5379-7.85168-0.65436-11.09668 c0.20508-0.23077,0.42358-0.44928,0.65436-0.65436V17.87549z M16.13275,14.24066H7.89209V9.73444h8.24066V14.24066z  M17.84827,17.25549c-0.18768,0.2088-0.38629,0.40747-0.59515,0.59509v-2.48962V8.61407V6.12445 C20.49121,9.03387,20.75763,14.0174,17.84827,17.25549z" />
                        </svg>
                    </a>
                    <div class="o-header__quicklinks">
                        <button type="button" class="a-button a-button--integrated" id='login_btn'>
                            <i class="a-icon a-button__icon boschicon-bosch-ic-login"></i>
                            <span class="a-button__label">Login</span>
                        </button>
                        <button type="button" class="a-button a-button--integrated">
                            <i class="a-icon a-button__icon boschicon-bosch-ic-chat"></i>
                            <span class="a-button__label" data-i18n="contato"></span>
                        </button>
                    </div>
                    <button
                        type="button"
                        class="a-button a-button--integrated o-header__menu-trigger"
                        aria-haspopup="true"
                        aria-label="Toggle Main Navigation">
                        <i class="o-header__menu-trigger-icon a-icon a-button__icon">
                            <span class="o-header__menu-trigger-icon-bar"></span>
                            <span class="o-header__menu-trigger-icon-bar"></span>
                            <span class="o-header__menu-trigger-icon-bar"></span>
                            <span class="o-header__menu-trigger-icon-bar"></span>
                        </i>
                        <span class="o-header__menu-trigger-label a-button__label">Menu</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="e-container">
            <div class="o-header__meta">
                <ol class="m-breadcrumbs">
                    <li>
                        <div class="a-link -icon">
                            <a href="#" target="_self">
                                <span>Home</span>
                                <span>
                                    <i class="a-icon ui-ic-nosafe-lr-right-small"></i>
                                </span>
                            </a>
                        </div>
                    </li>
                </ol>
                <span class="o-header__subbrand">Training App - Menu</span>
            </div>
        </div>
        <div class="o-header__navigation-container">
            <div class="e-container">
                <nav class="o-header__navigation" aria-label="Main navigation">
                    <ul class="o-header__navigation-first-level" role="menu" style="padding-bottom: 1rem;">
                        <li class="o-header__navigation-first-level-item" role="menuitem">
                            <button
                                type="button"
                                class="a-button a-button--integrated -without-icon o-header__navigation-trigger"
                                aria-haspopup="true"
                                aria-expanded="false"
                                tabindex="0">
                                <span class="a-button__label" data-i18n="otros_treinamentos"></span>
                            </button>
                            <i class="a-icon o-header__navigation-arrow ui-ic-right"></i>
                        </li>
                        <li class="o-header__navigation-first-level-item" role="menuitem">
                            <button
                                type="button"
                                class="a-button a-button--integrated -without-icon o-header__navigation-trigger"
                                aria-haspopup="true"
                                aria-expanded="false"
                                tabindex="0"
                                id='logout_btn'>
                                <span class="a-button__label">logout</span>
                            </button>
                            <i class="a-icon o-header__navigation-arrow ui-ic-right"></i>
                        </li>
                        <li class="o-header__language-selector" role="menuitem" style="margin-top: 1rem;">
                            <div class="m-language-selector">
                                <div class="a-link -icon">
                                    <a
                                        href="#"
                                        target="_self">
                                        <i class="a-icon boschicon-bosch-ic-globe"></i>
                                        <span data-i18n="Idioma"></span>
                                    </a>
                                </div>
                                <div class="a-dropdown">
                                    <select
                                        id="demo"
                                        aria-label="dropdown for language" onload="changeLanguage('pt')" onchange="changeLanguage(this)">
                                        <option value='pt'>Portuguese</option>
                                        <option value='en'>English</option>
                                        <option value='es'>Espa&ntilde;ol</option>
                                    </select>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>
                <hr>
            </div>
        </div>
    </header>

    <main>
        <!------- LOGIN DIALOG ---------->
        <dialog
            class="m-dialog -floating-shadow-s -floating"
            id="login-dialog"
            aria-labelledby="dialog-alert-dialog-info-without-close-button-title" style="max-width: 30rem !important;">
            <div class="m-dialog__remark --info"></div>
            <div class="m-dialog__header">
                <i class="a-icon ui-ic-alert-info"></i>
                <div class="m-dialog__title" data-i18n="login_title"></div>
            </div>
            <hr class="a-divider" />
            <div class="m-dialog__content">
                <div
                    class="m-dialog__headline"
                    id="dialog-alert-dialog-info-without-close-button-title" data-i18n="login_subtitle">
                </div>
                <div
                    class="m-dialog__body"
                    id="dialog-alert-dialog-info-without-close-button-description" data-i18n="Login_inst">
                </div>
                <form id="login_form">
                    <div class="a-text-field">
                        <label for="email_input" data-i18n="email"></label>
                        <input
                            type="email"
                            id="email-input"
                            name="email_input"
                            list="domain-list"
                            autocomplete="new-email"
                            autocapitalize="none"
                            autocorrect="off"
                            spellcheck="false" />
                        <datalist id="domain-list"></datalist>
                    </div>
                    <div class="m-dialog__code" id="loginError"></div>
                    <div class="m-dialog__actions" id="login_error_message">
                        <button
                            type="submit"
                            class="a-button a-button--primary -without-icon"
                            id="loginConfirm">
                            <span class="a-button__label" data-i18n="confirm_btn"></span>
                        </button>
                        <button
                            type="button"
                            class="a-button a-button--secondary -without-icon"
                            id="loginCancel">
                            <span class="a-button__label" data-i18n="cancel_btn"></span>
                        </button>
                    </div>
                </form>
            </div>
        </dialog>
        <!----------END OF LOGIN DIALOG------------>
        <!------- TRAINING SELECTOR DIALOG ---------->
        <dialog
            class="m-dialog -floating-shadow-s -floating"
            id="trainingSelector"
            aria-labelledby="dialog-alert-dialog-info-without-close-button-title" style="max-width: 30rem !important;">
            <div class="m-dialog__remark --info"></div>
            <div class="m-dialog__header">
                <i class="a-icon boschicon-bosch-ic-technical-training-at-vehicle"></i>
                <div class="m-dialog__title" data-i18n="training_selector_title"></div>
            </div>
            <hr class="a-divider" />
            <div class="m-dialog__content">
                <div
                    class="m-dialog__headline"
                    id="dialog-alert-dialog-info-without-close-button-title" data-i18n="training_selector_subtitle">
                </div>
                <div
                    class="m-dialog__body"
                    id="dialog-alert-dialog-info-without-close-button-description" data-i18n="training_selector_inst">
                </div>
                <form id="training_form">
                    <div class="a-dropdown">
                        <label for="trainingSelect">Select Training:</label>
                        <select id="trainingSelect" class="form-control">
                            <option value="">Select a Training</option>
                        </select>
                    </div>
                    <div class="m-dialog__code" id="trainingError"></div>
                    <div class="m-dialog__actions" id="login_error_message">
                        <button
                            type="submit"
                            class="a-button a-button--primary -without-icon"
                            id="trainingConfirm">
                            <span class="a-button__label" data-i18n="training_confirm_btn"></span>
                        </button>
                        <button
                            type="button"
                            class="a-button a-button--secondary -without-icon"
                            id="trainingCancel">
                            <span class="a-button__label" data-i18n="training_cancel_btn"></span>
                        </button>
                    </div>
                </form>
            </div>
        </dialog>
        <!----------END OF TRAINING SELECTOR DIALOG------------>
        <!---- TERMS OF USE & DISCLAIMER ----->
        <dialog class="m-dialog -floating-shadow-s -floating" id="disc-dialog">
            <div class="m-dialog__content">
                <div
                    class="m-dialog__top-content"
                    id="pwc-dialog-top-content"></div>
                <div class="m-dialog__headline" id="pwc-dialog-headline">
                    <span slot="headline" data-i18n="terms_title"></span>
                </div>
                <div class="m-dialog__body" id="pwc-dialog-body">
                    <div slot="content">
                        <div>
                            <p class="desc1" data-i18n="main_disclaimer"></p>
                            <p class="desc2" data-i18n="disclaimer"></p>
                            <p class="desc3" data-i18n="copyright">
                            </p>
                        </div>
                        <div class="a-text-field">
                            <label for="code-input-disc" data-i18n="codigo_curso"></label>
                            <input
                                type="text"
                                id="code-input-disc"
                                name="code"
                                pattern="\d(5)"
                                placeholder="12345" />
                        </div>
                        <div class="m-dialog__code" id="discError"></div>
                        <div class="checkboxes">
                            <bbg-checkbox class="hydrated">
                                <div class="a-checkbox">
                                    <input
                                        type="checkbox"
                                        id="comfort"
                                        style="display: block" />
                                    <label for="comfort" data-i18n="consent_disclaimer"></label>
                                </div>
                            </bbg-checkbox>
                        </div>
                        <div class="checkboxes">
                            <bbg-checkbox class="hydrated">
                                <div class="a-checkbox">
                                    <input
                                        type="checkbox"
                                        id="copyright"
                                        style="display: block" />
                                    <label for="copyright" data-i18n="consent_copyright"></label>
                                </div>
                            </bbg-checkbox>
                        </div>
                    </div>
                </div>
                <div class="m-dialog__code" id="pwc-dialog-code">
                    <span slot="code" data-i18n="accept-agreement"></span>
                </div>
                <div class="m-dialog__actions" id="pwc-dialog-actions">
                    <span slot="actions" style="display: block">
                        <p style="margin-top: 0px">
                            <bbg-button id="save-all-modal-dialog" class="hydrated">
                                <button
                                    type="button"
                                    class="a-button a-button--primary -without-icon">
                                    <div class="a-button__label" data-i18n="accept_button"></div>
                                </button>
                            </bbg-button>
                        </p>
                        <p>
                            <bbg-button
                                id="decline-all-modal-dialog"
                                class="hydrated">
                                <button
                                    type="button"
                                    class="a-button a-button--secondary -without-icon">
                                    <div class="a-button__label" data-i18n="reject_button"></div>
                                </button>
                            </bbg-button>
                        </p>
                        <div class="smallprint-links">
                            <span>
                                <bbg-link class="hydrated"><!---->
                                    <div class="a-link a-link--simple">
                                        <a
                                            href="bar?prevent-auto-open-privacy-settings"
                                            target="_self">Data protection notice</a>
                                    </div>
                                </bbg-link>
                            </span>
                            <span>
                                <bbg-link class="hydrated"><!---->
                                    <div class="a-link a-link--simple">
                                        <a
                                            href="foo?prevent-auto-open-privacy-settings"
                                            target="_self">Corporate information</a>
                                    </div>
                                </bbg-link>
                            </span>
                        </div>
                    </span>
                </div>
            </div>
        </dialog>
        <!---- END OF TERMS OF USE AND DISCLAIMER DIALOG ----->
        <!----------WIDGETS DIALOG----------------->
        <dialog
            class="m-dialog -floating-shadow-s -floating"
            id="widget-dialog"
            aria-labelledby="dialog-alert-dialog-info-without-close-button-title" style="max-width: 40rem !important;">
            <div class="m-dialog__remark --info"></div>
            <div class="m-dialog__header">
                <i class="a-icon boschicon-bosch-ic-wrench"></i>
                <div class="m-dialog__title" data-i18n="widget_title"></div>
            </div>
            <hr class="a-divider" />
            <div class="m-dialog__content">
                <div class="m-dialog__headline"
                    id="dialog-alert-dialog-info-without-close-button-title" data-i18n="widget_subtitle">
                </div>
                <div class="widget-container">
                    <section class="mc-container">
                        <div class="microcard" id="mc1" role="button" onclick="openUnit()">
                            <div class="mc-icon">
                                <i class="md-icon boschicon-bosch-ic-calculate"></i>
                            </div>
                            <div class="mc-label">
                                <span class="mc-label" data-i18n="widget1"></span>
                            </div>
                        </div>
                        <div class="microcard" id="mc2" role="button" onclick="openDictionary()">
                            <div class="mc-icon">
                                <i class="md-icon boschicon-bosch-ic-book"></i>
                            </div>
                            <div class="mc-label">
                                <span class="mc-label" data-i18n="widget2"></span>
                            </div>
                        </div>
                        <div class="microcard" id="mc3" role="button" onclick="openAbbreviation()">
                            <div class="mc-icon">
                                <i class="md-icon boschicon-bosch-ic-glossary"></i>
                            </div>
                            <div class="mc-label">
                                <span class="mc-label" data-i18n="widget3"></span>
                            </div>
                        </div>
                        <div class="microcard" id="mc4" role="button" onclick="openDiagram()">
                            <div class="mc-icon">
                                <i class="md-icon boschicon-bosch-ic-circuit-hydraulic"></i>
                            </div>
                            <div class="mc-label">
                                <span class="mc-label" data-i18n="widget4"></span>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="m-dialog__actions">
                    <button
                        type="button"
                        class="a-button a-button--secondary -without-icon"
                        id="widgetCancel">
                        <span class="a-button__label" data-i18n="cancel_btn"></span>
                    </button>
                </div>
            </div>
        </dialog>
        <!---------END OF WIDGET DIALOG----------->
        <div class="main_container">
            <div id="index_container" class="i_container">
                <div class="main_title">
                    <h2 class="main_title_header"><span data-i18n="inner_title"></span><span class="course_name"></span></h2>
                </div>
                <div class="menu_title">
                    <p><span data-i18n="inner_subtitle"></span><span>
                        </span></span><i class="b-icon arrow boschicon-bosch-ic-forward-right" title="Right"></i></p>
                </div>
                <section class="card_section">
                    <div class="card" id="1" role="button"><i
                            class="c-icon boschicon-bosch-ic-board-speaker" title="Course Material"></i>
                        <p class="card_text"><span data-i18n="menu1">
                            </span><i class="d-icon arrow boschicon-bosch-ic-forward-right"></i></p>
                    </div>
                    <div class="card" id="2" role="button"><i class="c-icon boschicon-bosch-ic-wrench"
                            title="app Widgets"></i>
                        <p class="card_text"><span data-i18n="menu2">
                            </span><i class="d-icon arrow boschicon-bosch-ic-forward-right"></i></p>
                    </div>
                    <div class="card" id="3" role="button"><i
                            class="c-icon boschicon-bosch-ic-wishlist" title="NPS survey"></i>
                        <p class="card_text"><span data-i18n="menu3">
                            </span><i class="d-icon arrow boschicon-bosch-ic-forward-right"></i></p>
                    </div>
                    <div class="card" id="4" role="button"><i
                            class="c-icon boschicon-bosch-ic-radiotower"></i>
                        <p class="card_text"><span data-i18n="menu4">
                            </span><i class="d-icon arrow boschicon-bosch-ic-forward-right"></i></p>
                    </div>
                    <div class="card" id="5" role="button"><i
                            class="c-icon boschicon-bosch-ic-desktop-graph-search"></i>
                        <p class="card_text"><span data-i18n="menu5">
                            </span><i class="d-icon arrow boschicon-bosch-ic-forward-right"></i></p>
                    </div>
                    <div class="card" id="6" role="button"><i
                            class="c-icon ui-ic-alert-info"></i>
                        <p class="card_text"><span data-i18n="menu6">
                            </span><i class="d-icon arrow boschicon-bosch-ic-forward-right"></i></p>
                    </div>
                </section>
                <section id="admin_card" class="card_section lower" style="margin-top: 20px;">
                    <div class="card" id="7" role="button"><i
                            class="c-icon boschicon-bosch-ic-download-frame" title="presenca"></i>
                        <p class="card_text"><span data-i18n="menu7">
                            </span><i class="d-icon arrow boschicon-bosch-ic-forward-right"></i></p>
                    </div>
                    <div class="card" id="8" role="button"><i
                            class="c-icon boschicon-bosch-ic-calendar-date-single"></i>
                        <p class="card_text"><span data-i18n="menu8">
                            </span><i class="d-icon arrow boschicon-bosch-ic-forward-right"></i></p>
                    </div>
                    <div class="card" id="9" role="button" onclick=""><i
                            class="c-icon boschicon-bosch-ic-login" title="index"></i>
                        <p class="card_text"><span data-i18n="menu9">
                            </span><i class="d-icon arrow boschicon-bosch-ic-forward-right"></i></p>
                    </div>

                </section>

            </div>
        </div>
    </main>
    <!-------------FOOTER------------------------->
    <footer class="o-footer -minimal footer">
        <hr class="a-divider" />
        <div class="e-container">
            <div class="o-footer__bottom">
                <ul class="o-footer__links">
                    <li>
                        <div class="a-link a-link--integrated">
                            <a href="imprint.php" target="_self"><span>Imprint</span></a>
                        </div>
                    </li>
                    <li>
                        <div class="a-link a-link--integrated">
                            <a href="avisos_legais.php" target="_self"><span>Legal information</span></a>
                        </div>
                    </li>
                    <li>
                        <div class="a-link a-link--integrated">
                            <a href="privacidade.php" target="_self"><span>Data privacy</span></a>
                        </div>
                    </li>
                </ul>
                <hr class="a-divider" />
                <div class="o-footer__copyright">
                    <i
                        class="a-icon boschicon-bosch-ic-copyright-frame"
                        title="Lorem Ipsum"></i>
                    2021 Bosch.IO GmbH, all rights reserved
                </div>
            </div>
        </div>
    </footer>
    <!------------END OF FOOTER------------------>
</body>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Dialog elements
        const loginDialog = document.getElementById('login-dialog');
        const widgetDialog = document.getElementById('widget-dialog');
        const discDialog = document.getElementById('disc-dialog');
        const trainingDialog = document.getElementById('trainingSelector');

        // Form elements
        const loginForm = document.getElementById("login_form");
        const loginError = document.getElementById("loginError");
        const discError = document.getElementById("discError");
        const trainingError = document.getElementById("trainingError");
        const title = document.querySelector(".course_name");
        const allCards = document.querySelectorAll('.card');
        const lang_option = document.getElementById("demo");
        const trainingSelect = document.getElementById('trainingSelect');

        let pendingEmail = null;

        // Function to set card states
        function setCardState(accessibleCards, userRole) {
            const alwaysEnabledCards = ['2', '6'];
            const adminCards = ['7', '8', '9'];

            allCards.forEach(card => {
                const cardId = card.id;

                // Enable cards based on role and accessibility
                if (userRole === 'trainer') {
                    // For trainers, enable all cards
                    card.removeAttribute('disabled');
                } else if (alwaysEnabledCards.includes(cardId)) {
                    // Always enabled cards
                    card.removeAttribute('disabled');
                } else if (accessibleCards && accessibleCards.includes(cardId)) {
                    // Cards accessible to the user
                    card.removeAttribute('disabled');
                } else {
                    // Disable all other cards
                    card.setAttribute('disabled', 'true');
                }

                // Ensure click handlers are properly set
                if (!card.hasAttribute('disabled')) {
                    card.style.cursor = 'pointer';
                    card.onclick = function() {
                        const action = this.getAttribute('data-action');
                        if (action) {
                            window.location.href = action;
                        }
                    };
                } else {
                    card.style.cursor = 'not-allowed';
                    card.onclick = null;
                }
            });

            // Handle admin card section visibility
            const adminCard = document.getElementById('admin_card');
            if (adminCard) {
                if (userRole === 'trainer') {
                    adminCard.classList.remove('lower');
                } else {
                    adminCard.classList.add('lower');
                }
            }

        }

        // Function to handle login success
        function handleLoginSuccess(data) {
            console.log('Login response:', data);

            if (data.status === 'success') {
                // Handle successful login based on role
                if (data.role === 'trainer') {
                    console.log('Trainer login detected');
                    // For trainers, show training selector dialog
                    loginDialog.close();
                    trainingDialog.showModal();

                    // Populate training selector
                    const trainingSelect = document.getElementById('trainingSelect');
                    trainingSelect.innerHTML = '<option value="">Select a Training</option>';
                    data.activeTrainings.forEach(training => {
                        trainingSelect.innerHTML += `
                            <option value="${training.training_id}" data-event-id="${training.event_id}">
                                ${training.training_name}
                            </option>
                        `;
                    });
                } else {
                    // For students, proceed with normal flow
                    console.log('Student login detected');
                    setCardState(data.accessible_cards, data.role);
                    title.textContent = data.training_name;
                    loginDialog.close();
                    discDialog.close();
                }
            } else if (data.status === 'needRegistration' || data.status === 'needNewUser') {
                // Handle registration needed cases
                loginDialog.close();
                discError.textContent = data.status === 'needRegistration' ?
                    "Please enter your training code & accept terms." :
                    "New user: enter code & accept terms.";
                discDialog.showModal();
            } else {
                // Handle error cases
                loginError.textContent = data.message || "An unexpected error occurred.";
            }
        }

        // Handle training selection form submission
        document.getElementById('training_form').addEventListener('submit', async function(e) {
            e.preventDefault();
            const selectedOption = trainingSelect.options[trainingSelect.selectedIndex];

            if (selectedOption.value) {
                const eventId = selectedOption.dataset.eventId;
                const trainingName = selectedOption.text;

                try {
                    console.log('Sending training selection:', {
                        eventId,
                        trainingName
                    });
                    const response = await fetch('login.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: `event_id=${eventId}&training_name=${encodeURIComponent(trainingName)}`
                    });

                    const data = await response.json();
                    console.log('Training selection response:', data);

                    if (data.status === 'success') {
                        // Update UI with new training data
                        setCardState(data.accessible_cards, data.role);
                        title.textContent = data.training_name;
                        // Show admin section for trainers
                        const adminCard = document.getElementById('admin_card');
                        if (adminCard) {
                            adminCard.classList.remove('lower');
                        }
                        // Close the training dialog
                        trainingDialog.close();
                    } else {
                        trainingError.textContent = data.message || 'Failed to update training selection';
                    }
                } catch (error) {
                    console.error('Error:', error);
                    trainingError.textContent = 'An error occurred while updating training selection';
                }
            } else {
                trainingError.textContent = 'Please select a training';
            }
        });

        // Handle logout
        document.getElementById('logout_btn').addEventListener('click', async function() {
            try {
                // First reset UI state
                setCardState([], null);

                // Call logout endpoint with cache-busting parameter
                const response = await fetch("logout.php?t=" + new Date().getTime(), {
                    method: 'POST',
                    headers: {
                        'Cache-Control': 'no-cache, no-store, must-revalidate',
                        'Pragma': 'no-cache',
                        'Expires': '0'
                    }
                });

                if (response.ok) {
                    // Force reload the page with cache busting
                    window.location.href = window.location.pathname + '?t=' + new Date().getTime();
                } else {
                    console.error("Logout failed");
                }
            } catch (err) {
                console.error("Error during logout:", err);
            }
        });

        // Email validation function
        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        // Handle login form submission
        loginForm.addEventListener("submit", async function(e) {
            e.preventDefault();
            loginError.textContent = '';

            const email = document.getElementById('email-input').value.trim();

            // Enhanced validation
            if (!email) {
                loginError.textContent = "Please enter your email address.";
                return;
            }

            if (!validateEmail(email)) {
                loginError.textContent = "Please enter a valid email address.";
                return;
            }

            pendingEmail = email;

            try {
                const response = await fetch('login.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `email=${encodeURIComponent(email)}`
                });

                const data = await response.json();
                console.log('Login response:', data);

                if (data.status === 'success') {
                    handleLoginSuccess(data);
                } else if (data.status === 'needRegistration' || data.status === 'needNewUser') {
                    loginDialog.close();
                    discError.textContent = data.status === 'needRegistration' ?
                        "Please enter your training code & accept terms." :
                        "New user: enter code & accept terms.";
                    discDialog.showModal();
                } else {
                    loginError.textContent = data.message || "An unexpected error occurred.";
                }
            } catch (err) {
                loginError.textContent = "Network error, please try again.";
                console.error('Login error:', err);
            }
        });

        // Handle terms & registration submission
        document.getElementById('save-all-modal-dialog').addEventListener('click', async () => {
            discError.textContent = '';

            const comfort = document.getElementById('comfort').checked;
            const copyright = document.getElementById('copyright').checked;
            const code = document.getElementById('code-input-disc').value.trim();

            if (!comfort) {
                discError.textContent = "You must accept the legal disclaimer.";
                return;
            }

            if (!copyright) {
                discError.textContent = "You must accept the Terms & Conditions.";
                return;
            }

            if (!code) {
                discError.textContent = "Training code is required.";
                return;
            }

            try {
                const response = await fetch('login.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `email=${encodeURIComponent(pendingEmail)}&code=${encodeURIComponent(code)}&acceptTnc=1&acceptDisclaimer=1`
                });

                const data = await response.json();

                if (data.status === 'success') {
                    handleLoginSuccess(data);
                } else {
                    discError.textContent = data.message || "Registration failed. Please try again.";
                }
            } catch (err) {
                discError.textContent = "Network error, please try again.";
                console.error('Registration error:', err);
            }
        });

        // Handle dialog buttons
        document.getElementById('login_btn').addEventListener('click', () => {
            loginError.textContent = '';
            loginDialog.showModal();
        });

        document.getElementById('loginCancel').addEventListener('click', () => {
            loginDialog.close();
        });

        document.getElementById('decline-all-modal-dialog').addEventListener('click', () => {
            discDialog.close();
        });

        // Handle widget dialog
        document.getElementById('2').addEventListener('click', () => {
            widgetDialog.showModal();
        });

        document.getElementById('widgetCancel').addEventListener('click', () => {
            widgetDialog.close();
        });

        document.getElementById('trainingCancel').addEventListener('click', () => {
            trainingDialog.close()
            trainingError.textContent = '';
        });

        // Handle logout
        document.getElementById('logout_btn').addEventListener('click', async function() {
            try {
                // First reset UI state
                setCardState([], null);

                // Call logout endpoint with cache-busting parameter
                const response = await fetch("logout.php?t=" + new Date().getTime(), {
                    method: 'POST',
                    headers: {
                        'Cache-Control': 'no-cache, no-store, must-revalidate',
                        'Pragma': 'no-cache',
                        'Expires': '0'
                    }
                });

                if (response.ok) {
                    // Clear any client-side storage
                    localStorage.clear();
                    sessionStorage.clear();

                    // Force reload the page with cache busting
                    window.location.href = window.location.pathname + '?t=' + new Date().getTime();
                } else {
                    console.error("Logout failed");
                }
            } catch (err) {
                console.error("Error during logout:", err);
            }
        });

        // Initialize UI state from session if available
        const initialAccessibleCards = <?php echo json_encode($_SESSION['accessible_cards'] ?? []); ?>;
        const initialTrainingName = <?php echo json_encode($_SESSION['training_name'] ?? ''); ?>;
        const initialUserRole = <?php echo json_encode($_SESSION['role'] ?? ''); ?>;

        console.log('Initial session state:', {
            accessibleCards: initialAccessibleCards,
            trainingName: initialTrainingName,
            userRole: initialUserRole
        });

        if (initialAccessibleCards.length && initialUserRole) {
            console.log('Setting initial card state');
            setCardState(initialAccessibleCards, initialUserRole);
            if (initialTrainingName) {
                title.textContent = initialTrainingName;
            }
        } else {
            console.log('Resetting UI state');
            setCardState([], null);
        }

        // Update card click handlers
        document.querySelectorAll('.card').forEach(card => {
            const cardId = card.id;
            let action = '';

            switch (cardId) {
                case '1':
                    action = 'material.php';
                    break;
                case '2':
                    action = '#';
                    break; // Widget dialog
                case '3':
                    action = 'nps.php';
                    break;
                case '4':
                    action = 'livecast.php';
                    break;
                case '5':
                    action = 'viewstream.php';
                    break;
                case '6':
                    action = 'info.php';
                    break;
                case '7':
                    action = 'export.php';
                    break;
                case '8':
                    action = 'event.php';
                    break;
                case '9':
                    action = '#';
                    break;
            }

            card.setAttribute('data-action', action);
        });

        // Enhanced email domain autofill
        const domains = [
            'gmail.com',
            'yahoo.com',
            'outlook.com',
            'hotmail.com',
            'bosch.com.br',
            'custom'
        ];

        const emailInput = document.getElementById('email-input');
        const domainList = document.getElementById('domain-list');

        emailInput.addEventListener('input', () => {
            const val = emailInput.value;
            const atIdx = val.indexOf('@');
            const local = atIdx > -1 ? val.slice(0, atIdx) : val;
            const partial = atIdx > -1 ? val.slice(atIdx + 1) : '';

            domainList.innerHTML = '';

            if (!local) return;

            domains.forEach(d => {
                if (d === 'custom') {
                    if (atIdx > -1) {
                        const opt = document.createElement('option');
                        opt.value = local + '@';
                        opt.label = 'Other…';
                        domainList.appendChild(opt);
                    }
                } else if (!partial || d.startsWith(partial)) {
                    const opt = document.createElement('option');
                    opt.value = local + '@' + d;
                    domainList.appendChild(opt);
                }
            });
        });
    });

    // Navigation functions
    function openUnit() {
        location.href = "../../widgets/uc/unitConverter.php";
    }

    function openDictionary() {
        location.href = "../../widgets/dic/technicalDictionary.php";
    }

    function openAbbreviation() {
        location.href = "../../widgets/acron/abbreviations.php";
    }

    function openNps() {
        console.log("openNps");
        location.href = "nps.php";
    }

    function openDiagram() {
        location.href = "../../widgets/diag/diagram.php";
    }


    // fetch language data from json files
    async function fetchLanguageData(lang) {
        const response = await fetch(`../../languages/${lang}.json`);
        return response.json();
    }

    // Function to set the language preference
    function setLanguagePreference(lang) {
        localStorage.setItem("language", lang);
        //location.reload();
    }

    // Function to update content based on selected language
    function updateContent(langData) {
        document.querySelectorAll("[data-i18n]").forEach((element) => {
            const key = element.getAttribute("data-i18n");
            element.textContent = langData[key];
        });

        var selLanguage = document.getElementById("demo");
        if (localStorage.getItem("language") === "es") {
            selLanguage.options[1].defaultSelected = true;
        } else if (localStorage.getItem("language") === "en") {
            selLanguage.options[2].defaultSelected = true;
        } else if (localStorage.getItem("language") === "pt") {
            selLanguage.options[0].defaultSelected = true;
        }

    }

    // Function to change language
    async function changeLanguage(lang) {
        document.querySelector('.o-header').classList.remove('-menu-open');
        await setLanguagePreference(lang.value);
        const langData = await fetchLanguageData(lang.value);
        updateContent(langData);
    }

    // Call updateContent() on page load
    window.addEventListener("DOMContentLoaded", async () => {
        const userPreferredLanguage = localStorage.getItem("language") || "pt";
        const langData = await fetchLanguageData(userPreferredLanguage);
        updateContent(langData);
    });
</script>

</html>