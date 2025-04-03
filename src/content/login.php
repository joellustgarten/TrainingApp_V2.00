<?php

require_once('config.php'); // Include the database connection and session handling

// Initialize variables for the session data
$userRole = '';
$trainingId = '';
$trainingName = '';
$accessibleCards = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['course_code'])) {
    $course_code = trim($_POST['course_code']);

    try {
        // Query to check active events for the training code
        $stmt = $pdo->prepare("
        SELECT t.training_id, t.training_name, e.start_date, e.end_date 
        FROM training t
        LEFT JOIN event e ON t.training_id = e.training_id
        WHERE t.training_id = ? AND CURDATE() BETWEEN e.start_date AND e.end_date
    ");
        $stmt->execute([$course_code]);
        $training = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($training && isset($training['training_id'])) {

            // Handle special case for admin (code 9999)
            if ($training['training_id'] === 9999) {
                $_SESSION['user_role'] = 'admin';
                $_SESSION['accessible_cards'] = ['2', '3', '5', '7', '8', '9'];
            } else {
                // Handle standard student login
                $_SESSION['user_role'] = 'student';
                $_SESSION['accessible_cards'] = ['2', '3', '5'];
            }

            $_SESSION['training_id'] = $training['training_id'];
            $_SESSION['training_name'] = $training['training_name']; // TRAININGAPP MANAGEMENT

            // Set variables to be used in JavaScript
            $userRole = $_SESSION['user_role'];
            $trainingId = $_SESSION['training_id'];
            $trainingName = $_SESSION['training_name'];
            $accessibleCards = $_SESSION['accessible_cards'];

            // Send successful response
            echo json_encode([
                'status' => 'success',
                'role' => $userRole,
                'training_id' => $trainingId,
                'training_name' => $trainingName,
                'accessible_cards' => $accessibleCards
            ]);
            exit;
        } else {
            // No active event or invalid training code
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid course code or no active event available.',
            ]);
        }
    } catch (PDOException $e) {
        // Handle database error
        echo json_encode([
            'status' => 'error',
            'message' => 'Database error: ' . $e->getMessage()
        ]);
    }
    exit();
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

