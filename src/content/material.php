<?PHP

require_once('config.php'); // Include the database connection and session handling

// Only process AJAX requests
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    try {
        // Ensure session variables are set
        if (!isset($_SESSION['training_id']) || !isset($_SESSION['training_name'])) {
            echo json_encode(['error' => 'Session variables are not set.']);
            exit;
        }

        $training_id = $_SESSION['training_id'];
        $training_name = $_SESSION['training_name'];
        $resultData = [];

        if ($training_id === 9999) {
            $stmt = $pdo->prepare("SELECT * FROM training_material");
            $stmt->execute();
        } else {
            $stmt = $pdo->prepare("SELECT * FROM training_material WHERE training_id = :training_id");
            $stmt->execute([':training_id' => $training_id]);
        }
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($resultData);
        exit;
    } catch (Exception $e) {
        echo json_encode(['error' => 'Server error: ' . $e->getMessage()]);
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
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="imagetoolbar" content="no" />
    <meta name="rating" content="general" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="copyright" content="© Robert Bosch Ltda." />
    <meta name="keywords" content="Bosch, Technical training, Techical training center, Mechanics">
    <link rel="icon" type="image/x-icon" href="../style/resources/favicon.ico" />
    <link rel="stylesheet" href="../style/style.css">
    <script defer="" src="../js/main.js"></script>
    <title>CTA | TA Materials</title>
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

    .table_container {
        flex-grow: 1;
        /* Allow the table container to take up remaining space */
        overflow-y: auto;
        /* Enable vertical scrolling for the table */
        margin-top: 20px;
        max-height: 60vh;
        /* Set a maximum height (e.g., 60% of the viewport height) */
    }


    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    /* DIALOG STYLING */

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

    .a-button--primary {
        background-color: var(--dock-primary-button-color,
                var(--bosch-blue-50)) !important;
        color: var(--dock-primary-button-text-color, white) !important;
        border-color: var(--dock-primary-button-border-color, none) !important;
        border-radius: var(--dock-primary-button-border-radius, none) !important;
    }

    .a-button--primary:hover {
        background-color: var(--dock-primary-button-hover-color,
                var(--bosch-blue-40)) !important;
        color: var(--dock-primary-button-text-hover-color, white) !important;
        border-color: var(--dock-primary-button-border-hover-color,
                none) !important;
    }

    .a-button--secondary {
        background-color: var(--dock-secondary-button-color, none) !important;
        color: var(--dock-secondary-button-text-color,
                var(--bosch-blue-50)) !important;
        border-color: var(--dock-secondary-button-border-color,
                var(--bosch-blue-50)) !important;
        border-radius: var(--dock-secondary-button-border-radius,
                none) !important;
    }

    .a-button--secondary:hover {
        background-color: var(--dock-secondary-button-hover-color,
                var(--bosch-blue-90)) !important;
        color: var(--dock-secondary-button-text-hover-color,
                var(--bosch-blue-40)) !important;
        border-color: var(--dock-secondary-button-border-hover-color,
                var(--bosch-blue-40)) !important;
    }

    .a-button--tertiary {
        background-color: var(--dock-tertiary-button-color, none) !important;
        color: var(--dock-tertiary-button-text-color,
                var(--bosch-blue-50)) !important;
        border-color: var(--dock-tertiary-button-border-color, none) !important;
        border-radius: var(--dock-tertiary-button-border-radius, none) !important;
    }

    .a-button--tertiary:hover {
        background-color: var(--dock-tertiary-button-hover-color,
                var(--bosch-blue-90)) !important;
        color: var(--dock-tertiary-button-text-hover-color,
                var(--bosch-blue-40)) !important;
        border-color: var(--dock-secondary-button-border-hover-color,
                none) !important;
    }

    .a-link--simple a,
    .a-link--primary a {
        display: -ms-flexbox;
        display: flex;
    }

    .a-link {
        text-decoration: none;
        color: var(--minor-accent__enabled__front__default);
    }

    .small-print-link {
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
        text-decoration: underline;
        color: var(--dock-small-print-link-color,
                var(--bosch-blue-50)) !important;
    }

    .small-print-link:hover {
        color: var(--dock-small-print-link-hover-color,
                var(--bosch-blue-40)) !important;
    }

    .a-checkbox input[type="checkbox"]:checked+label::after {
        background-color: var(--dock-checkbox-color,
                var(--bosch-blue-50)) !important;
    }

    .a-checkbox input[type="checkbox"]:checked:hover+label::after {
        background-color: var(--dock-checkbox-hover-color,
                var(--bosch-blue-40)) !important;
    }

    .a-link {
        color: var(--dock-link-color, var(--bosch-blue-50)) !important;
    }

    .a-link--simple a,
    .a-link--simple a:visited,
    .a-link--primary a,
    .a-link--primary a:visited {
        text-decoration: none !important;
    }

    .a-link:hover {
        color: var(--dock-link-hover-color, var(--bosch-blue-40)) !important;
    }

    .a-link--primary a::after {
        content: "";
        border-top: 0.0625rem solid currentColor;
        border-right: 0.0625rem solid currentColor;
        position: relative;
        width: 0.5em;
        height: 0.5em;
        margin-left: 0.25em;
        -webkit-transform: translateY(0.465em) rotate(45deg);
        transform: translateY(0.465em) rotate(45deg);
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

    .small-print-link {
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

    /* END OF DIALOG STYLING */
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
                                <span>Course</span>
                                <span>
                                    materials
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
                <span class="o-header__subbrand" data-i18n="NPS_title"></span>
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
                                tabindex="0"
                                id="menu_btn">
                                <span class="a-button__label" data-i18n="back_to_main_menu"></span>
                            </button>
                            <i class="a-icon o-header__navigation-arrow ui-ic-right"></i>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main>

        <div class="main_container">

            <!---- TERMS OF USE & DISCLAIMER ----->
            <dialog class="m-dialog" role="dialog" id="dialog">
                <bbg-box class="hydrated">
                    <div class="a-box--modal">
                        <div class="a-box -floating">
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
                                        <div class="m-form-field">
                                            <div class="a-text-field">
                                                <label for="text-input-tn">Email</label>
                                                <input type="text" id="text-input-cpf" />
                                            </div>
                                        </div>
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
                                                        id="marketing"
                                                        style="display: block" />
                                                    <label for="marketing" data-i18n="consent_copyright"></label>
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
                        </div>
                    </div>
                </bbg-box>
            </dialog>
            <!---- END OF TERMS OF USE AND DISCLAIMER DIALOG ----->

            <div id="index_container" class="i_container">
                <h3 data-i18n="nps_inner_title"></h3>
                <h4><span data-i18n="inner_title"></span> <span><?PHP echo $_SESSION['training_id'] . " - " . $_SESSION['training_name'] ?></span></h4>
                <div class="table_container">
                    <table class="m-table" id="training_table">
                        <thead>
                            <tr>
                                <th data-i18n="th1"></th>
                                <th data-i18n="th2"></th>
                                <th data-i18n="h3"></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
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

        disclaimerDialog();

        document.getElementById('decline-all-modal-dialog').addEventListener('click', () => {
            location.href = 'login.php'
        });

        document.getElementById('menu_btn').addEventListener('click', () => {
            location.href = 'login.php';
        });

        fetch('material.php', {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error('Error:', data.error);
                    alert(data.error);
                    return;
                }

                // Get the table body
                const tableBody = document.querySelector('#training_table tbody');

                // Clear existing rows
                tableBody.innerHTML = '';

                // Populate the table with data
                data.forEach(row => {
                    const tr = document.createElement('tr');

                    // Title column
                    const titleTd = document.createElement('td');
                    titleTd.textContent = row.training_id || 'N/A';
                    tr.appendChild(titleTd);

                    // Description column
                    const descriptionTd = document.createElement('td');
                    descriptionTd.textContent = row.material || 'N/A';
                    tr.appendChild(descriptionTd);

                    // Link column
                    const linkTd = document.createElement('td');
                    if (row.link) {
                        linkTd.innerHTML = `
                            <div class='a-link -icon'>
                                <a href='../../material/${row.link}' target='_self'>
                                    <span>Link</span>
                                    <span><i class='a-icon ui-ic-nosafe-lr-right-small' title='nosafe-lr-right-small'></i></span>
                                </a>
                            </div>
                        `;
                    } else {
                        linkTd.textContent = 'No File';
                    }
                    tr.appendChild(linkTd);

                    // Append the row to the table
                    tableBody.appendChild(tr);
                });
            })
            .catch(err => {
                console.error('Error fetching data:', err);
            });
    });

    function disclaimerDialog() {
        const discDialog = document.querySelector(".a-box--modal");
        discDialog.classList.add('-show');
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