<?PHP

require('config.php'); // Include the database connection and session handling

ini_set('display_errors', 0);
error_reporting(0);

//AJAX handling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'fetch_trainings') {
            // Fetch training data
            try {
                $stmt = $pdo->prepare("SELECT training_id, training_name FROM training");
                $stmt->execute();
                $trainings = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($trainings);
            } catch (PDOException $e) {
                echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
            }
            exit;
        } elseif ($_POST['action'] === 'create_event') {
            // Create new event
            $trainingId = $_POST['training_id'] ?? null;
            $startDate = $_POST['start_date'] ?? null;
            $endDate = $_POST['end_date'] ?? null;

            if (!$trainingId || !$startDate || !$endDate) {
                echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
                exit;
            }

            // Ensure date format is yyyy-mm-dd
            $startDate = date('Y-m-d', strtotime($startDate));
            $endDate = date('Y-m-d', strtotime($endDate));

            try {
                $stmt = $pdo->prepare("INSERT INTO event (training_id, start_date, end_date) VALUES (:training_id, :start_date, :end_date)");
                $stmt->bindParam(':training_id', $trainingId);
                $stmt->bindParam(':start_date', $startDate);
                $stmt->bindParam(':end_date', $endDate);
                $stmt->execute();
                echo json_encode(['status' => 'success', 'message' => 'Event created successfully!']);
                exit();
            } catch (PDOException $e) {
                echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
                exit();
            }
        } elseif ($_POST['action'] === 'create_training') {
            // Create new training
            $baseCode = $_POST['base_code'] ?? null;
            $trainingName = $_POST['training_name'] ?? null;

            if (!$baseCode || !$trainingName) {
                echo json_encode(['status' => 'error', 'message' => 'Both code and training name are required.']);
                exit;
            }

            try {
                // Query to find the highest existing code starting with the base code
                $stmt = $pdo->prepare("SELECT training_id FROM training WHERE training_id LIKE :base_code ORDER BY training_id DESC LIMIT 1");
                $stmt->bindValue(':base_code', $baseCode . '%');
                $stmt->execute();
                $lastTrainingId = $stmt->fetchColumn();

                // Determine the next code
                $nextSuffix = 1;
                if ($lastTrainingId) {
                    $numericPart = substr($lastTrainingId, strlen($baseCode));
                    $nextSuffix = is_numeric($numericPart) ? intval($numericPart) + 1 : 1;
                }
                $newTrainingId = $baseCode . str_pad($nextSuffix, strlen($numericPart), '0', STR_PAD_LEFT);

                // Insert the new training
                $insertStmt = $pdo->prepare("INSERT INTO training (training_id, training_name) VALUES (:training_id, :training_name)");
                $insertStmt->bindParam(':training_id', $newTrainingId);
                $insertStmt->bindParam(':training_name', $trainingName);
                $insertStmt->execute();

                echo json_encode(['status' => 'success', 'message' => 'Training created successfully!', 'new_training_id' => $newTrainingId]);
                exit;
            } catch (PDOException $e) {
                echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
                exit;
            }
        }
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
    <title>CTA | T.A. EVENTS</title>
</head>