</head>
<style>
    body {
        overflow: hidden;
        margin: 0;
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
        background: var(--bosch-white);
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
                            <a href="/" target="_self">
                                <span>Home</span>
                                <span>
                                    <i class="a-icon ui-ic-nosafe-lr-right-small"></i>
                                </span>
                            </a>
                        </div>
                    </li>
                    <!--
                    <li>
                        <div class="a-link -icon">
                            <a href="/" target="_self">
                                <span>Internet of</span>
                                <span>
                                    Things
                                    <i class="a-icon ui-ic-nosafe-lr-right-small"></i>
                                </span>
                            </a>
                        </div>
                    </li>
                    -->
                </ol>
                <span class="o-header__subbrand">Training App - Menu</span>
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
                                id="survey_btn">
                                <span class="a-button__label" data-i18n="pesquiza"></span>
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
            </div>
        </div>
    </header>

    <main style="padding-top: 54px;">

        <dialog
            class="m-dialog -floating-shadow-s -floating"
            id="alert-dialog-info-without-close-button"
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
                        <label for="text-input-code" data-i18n="codigo_curso"></label>
                        <input
                            type="text"
                            id="text-input-code"
                            name="input text with label"
                            value="" />
                    </div>
                    <div class="m-dialog__code"></div>
                    <div class="m-dialog__actions">
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
                    <div class="card" id="1" role="button" onclick="openUnit()"><i
                            class="c-icon boschicon-bosch-ic-calculate" title="unitconverter"></i>
                        <p class="card_text"><span data-i18n="menu1">
                            </span><i class="d-icon arrow boschicon-bosch-ic-forward-right"></i></p>
                    </div>
                    <div class="card" id="2" role="button" onclick="openDictionary()"><i class="c-icon boschicon-bosch-ic-book"
                            title="nps"></i>
                        <p class="card_text"><span data-i18n="menu2">
                            </span><i class="d-icon arrow boschicon-bosch-ic-forward-right"></i></p>
                    </div>
                    <div class="card" id="3" role="button" onclick="openMaterial()"><i
                            class="c-icon boschicon-bosch-ic-board-speaker" title="CourseMaterial"></i>
                        <p class="card_text"><span data-i18n="menu3">
                            </span><i class="d-icon arrow boschicon-bosch-ic-forward-right"></i></p>
                    </div>
                    <div class="card" id="4" role="button" onclick="openDiagram()"><i
                            class="c-icon boschicon-bosch-ic-circuit-hydraulic"></i>
                        <p class="card_text"><span data-i18n="menu4">
                            </span><i class="d-icon arrow boschicon-bosch-ic-forward-right"></i></p>
                    </div>
                    <div class="card" id="5" role="button" onclick="openAbreviation()"><i
                            class="c-icon boschicon-bosch-ic-glossary"></i>
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
    document.addEventListener("DOMContentLoaded", function() {

        const dialog = document.getElementById('alert-dialog-info-without-close-button');
        const form = document.getElementById("login_form");
        const errorMessage = document.querySelector(".m-dialog__code");
        const title = document.querySelector(".course_name");
        const allCards = document.querySelectorAll('.card');
        const lang_option = document.getElementById("demo");

        // Card IDs that must always be enabled
        const alwaysEnabledCards = ['1', '4', '6'];

        // Card IDs that must always be disabled initially
        const alwaysDisabledCards = ['2', '3', '5', '7', '8', '9'];

        // Function to set the initial state of cards based on session data
        function setInitialCardState(accessibleCards, userRole) {
            if (!accessibleCards) {
                console.error('Session data is missing or invalid.');
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

        // handle open login dialog
        document.getElementById('login_btn').addEventListener('click', () => {
            dialog.showModal();
        });

        // handle close login dialog
        document.getElementById('loginCancel').addEventListener('click', () => {
            dialog.close();
        });

        // handle nps click
        document.getElementById('survey_btn').addEventListener('click', () => {
            location.href = 'nps.php';
        });


        function resetUIState() {
            // Clear cards and titles
            setInitialCardState([], null);
            setInitialTitleState("");
            console.log("UI state reset");
        }

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
                    }
                })
                .catch((err) => {
                    console.error("Error during logout:", err);
                });
        });


        // Handle form submission
        form.addEventListener("submit", function(e) {
            e.preventDefault(); // Prevent default form submission

            const courseCode = document.getElementById("text-input-code").value.trim();

            fetch("login.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: `course_code=${encodeURIComponent(courseCode)}`,
                })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Network response was not ok");
                    }
                    return response.json();
                })
                .then((data) => {
                    if (data.status === "success") {
                        // Close dialog and update session data
                        dialog.close();
                        setInitialCardState(data.accessible_cards, data.role);
                        setInitialTitleState(data.training_name);
                        console.log(
                            "Logged in as:",
                            data.role,
                            data.training_id,
                            data.training_name,
                            data.accessible_cards
                        );
                    } else if (data.status === "error") {
                        // Show specific error message
                        errorMessage.innerText = data.message;
                    } else {
                        throw new Error("Unexpected response structure");
                    }
                })
                .catch((err) => {
                    console.error("Error:", err);
                    errorMessage.innerText = "An unexpected error occurred. Please try again.";
                });
        });

        // Initial page setup
        const initialAccessibleCards = <?php echo json_encode($_SESSION['accessible_cards']); ?>;
        const initialTrainingName = "<?php echo $_SESSION['training_name']; ?>";
        const initialUserRole = "<?php echo $_SESSION['user_role']; ?>";

        setInitialCardState(initialAccessibleCards, initialUserRole);
        setInitialTitleState(initialTrainingName);
        console.log('second log: ' + initialAccessibleCards, initialUserRole, initialTrainingName);
    });

    // Navigation functions
    function openUnit() {
        location.href = "../../widgets/uc/unitConverter.php";
    }

    function openDictionary() {
        location.href = "../../widgets/dic/technicalDictionary.php";
    }

    function openAbreviation() {
        location.href = "../../widgets/acron/abbreviations.php";
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
        } else {
            selLanguage.options[0].defaultSelected = true;
        }
    }

    // Function to change language
    async function changeLanguage(lang) {
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