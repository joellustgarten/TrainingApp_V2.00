<?php
/*
// login.php
require_once('config.php'); // Include the database connection and session handling

// Only handle POST here
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // either show 404 or redirect back to your HTML

    // Read which form was submitted
    $form = $_POST['form'] ?? '';

    header('Content-Type: application/json; charset=utf-8');

    switch ($form) {

        // ─────────────────────────────────────────────────
        case 'loginPhase1':
            // 1) Phase 1: user clicked “Continue” on email dialog
            $email = filter_input(INPUT_POST, 'email_input', FILTER_VALIDATE_EMAIL);
            if (!$email) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid email']);
                exit;
            }

            // Lookup user
            $u = $pdo->prepare("SELECT id, role, generic_code FROM users WHERE email = ?");
            $u->execute([$email]);
            $user = $u->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                // brand-new user → open disclaimer
                echo json_encode(['status' => 'needNewUser']);
                exit;
            }

            if ($user['role'] === 'trainer') {
                // existing trainer → pull their active events
                $q = $pdo->prepare("
        SELECT e.training_id, t.training_name, e.room_code
          FROM events e
          JOIN training t ON e.training_id = t.training_id
         WHERE e.instructor_id = ?
           AND CURDATE() BETWEEN e.start_date AND e.end_date
      ");
                $q->execute([$user['id']]);
                $events = $q->fetchAll(PDO::FETCH_ASSOC);

                echo json_encode([
                    'status'           => 'teacher',
                    'role'             => 'trainer',
                    'events'           => $events,
                    'accessible_cards' => ['1', '2', '3', '4', '5', '6', '7', '8', '9']
                ]);
                exit;
            }

            // existing student → check today’s registration
            $q = $pdo->prepare("
      SELECT e.training_id, t.training_name, e.room_code
        FROM event_registrations er
        JOIN events e ON er.event_id = e.id
        JOIN training t ON e.training_id = t.training_id
       WHERE er.user_id = ?
         AND CURDATE() BETWEEN e.start_date AND e.end_date
       LIMIT 1
    ");
            $q->execute([$user['id']]);
            $ev = $q->fetch(PDO::FETCH_ASSOC);

            if ($ev) {
                // already signed up → login success
                $_SESSION['user_id']     = $user['id'];
                $_SESSION['role']        = 'student';
                $_SESSION['training_id'] = $ev['training_id'];
                $_SESSION['room_code']   = $ev['room_code'];

                echo json_encode([
                    'status'           => 'success',
                    'role'             => 'student',
                    'training_name'    => $ev['training_name'],
                    'accessible_cards' => ['1', '2', '3', '4', '5', '6']
                ]);
            } else {
                // student exists but not registered → show disclaimer
                echo json_encode(['status' => 'needRegistration']);
            }
            exit;

            // ─────────────────────────────────────────────────
        case 'loginPhase2Teacher':
            // 2a) Trainer picked a session
            $email       = filter_input(INPUT_POST, 'email_input', FILTER_VALIDATE_EMAIL);
            $training_id = trim($_POST['training_id'] ?? '');
            if (!$email || !$training_id) {
                echo json_encode(['status' => 'error', 'message' => 'Missing data']);
                exit;
            }
            // validate trainer and event…
            // set $_SESSION['role']='trainer', training_id, room_code
            // return status=success
            exit;

            // ─────────────────────────────────────────────────
        case 'loginPhase2Student':
            // 2b) Student entered code + T&C
            $email       = filter_input(INPUT_POST, 'email_input', FILTER_VALIDATE_EMAIL);
            $code        = trim($_POST['course_code']  ?? '');
            $acceptedTnc = isset($_POST['comfort']);
            if (!$email || !$code || !$acceptedTnc) {
                echo json_encode(['status' => 'error', 'message' => 'Complete the form']);
                exit;
            }
            // validate event, create user if needed, insert into event_registrations,
            // set $_SESSION['user_id']='student', training_id, room_code
            // return status=success
            exit;

            // ─────────────────────────────────────────────────
        default:
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Unknown form']);
            exit;
    }
    exit;
}
    */

// login.php
require_once 'config.php';  // starts session, sets up $pdo