<style>
    body {
        overflow: hidden;
    }

    .main_container {
        height: calc(100vh - 70px - 70px);
        /* Full height minus header (70px) and footer (70px) */
        display: flex;
        flex-direction: column;
        overflow-y: auto;
        /* Allow vertical scrolling */
        padding-bottom: 20px;
    }

    #index_container {
        flex-grow: 1;
        /* Allow it to grow and fill the available space */
        display: flex;
        flex-direction: column;
        /* Ensure it stacks its children vertically */
        margin-bottom: 70px;
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

    .a-date-input {
        display: flex;
        height: 3rem;
        min-width: 8.5rem;
        position: relative;
        width: auto;
    }

    .a-date-input label {
        font-size: .75rem;
        margin: .25rem 1rem auto;
        max-width: calc(100% - 5rem);
        overflow: hidden;
        position: absolute;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .a-date-input label+input {
        padding-bottom: .3125rem;
        padding-top: 1.125rem;
    }

    .a-date-input input {
        text-transform: uppercase;
    }

    .a-date-input input {
        background-color: var(--neutral__enabled__fill__default);
        border: none;
        border-bottom: .0625rem solid var(--neutral__enabled__front__default);
        color: var(--neutral__enabled__front__default);
        height: 3rem;
        padding: 0 1rem;
        width: 100%;
    }

    .a-date-input__button,
    .a-date-input__icon-close,
    .a-date-input__icon-password,
    .a-date-input__icon-search,
    .a-date-input__minus-button,
    .a-date-input__plus-button {
        align-items: center;
        background-color: var(--neutral__enabled__fill__default);
        border-bottom: .0625rem solid var(--neutral__enabled__front__default);
        color: var(--neutral__enabled__front__default);
        display: inline-flex;
        height: 3rem;
        justify-content: center;
        width: 3rem;
    }

    input[type="date"] {
        appearance: none;
        /* Remove default styling */
        -webkit-appearance: none;
        /* Remove for Safari */
        -moz-appearance: none;
        /* Remove for Firefox */
    }

    /* Optional: Add a custom calendar icon as a background */
    input[type="date"]::-webkit-calendar-picker-indicator {
        display: none;
        /* Hide the default calendar icon */
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
                    </div>
                    <div class="o-header__search">
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
                            <a href="login.php" target="_self">
                                <span></span>
                                <span>
                                    Home
                                    <i class="a-icon ui-ic-nosafe-lr-right-small"></i>
                                </span>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="a-link -icon">
                            <a href="/" target="_self">
                                <span>Event</span>
                                <span>
                                    update
                                    <i class="a-icon ui-ic-nosafe-lr-right-small"></i>
                                </span>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="a-link -icon">
                            <a href="/" target="_self">
                                <span></span>
                                <span>

                                    <i class="a-icon ui-ic-nosafe-lr-right-small"></i>
                                </span>
                            </a>
                        </div>
                    </li>
                </ol>
                <span class="o-header__subbrand">Training App - Events</span>
            </div>
        </div>
        <div class="o-header__navigation-container">
            <div class="e-container">
                <nav class="o-header__navigation" aria-label="Main navigation">
                    <ul class="o-header__navigation-first-level" role="menu">
                        <li class="o-header__navigation-first-level-item" role="menuitem">
                            <button
                                type="button"
                                class="a-button a-button--integrated -without-icon o-header__navigation-trigger"
                                aria-haspopup="true"
                                aria-expanded="false"
                                tabindex="0">
                                <span class="a-button__label">Other trainings</span>
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
                                id="menu_btn">
                                <span class="a-button__label">Main menu</span>
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
                        <li class="o-header__language-selector" role="menuitem">
                            <div class="m-language-selector">
                                <div class="a-link -icon">
                                    <a
                                        href="https://www.bosch.com/websites-worldwide/"
                                        target="_blank">
                                        <i class="a-icon boschicon-bosch-ic-globe"></i>
                                        <span>Language</span>
                                    </a>
                                </div>
                                <div class="a-dropdown">
                                    <select
                                        id="demo"
                                        aria-label="here goes the aria label for the dropwdown">
                                        <option value='Portuguese'>Portuguese</option>
                                        <option value='English'>English</option>
                                        <option value='Espanol'>Espanol</option>
                                    </select>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <main>
        <div class="main_container">
            <div id="index_container" class="i_container">
                <h3>Events & Trainings</h3>
                <h4>Event updates</h4>
                <form>
                    <h5 style="margin-top: 0;">Select training and training dates</h5>
                    <div class="o-form__row">
                        <div class="m-form-field -half">
                            <div class="a-dropdown">
                                <label for="training1">Select training</label>
                                <select id="training1" aria-label="training code and name">
                                    <option value="" disabled selected>Select an option</option>
                                </select>
                            </div>
                        </div>
                        <div class="m-form-field -quarter">
                            <div class="a-date-input">
                                <label for="date-input-1">Start date:</label>
                                <input type="date" id="date-input-1" name="training_start_date" />
                                <button type="button" class="a-date-input__button" id="open_start_date">
                                    <i class="a-icon boschicon-bosch-ic-calendar-clock"></i>
                                </button>
                            </div>
                        </div>
                        <div class="m-form-field -quarter">
                            <div class="a-date-input">
                                <label for="date-input-2">End date:</label>
                                <input type="date" id="date-input-2" name="training_end_date" />
                                <button type="button" class="a-date-input__button" id="open_end_date">
                                    <i class="a-icon boschicon-bosch-ic-calendar-clock"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="a-button a-button--primary -without-icon" id="event_btn">
                        <span class="a-button__label">Create event</span>
                    </button>
                </form>
                <h4>Training updates</h4>
                <form>
                    <h5 style="margin-top: 0;">Select training code and define training name</h5>
                    <div class="o-form__row">
                        <div class="m-form-field -quarter">
                            <div class="a-dropdown">
                                <label for="training2">Training code</label>
                                <select id="training2" aria-label="new training code">
                                    <option value="" disabled selected>Select an option</option>
                                    <option value="5001">TREINAMENTO CUSTOMIZADO BR</option>
                                    <option value="5002">TREINAMENTO CUSTOMIZADO WLA</option>
                                    <option value="5010">TREINAMENTO CUSTOMIZADO INTC</option>
                                    <option value="7003">CONSULTORIA AUTOMOTIVA INTC</option>
                                    <option value="7010">MASTER EM DIAGNOSE AUTOMOTIVA</option>
                                    <option value="7011">MASTER R</option>
                                    <option value="7023">MISSAO EMPRESARIAL BR-WLA</option>
                                    <option value="7024">MISSAO EMPRESARIAL INTERNACIONAL</option>
                                </select>
                            </div>
                        </div>
                        <div class="m-form-field -half">
                            <div class="a-text-field">
                                <label for="new-training">Label</label>
                                <input
                                    type="text"
                                    id="new-training"
                                    name="new training name"
                                    value=""
                                    placeholder="New training name" />
                            </div>
                        </div>
                    </div>
                    <button
                        type="submit" class="a-button a-button--primary -without-icon" id="training_btn">
                        <span class="a-button__label">New training</span>
                    </button>
                </form>
            </div>
        </div>
    </main>
    <footer class="o-footer -minimal footer">
        <hr class="a-divider" />
        <div class="e-container">
            <div class="o-footer__bottom">
                <ul class="o-footer__links">
                    <li>
                        <div class="a-link a-link--integrated">
                            <a href="#" target="_self"><span>Imprint</span></a>
                        </div>
                    </li>
                    <li>
                        <div class="a-link a-link--integrated">
                            <a href="#" target="_self"><span>Legal information</span></a>
                        </div>
                    </li>
                    <li>
                        <div class="a-link a-link--integrated">
                            <a href="#" target="_self"><span>Data privacy</span></a>
                        </div>
                    </li>
                    <li>
                        <div class="a-link a-link--integrated">
                            <a href="#" target="_self"><span>Disclosure documents</span></a>
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
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const trainingDropdown = document.getElementById('training1');
        const createEventButton = document.getElementById('event_btn');

        // Fetch training data and populate dropdown
        fetch('event.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'fetch_trainings'
                }).toString(),
            })
            .then((response) => response.json())
            .then((data) => {
                if (Array.isArray(data)) {
                    data.forEach((training) => {
                        const option = document.createElement('option');
                        option.value = training.training_id; // Use training_id as the value
                        option.textContent = `${training.training_id} - ${training.training_name}`; // Display both ID and name
                        trainingDropdown.appendChild(option);
                    });
                } else {
                    console.error('Error fetching training data:', data.error);
                }
            })
            .catch((err) => {
                console.error('Fetch error:', err);
            });

        // Handle event creation
        createEventButton.addEventListener('click', function() {
            const selectedTraining = trainingDropdown.value;
            const startDate = document.getElementById('date-input-1').value;
            const endDate = document.getElementById('date-input-2').value;

            // Validate fields
            if (!selectedTraining || !startDate || !endDate) {
                alert('Please fill in all required fields.');
                return;
            }

            // Submit event data
            fetch('event.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        action: 'create_event',
                        training_id: selectedTraining,
                        start_date: startDate,
                        end_date: endDate,
                    }).toString(),
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.status === 'success') {
                        alert(data.message);
                        // Optionally reset the form
                        document.querySelector('form').reset();
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch((err) => {
                    console.error('Error submitting event:', err);
                    alert('An unexpected error occurred. Please try again.');
                });
        });

        document.getElementById('training_btn').addEventListener('click', function() {
            const baseCode = document.getElementById('training2').value;
            const trainingName = document.getElementById('new-training').value;

            if (!baseCode || !trainingName) {
                alert('Please fill in both the training code and name.');
                return;
            }

            fetch('event.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        action: 'create_training',
                        base_code: baseCode,
                        training_name: trainingName,
                    }).toString(),
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.status === 'success') {
                        alert(`Training created successfully with ID: ${data.new_training_id}`);
                        document.getElementById('training_form').reset();
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch((err) => {
                    console.error('Error:', err);
                    alert('An unexpected error occurred. Please try again.');
                });
        });

        document.getElementById('menu_btn').addEventListener('click', () => {
            location.href = 'login.php';
        });

        // Add event listener for logout action
        const logoutButton = document.getElementById("logout_btn"); // Adjust ID as necessary
        logoutButton.addEventListener("click", function() {
            // Perform logout via fetch
            fetch("logout.php")
                .then((response) => {
                    if (response.ok) {
                        // Reset UI state
                        location.href = 'login.php';
                    } else {
                        console.error("Logout failed");
                    }
                })
                .catch((err) => {
                    console.error("Error during logout:", err);
                });
        });


    });

    document.getElementById("open_start_date").addEventListener("click", function() {
        const dateInput = document.getElementById("date-input-1");
        dateInput.showPicker(); // Use the showPicker method for modern browsers
    });

    // Fallback for browsers that don't support showPicker
    document.getElementById("open_start_date").addEventListener("click", function() {
        const dateInput = document.getElementById("date-input-1");
        dateInput.focus(); // Focus the input field
        dateInput.click(); // Simulate a click on the input
    });

    document.getElementById("open_end_date").addEventListener("click", function() {
        const dateInput = document.getElementById("date-input-2");
        dateInput.showPicker(); // Use the showPicker method for modern browsers
    });

    // Fallback for browsers that don't support showPicker
    document.getElementById("open_end_date").addEventListener("click", function() {
        const dateInput = document.getElementById("date-input-2");
        dateInput.focus(); // Focus the input field
        dateInput.click(); // Simulate a click on the input
    });
</script>

</html>