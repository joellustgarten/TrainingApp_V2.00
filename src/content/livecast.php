<?php
require_once('config.php');
$room = 'training123';
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
    <meta name="keywords" content="Bosch, Technical training, Technical training center, Mechanics">
    <link rel="icon" type="image/x-icon" href="../style/resources/favicon.ico" />
    <link rel="stylesheet" href="../style/style.css">
    <script defer="" src="../js/main.js"></script>
    <title>CTA | Training App</title>

</head>
<style>
    /* testing new layout
    body {
        overflow: hidden;
        margin: 0;
    }

    main {
        height: calc(100vh - 161px);
    }

    .main_container {
        height: calc(100vh - 161px);
        display: flex;
        flex-direction: column;
        overflow-y: auto;
    }

    #index_container {

        display: flex;
        flex-direction: column;
        width: 75vw;
        background-color: blue;
    }

    .footer {
        position: sticky;
        bottom: 0;
        background-color: var(--bosch-white);
        z-index: 10;
    }

    @media (min-width: 992px) {
        #index_container {
            margin: auto
        }
    }

    @media (max-height: 780px) {
        #index_container {
            margin-bottom: 50px;
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

    .stream_btn {
        position: absolute;
    }

    .stream_btn button {
        margin: 0 150px 20px 0;
    }

    .stream_btn button:first-child {
        margin: 0 30px 20px 0;
    }

    */

    body,
    html {
        height: 100%;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }

    main,
    .main_container,
    #index_container {
        height: 100%;
        min-height: 0;
        min-width: 0;
    }

    main {
        display: flex;
        flex-direction: column;
        height: calc(100vh - 161px);
        /* adjust if header/footer size changes */
    }

    .main_container {
        flex: 1 1 auto;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    #index_container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100vw;
        height: 100%;
        background: none;
        /* remove blue for production */
        padding: 0;
        margin: 0;
    }

    #localVideo {
        width: 100vw;
        height: 100%;
        max-width: 100vw;
        max-height: 100%;
        object-fit: contain;
        /* or cover, depending on your preference */
        background: #000;
        display: block;
    }

    @media (max-width: 768px) {
        #index_container {
            width: 100vw;
            padding: 0;
        }

        #localVideo {
            width: 100vw;
            height: 100vw;
            max-height: 60vh;
        }
    }

    @media (max-height: 600px) {

        main,
        .main_container,
        #index_container {
            height: 100vh;
        }

        #localVideo {
            max-height: 60vh;
        }
    }

    .stream_btn {
        position: absolute;
        bottom: 40px;
        right: 20px;
        display: flex;
        gap: 10px;
        z-index: 2;
        padding: 10px;
        opacity: 0.3;
        transition: opacity 0.3s ease;
        /* fade-in effect */
    }

    .footer {
        position: sticky;
        bottom: 0;
        background-color: var(--bosch-white);
        z-index: 10;
    }

    .btn_function_active {
        background-color: var(--major-accent__disabled__fill__default);
        color: var(--major-accent__disabled__front__default);
    }

    .a-button--primary:hover {
        color: var(--major-accent__enabled__front__default);
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
                                <span>Livestream </span>
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
                                <span>

                                    <i class="a-icon ui-ic-nosafe-lr-right-small"></i>
                                </span>
                            </a>
                        </div>
                    </li>
                </ol>
                <span class="o-header__subbrand">Training App - Livestream</span>
            </div>
        </div>
        <div class="o-header__navigation-container">
            <div class="e-container">
                <nav class="o-header__navigation" aria-label="Main navigation">
                    <ul class="o-header__navigation-first-level" role="menu" style="padding-bottom: 1rem;">
                        <li class="o-header__navigation-first-level-item" role="menuitem">
                            <button
                                type="button"
                                class="a-button a-button--integrated -without-icon full fullscreen-active o-header__navigation-trigger"
                                aria-haspopup="true"
                                aria-expanded="false"
                                tabindex="0"
                                id="menu_btn">
                                <span class="a-button__label" data-i18n="back_to_main_menu"></span>
                            </button>
                            <i class="a-icon o-header__navigation-arrow ui-ic-right"></i>
                        </li>
                    </ul>
                </nav>
                <hr>
            </div>
        </div>
    </header>
    <main>
        <div class="main_container">
            <div id="index_container" class="i_container">
                <video id="localVideo" autoplay muted style="width:100%"></video>
                <div class="stream_btn">
                    <button type="button" id="startBtn" name="livecast" class="a-button a-button--primary -without-icon">
                        <span class="a-button__label" style="padding-right: 0.85rem;" data-i18n="livecast_btn"></span>
                    </button>
                    <button type="button" id="fullscreen_btn" name="fullscreen" class="a-button a-button--primary -without-icon">
                        <span class="a-button__label" style="padding-right: 0.85rem;" data-i18n="fullscreen"></span>
                    </button>
                </div>
            </div>

        </div>
    </main>
    <!-------------FOOTER------------------------->
    <footer class="o-footer -minimal footer">
        <hr class="a-divider" />
        <div class="e-container">
            <div class="o-footer__bottom">
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
    window.SIGNALING = `http://${window.location.hostname}:3000`;
    window.ROOM = <?= json_encode($room) ?>;
</script>
<script src="http://localhost:3000/socket.io/socket.io.js"></script>
<script src="../js/livecast.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        document.getElementById('menu_btn').addEventListener('click', () => {
            location.href = 'login.php';
        });

    });

    async function fetchLanguageData(lang) {
        const response = await fetch(`../../languages/${lang}.json`);
        return response.json();
    }


    // Function to update content based on selected language
    function updateContent(langData) {
        document.querySelectorAll("[data-i18n]").forEach((element) => {
            const key = element.getAttribute("data-i18n");
            element.textContent = langData[key];
        });
    }

    // Call updateContent() on page load
    window.addEventListener("DOMContentLoaded", async () => {
        const userPreferredLanguage = localStorage.getItem("language") || "pt";
        const langData = await fetchLanguageData(userPreferredLanguage);
        updateContent(langData);
    });


    document.getElementById('fullscreen_btn').addEventListener('click', function() {
        const indexContainer = document.getElementById('index_container');
        if (!document.fullscreenElement) {
            indexContainer.requestFullscreen().catch(err => {
                console.error(`Error attempting to enable fullscreen: ${err.message}`);
            });
            this.classList.add('btn_function_active'); // Add class when entering fullscreen
        } else {
            document.exitFullscreen();
            this.classList.remove('btn_function_active'); // Remove class when exiting fullscreen
        }
    });
</script>

</html>