// Error handling configuration
error_reporting(E_ALL); // Report all PHP errors
ini_set('display_errors', 0); // Don't show errors to users
ini_set('log_errors', 1); // Enable error logging
ini_set('error_log', dirname(__DIR__) . '/logs/error.log'); // Set log file path

// Helper function to send JSON response
function sendJSON($data)
{
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

// Only intercept POSTs for AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    // Identify which dialog/form was submitted
    $form = $_POST['form'] ?? '';
    $email = filter_input(INPUT_POST, 'email_input', FILTER_VALIDATE_EMAIL);

    // Basic email check for all phases
    if (!$email) {
        sendJSON(['status' => 'error', 'message' => 'Please enter a valid email.']);
    }

    switch ($form) {
        // ─────────────── Phase 1: Email only ───────────────
        case 'loginPhase1':
            // 1) Lookup user by email
            $u = $pdo->prepare(
                "SELECT id, role FROM users WHERE email=?"
            );
            $u->execute([$email]);
            $user = $u->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                // New user → open disclaimer dialog
                sendJSON(['status' => 'needNewUser']);
            }

            if ($user['role'] === 'trainer') {
                // Trainer → list active events
                $q = $pdo->prepare("
                      SELECT e.training_id, t.training_name, e.room_code
                        FROM events e
                        JOIN trainings t ON e.training_id = t.training_id
                       WHERE e.instructor_id = ?
                         AND CURDATE() BETWEEN e.start_date AND e.end_date
                    ");
                $q->execute([$user['id']]);
                $events = $q->fetchAll(PDO::FETCH_ASSOC);

                sendJSON([
                    'status'           => 'teacher',
                    'role'             => 'trainer',
                    'events'           => $events,
                    'accessible_cards' => ['1', '2', '3', '4', '5', '6', '7', '8', '9']
                ]);
                exit;
            }

            // Student → check if already registered today
            $q = $pdo->prepare("
                  SELECT e.training_id, t.training_name, e.room_code
                    FROM event_registrations er
                    JOIN events e ON er.event_id = e.id
                    JOIN trainings t ON e.training_id = t.training_id
                   WHERE er.user_id = ?
                     AND CURDATE() BETWEEN e.start_date AND e.end_date
                   LIMIT 1
                ");
            $q->execute([$user['id']]);
            $ev = $q->fetch(PDO::FETCH_ASSOC);

            if ($ev) {
                // Already signed up → success
                $_SESSION['user_id']     = $user['id'];
                $_SESSION['role']        = 'student';
                $_SESSION['training_id'] = $ev['training_id'];
                $_SESSION['room_code']   = $ev['room_code'];

                sendJSON([
                    'status'           => 'success',
                    'role'             => 'student',
                    'training_name'    => $ev['training_name'],
                    'accessible_cards' => ['1', '2', '3', '4', '5', '6']
                ]);
            } else {
                // Registered user but not for today → need disclaimer
                sendJSON(['status' => 'needRegistration']);
            }
            exit;


            // ────────── Phase 2a: Trainer selects event ──────────
        case 'loginPhase2Teacher':
            $training_id = trim($_POST['training_id'] ?? '');
            $email       = filter_input(INPUT_POST, 'email_input', FILTER_VALIDATE_EMAIL);

            if (!$training_id) {
                sendJSON(['status' => 'error', 'message' => 'No training selected.']);
                exit;
            }

            if (!$email) {
                sendJSON(['status' => 'error', 'message' => 'No email provided.']);
                exit;
            }

            // Validate trainer
            $u = $pdo->prepare("SELECT id FROM users WHERE email=? AND role='trainer'");
            $u->execute([$email]);
            $user = $u->fetch(PDO::FETCH_ASSOC);
            if (!$user) {
                sendJSON(['status' => 'error', 'message' => 'Unauthorized.']);
                exit;
            }
            // Validate event
            $e = $pdo->prepare("
                  SELECT id, room_code
                    FROM events
                   WHERE training_id = ?
                     AND CURDATE() BETWEEN start_date AND end_date
                ");
            $e->execute([$training_id]);
            $ev = $e->fetch(PDO::FETCH_ASSOC);
            if (!$ev) {
                sendJSON(['status' => 'error', 'message' => 'Invalid or expired session.']);
                exit;
            }
            // Set session
            $_SESSION['user_id']     = $user['id'];
            $_SESSION['role']        = 'trainer';
            $_SESSION['training_id'] = $training_id;
            $_SESSION['room_code']   = $ev['room_code'];

            // Fetch name
            $t = $pdo->prepare("SELECT training_name FROM trainings WHERE training_id = ?");
            $t->execute([$training_id]);
            $tn = $t->fetchColumn();

            sendJSON([
                'status'           => 'success',
                'role'             => 'trainer',
                'training_name'    => $tn,
                'accessible_cards' => ['1', '2', '3', '4', '5', '6', '7', '8', '9']
            ]);
            exit;


            // ────────── Phase 2b: Student registers ──────────
        case 'loginPhase2Student':
            $code       = trim($_POST['course_code'] ?? '');
            $ok         = isset($_POST['comfort']);
            if (!preg_match('/^\d{4}$/', $code) || !$ok) {
                echo json_encode(['status' => 'error', 'message' => 'Complete the form properly.']);
                exit;
            }
            // Validate event
            $e = $pdo->prepare("
                  SELECT id, room_code
                    FROM events
                   WHERE training_id = ?
                     AND CURDATE() BETWEEN start_date AND end_date
                ");
            $e->execute([$code]);
            $ev = $e->fetch(PDO::FETCH_ASSOC);
            if (!$ev) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid or expired code.']);
                exit;
            }
            // Lookup/create user
            $u = $pdo->prepare("SELECT id, role FROM users WHERE email = ?");
            $u->execute([$email]);
            $user = $u->fetch(PDO::FETCH_ASSOC);
            if (!$user) {
                $ins = $pdo->prepare("
                      INSERT INTO users (email, role, terms_accepted_at)
                      VALUES (?, 'student', NOW())
                    ");
                $ins->execute([$email]);
                $uid  = $pdo->lastInsertId();
                $role = 'student';
            } else {
                $upd  = $pdo->prepare("UPDATE users SET terms_accepted_at = NOW() WHERE id = ?");
                $upd->execute([$user['id']]);
                $uid  = $user['id'];
                $role = $user['role'];
            }
            // Register
            $r = $pdo->prepare("
                  INSERT IGNORE INTO event_registrations
                    (event_id,user_id,first_joined,last_joined)
                  VALUES (?, ?, NOW(), NOW())
                ");
            $r->execute([$ev['id'], $uid]);

            // Set session
            $_SESSION['user_id']     = $uid;
            $_SESSION['role']        = $role;
            $_SESSION['training_id'] = $code;
            $_SESSION['room_code']   = $ev['room_code'];

            // Fetch name
            $t = $pdo->prepare("SELECT training_name FROM trainings WHERE training_id = ?");
            $t->execute([$code]);
            $tn = $t->fetchColumn();

            sendJSON([
                'status'           => 'success',
                'role'             => 'student',
                'training_name'    => $tn,
                'accessible_cards' => ['1', '2', '3', '4', '5', '6']
            ]);
            exit;


            // ─────────────────────────────────────────────────
        default:
            http_response_code(400);
            sendJSON(['status' => 'error', 'message' => 'Unknown form']);
            exit;
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
    <meta name="google-site-verification" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="robots" content="all">
    <meta name="googlebot" content="noarchive">
    <meta name="googlebot" content="notranslate">
    <meta name="google" content="nopagereadaloud">
    <meta http-equiv="imagetoolbar" content="no" />
    <meta name="rating" content="general" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="copyright" content="© Robert Bosch Ltda." />
    <meta name="keywords" content="Bosch, Technical training, Techical training center, Mechanics">
    <link rel="icon" type="image/x-icon" href="../style/resources/favicon.ico" />
    <link rel="stylesheet" href="../style/style.css">
    <script defer="" src="../js/main.js"></script>
    <title>CTA | Training App</title>

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

        #disc_form {
            overflow-y: auto;
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

</head>

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
                    <li>
                        <div class="a-link -icon">
                            <a href="/" target="_self">
                                <span></span>
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
                <form id="login_form" method="POST" action="login2.php">
                    <input type="hidden" name="form" value="loginPhase1">
                    <div class="a-text-field">
                        <label for="email_input" data-i18n="email"></label>
                        <input
                            type="email"
                            id="email-input"
                            name="email_input"
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
                            id="loginSubmit">
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
            id="training-dialog"
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
                <form id="training_form" method="POST" action="login2.php">
                    <input type="hidden" name="form" value="loginPhase2Teacher">
                    <input type="hidden" name="email_input" id="trainingEmail">
                    <div class="a-dropdown">
                        <label for="trainingSelect">Select Training:</label>
                        <select id="trainingSelect" name="training_id" class="form-control">
                            <option value="">Select a Training</option>
                        </select>
                    </div>
                    <div class="m-dialog__code" id="trainingError"></div>
                    <div class="m-dialog__actions" id="login_error_message">
                        <button
                            type="submit"
                            class="a-button a-button--primary -without-icon"
                            id="trainingSubmit">
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
            <form id="disc_form" method="POST" action="login.php">
                <input type="hidden" name="form" value="loginPhase2Student">
                <div class="m-dialog__content" style="overflow-y: unset;">
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
                                    name="course_code"
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
                                            name="comfort"
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
                                            name="copyright"
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
                                        type="submit" id="discSubmit"
                                        class="a-button a-button--primary -without-icon">
                                        <div class="a-button__label" data-i18n="accept_button"></div>
                                    </button>
                                </bbg-button>
                            </p>
                            <p>
                                <bbg-button
                                    id="discCancel"
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
            </form>
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
                        <div class="microcard" id="mc3" role="button" onclick="openAbreviation()">
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
                    <div class="card" id="1" role="button" onclick="openMaterial()"><i
                            class="c-icon boschicon-bosch-ic-board-speaker" title="Course Material"></i>
                        <p class="card_text"><span data-i18n="menu1">
                            </span><i class="d-icon arrow boschicon-bosch-ic-forward-right"></i></p>
                    </div>
                    <div class="card" id="2" role="button"><i class="c-icon boschicon-bosch-ic-wrench"
                            title="app Widgets"></i>
                        <p class="card_text"><span data-i18n="menu2">
                            </span><i class="d-icon arrow boschicon-bosch-ic-forward-right"></i></p>
                    </div>
                    <div class="card" id="3" role="button" onclick="openNps()"><i
                            class="c-icon boschicon-bosch-ic-wishlist" title="NPS survey"></i>
                        <p class="card_text"><span data-i18n="menu3">
                            </span><i class="d-icon arrow boschicon-bosch-ic-forward-right"></i></p>
                    </div>
                    <div class="card" id="4" role="button" onclick="openLive()"><i
                            class="c-icon boschicon-bosch-ic-radiotower"></i>
                        <p class="card_text"><span data-i18n="menu4">
                            </span><i class="d-icon arrow boschicon-bosch-ic-forward-right"></i></p>
                    </div>
                    <div class="card" id="5" role="button" onclick="openView()"><i
                            class="c-icon boschicon-bosch-ic-desktop-graph-search"></i>
                        <p class="card_text"><span data-i18n="menu5">
                            </span><i class="d-icon arrow boschicon-bosch-ic-forward-right"></i></p>
                    </div>
                    <div class="card" id="6" role="button" onclick="openInformation()"><i
                            class="c-icon ui-ic-alert-info"></i>
                        <p class="card_text"><span data-i18n="menu6">
                            </span><i class="d-icon arrow boschicon-bosch-ic-forward-right"></i></p>
                    </div>
                </section>
                <section id="admin_card" class="card_section lower" style="margin-top: 20px;">
                    <div class="card" id="7" role="button" onclick="openDownloadNPS()"><i
                            class="c-icon boschicon-bosch-ic-download-frame" title="presenca"></i>
                        <p class="card_text"><span data-i18n="menu7">
                            </span><i class="d-icon arrow boschicon-bosch-ic-forward-right"></i></p>
                    </div>
                    <div class="card" id="8" role="button" onclick="openEvents()"><i
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

        // FORM ELEMENTS
        const loginForm = document.getElementById("login_form");
        const trainingForm = document.getElementById('training_form');
        const discForm = document.getElementById('disc_form');
        const loginError = document.getElementById("loginError");
        const discError = document.getElementById("discError");
        const trainingError = document.getElementById("trainingError");
        const trainingSelect = document.getElementById('trainingSelect');
        const title = document.querySelector(".course_name");
        const allCards = document.querySelectorAll('.card');
        const lang_option = document.getElementById("demo");

        let pendingEmail;

        /*========== CARD STATE FUNCTIONS ==========*/
        // Card IDs that must always be enabled
        const alwaysEnabledCards = ['2', '6'];
        // Card IDs that must always be disabled initially
        const alwaysDisabledCards = ['1', '3', '4', '5', '6', '7', '8'];
        // Function to set the initial state of cards based on session data
        function setInitialCardState(accessibleCards, userRole) {
            if (!accessibleCards) {
                console.error('Session data is missing or invalid.');
                alert('Session data is missing or invalid.');
                return;
            }
            // Ensure the accessibleCards array is valid
            const accessibleCardsList = accessibleCards || [];

            allCards.forEach(card => {
                const cardId = card.id; // Get the card's ID from its HTML attribute
                if (alwaysEnabledCards.includes(cardId) || accessibleCardsList.includes(cardId)) {
                    // Ensure the card is enabled
                    card.removeAttribute('disabled');
                } else if (alwaysDisabledCards.includes(cardId)) {
                    // Ensure the card is disabled
                    card.setAttribute('disabled', 'true');
                }
            });
            // Special logic for admin role (if needed)
            if (userRole === 'admin') {
                document.getElementById('admin_card').classList.remove('lower');
            }
        }

        // Function to set the title based on session data
        function setInitialTitleState(trainingName) {
            if (trainingName) {
                title.innerText = trainingName;
            } else {
                title.innerText = "No course selected";
            }
        }

        /*========== END OF CARD STATE FUNCTIONS ==========*/

        /*========== DIALOG FUNCTIONS ==========*/

        // handle open login dialog
        document.getElementById('login_btn').addEventListener('click', () => {
            showDialog('login-dialog');
        });

        // handle open widget dialog
        document.getElementById('2').addEventListener('click', () => {
            showDialog('widget-dialog');
        });

        /*========== END OF LOGIN DIALOG FUNCTIONS ==========*/

        /*========== LOGOUT FUNCTIONS ==========*/

        // Add event listener for logout action
        const logoutButton = document.getElementById("logout_btn"); // Adjust ID as necessary
        logoutButton.addEventListener("click", function() {
            // Perform logout via fetch
            fetch("logout.php")
                .then((response) => {
                    if (response.ok) {
                        // Reset UI state
                        resetUIState();

                        // Reload the page to ensure no stale data
                        location.reload();
                    } else {
                        console.error("Logout failed");
                        alert("Logout failed");
                    }
                })
                .catch((err) => {
                    console.error("Error during logout:", err);
                    alert("Error during logout:", err);
                });
        });

        /*========== END OF LOGOUT FUNCTIONS ==========*/

        /*========== LOGIN FORM FUNCTIONS ==========*/

        // Phase 1: email only
        loginForm.addEventListener('submit', async e => {
            e.preventDefault();
            loginError.textContent = '';
            pendingEmail = loginForm.email_input.value.trim();

            try {
                const data = await postForm(loginForm);
                console.log(data);
                switch (data.status) {
                    case 'success':
                        // student immediate success
                        applyLogin(data);
                        break;
                    case 'teacher':
                        // populate and open Training dialog
                        populateTraining(data.events);
                        break;
                    case 'needRegistration':
                    case 'needNewUser':
                        // open Disclaimer dialog
                        discError.textContent = data.status === 'needNewUser' ?
                            'New user: enter code & accept terms' :
                            'Please enter code & accept terms';
                        showDialog('disc-dialog');
                        break;
                    default:
                        loginError.textContent = data.message || 'Unexpected error';
                }
            } catch (err) {
                loginError.textContent = 'Network error, try again';
                console.error(err);
            }
        });

        // Phase 2a: trainer picks session
        trainingForm.addEventListener('submit', async e => {
            e.preventDefault();
            trainingError.textContent = '';

            document.getElementById('trainingEmail').value = pendingEmail;

            try {
                const data = await postForm(trainingForm);
                if (data.status === 'success') {
                    applyLogin(data); 
                } else {
                    trainingError.textContent = data.message || 'Selection failed';
                }
            } catch (err) {
                trainingError.textContent = 'Network error';
            }
        });

        // Phase 2b: student enters code + T&C
        discForm.addEventListener('submit', async e => {
            e.preventDefault();
            discError.textContent = '';

            try {
                discForm.email_input = pendingEmail;
                const data = await postForm(discForm);
                if (data.status === 'success') applyLogin(data);
                else discError.textContent = data.message || 'Registration failed';
            } catch (err) {
                discError.textContent = 'Network error';
            }
        });

        // Common apply after final success
        function applyLogin(data) {
            // set cards + title from data.accessible_cards, data.role, data.training_name
            setInitialCardState(data.accessible_cards, data.role);
            setInitialTitleState(data.training_name);
            closeAllDialogs();
        }

        // Helpers to open/populate dialogs
        function populateTraining(events) {
            const sel = document.getElementById('trainingSelect');
            sel.innerHTML = `<option value="">Select…</option>` +
                events.map(ev =>
                    `<option value="${ev.training_id}">${ev.training_id} - ${ev.training_name}</option>`
                ).join('');
            showDialog('training-dialog');
        }

        function showDialog(id) {
            document.getElementById(id).showModal();
        }

        function closeAllDialogs() {
            ['login-dialog', 'training-dialog', 'disc-dialog', 'widget-dialog']
            .forEach(id => document.getElementById(id).close());
        }

        // Wire cancel buttons
        ['loginCancel', 'trainingCancel', 'discCancel', 'widgetCancel'].forEach(btnId => {
            document.getElementById(btnId)
                .addEventListener('click', () => closeAllDialogs());
        });


        /*========== END OF LOGIN FORM FUNCTIONS ==========*/

        /*========== INITIAL STATE FUNCTIONS ==========*/

        // Initial page setup
        const initialAccessibleCards = <?php echo json_encode($_SESSION['accessible_cards']); ?>;
        const initialTrainingName = "<?php echo $_SESSION['training_name']; ?>";
        const initialUserRole = "<?php echo $_SESSION['user_role']; ?>";

        setInitialCardState(initialAccessibleCards, initialUserRole);
        setInitialTitleState(initialTrainingName);
        console.log('second log: ' + initialAccessibleCards, initialUserRole, initialTrainingName);

        function resetUIState() {
            // Clear cards and titles
            setInitialCardState([], null);
            setInitialTitleState("");
            console.log("UI state reset");
        }
    });

    /*========== END OF INITIAL STATE FUNCTIONS ==========*/

    /* ========== COMMON FORM POSTING FUNCTION ===========*/

    async function postForm(formEl) {
        const resp = await fetch(formEl.action, {
            method: 'POST',
            body: new URLSearchParams(new FormData(formEl))
        });
        if (!resp.ok) throw new Error(`Network ${resp.status}`);
        return resp.json();
    }

    /* =========== END OF COMMON POSTING FUNCTION ===========*/

    /* =========== Navigation functions =========== */
    function openUnit() {
        location.href = "../../widgets/uc/unitConverter.php";
    }

    function openDictionary() {
        location.href = "../../widgets/dic/technicalDictionary.php";
    }

    function openAbreviation() {
        location.href = "../../widgets/acron/abbreviations.php";
    }

    function openNps() {
        location.href = "nps.php";
    }

    function openDiagram() {
        location.href = "../../widgets/diag/diagram.php";
    }

    function openMaterial() {
        location.href = "material.php";
    }

    function openEvents() {
        location.href = "event.php";
    }

    function openDownloadNPS() {
        location.href = "export.php";
    }

    function openInformation() {
        location.href = "info.php";
    }

    function openLive() {
        location.href = "livecast.php"
    }

    function openView() {
        location.href = 'viewstream.php'
    }


    /* ========== LANGUAGE SETTINGS ========== */
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
        if (localStorage.getItem("language") === "pt") {
            selLanguage.options[0].defaultSelected = true;
        } else if (localStorage.getItem("language") === "en") {
            selLanguage.options[1].defaultSelected = true;
        } else if (localStorage.getItem("language") === "es") {
            selLanguage.options[2].defaultSelected = true;
        } else {
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

    /*========== END OF LANGUAGE SETTINGS ==========*/

    /*========== EMAIL INPUT FUNCTIONS ==========*/
    // Enhanced email domain autofill
    const domains = [
        'gmail.com',
        'yahoo.com',
        'outlook.com',
        'hotmail.com',
        'br.bosch.com',
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


    /*========== END OF EMAIL INPUT FUNCTIONS ==========*/
</script>

</html>