<?PHP

require('config.php'); // Include the database connection and session handling


ini_set('display_errors', 0);
error_reporting(0);

// Check if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize inputs
    $name = !empty($_POST['name']) ? trim($_POST['name']) : null;
    $cpf = !empty($_POST['cpf']) ? trim($_POST['cpf']) : null;
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $telephone = !empty($_POST['telephone']) ? trim($_POST['telephone']) : null;
    $rating = !empty($_POST['rating']) ? (int)$_POST['rating'] : 0;
    $nps = !empty($_POST['nps']) ? (int)$_POST['nps'] : null;
    $comments = !empty($_POST['comments']) ? trim($_POST['comments']) : null;
    $agree = isset($_POST['agree']) ? (int)$_POST['agree'] : 0;  // Checkbox value: 1 if checked, 0 if not

    // Retrieve session variables
    $trainingId = isset($_SESSION['training_id']) ? $_SESSION['training_id'] : null;
    $trainingName = isset($_SESSION['training_name']) ? $_SESSION['training_name'] : null;


    try {
        // Prepare the SQL query to insert data into the database
        $stmt = $pdo->prepare("
            INSERT INTO nps_survey (name, cpf, email, telephone, rating, nps, comments, agree, training_id, training_name)
            VALUES (:name, :cpf, :email, :telephone, :rating, :nps, :comments, :agree, :training_id, :training_name)
        ");

        // Bind parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':nps', $nps);
        $stmt->bindParam(':comments', $comments);
        $stmt->bindParam(':agree', $agree);
        $stmt->bindParam(':training_id', $trainingId);
        $stmt->bindParam(':training_name', $trainingName);

        // Execute the query
        $stmt->execute();

        // Respond with success
        echo json_encode([
            'status' => 'success',
            'message' => 'Survey submitted successfully!'
        ]);
        exit();
    } catch (PDOException $e) {
        // Handle errors
        echo json_encode([
            'status' => 'error',
            'message' => 'Database error: ' . $e->getMessage()
        ]);
        exit();
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
    <meta name="keywords" content="Bosch, Technical training, Technical training center, Mechanics">
    <link rel="icon" type="image/x-icon" href="../style/resources/favicon.ico" />
    <link rel="stylesheet" href="../style/style.css">
    <script defer="" src="../js/main.js"></script>
    <title>CTA | TA NPS</title>

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

    .o-form {
        margin: 1rem 0;
    }

    .main_title {
        text-align: center;
    }

    .a-rating {
        justify-content: center;
    }

    .a-slider {
        width: 70%;
        margin: auto;
        margin-top: 40px;
    }

    .slider-label {
        text-wrap: nowrap;
    }

    /* TEST NEW NPS QUESTIONS */

    .nps-question h5,
    .nps-question-2 h5 {
        font-size: 1.3rem;
        font-weight: 500;
    }

    .nps-question-2,
    .nps-question {
        margin-bottom: 50px;
    }

    .comments h5 {
        margin-bottom: 15px;
    }

    .nps-rating-container {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        margin: 20px auto 0 auto;
        width: 50%;
    }

    /* Style the labels that contain the radio button and number */
    .nps-rating-container label {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border: 1px solid #ccc;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s, border-color 0.3s;
        user-select: none;
    }

    /* Hide the radio buttons */
    .nps-rating-container input[type="radio"] {
        display: none;
    }

    /* Change style when the radio is selected */
    .nps-rating-container input[type="radio"]:checked+span {
        background-color: #007BFF;
        color: white;
        border-color: #007BFF;
    }

    /* Ensure span fills the label */
    .nps-rating-container span {
        display: block;
        width: 100%;
        height: 100%;
        line-height: 40px;
        text-align: center;
    }

    .nps-rating-explanation {
        display: flex;
        justify-content: space-between;
        margin: 5px auto 0 auto;
        /* Adjusts spacing from the edges */
        font-size: 14px;
        color: #666;
        width: 45%;
    }

    .a-rating--large .a-rating__star-container {
        gap: 5rem;
    }

    .a-rating--large .a-rating__label {
        --font-size: 1.3rem;
        --line-height: 1.5;
        font-size: 1.3rem;
        line-height: 1.5;
    }

    .radio-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
        max-width: 800px;
        margin-left: 50px
    }

    .button_container {

        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
    }

    .o-form button[type="submit"] {
        margin: 1rem;
    }

    .a-button.-without-icon .a-button__label {
        padding-right: 2rem;
        padding-left: 2rem;
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
                                <span>NPS</span>
                                <span>
                                    Survey
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
                <span class="o-header__subbrand">Training App - NPS Survey</span>
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
                        <li class="o-header__language-selector" role="menuitem">
                            <div class="m-language-selector">
                                <div class="a-link -icon">
                                    <a
                                        href="#"
                                        target="_blank">
                                        <i class="a-icon boschicon-bosch-ic-globe"></i>
                                        <span>Language</span>
                                    </a>
                                </div>
                                <div class="a-dropdown">
                                    <select
                                        id="demo"
                                        aria-label="dropdown for language" onload="changeLanguage('pt')" onchange="changeLanguage(this)">
                                        <option value='pt'>Portuguese</option>
                                        <option value='en'>English</option>
                                        <option value='es'>Espanol</option>
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
                <div class="o-form">
                    <form id="nps-form">
                        <h3 data-i18n="nps_title"></h3>
                        <h4 data-i18n="nps_personal"></h4>
                        <div class="m-form-field">
                            <div class="a-text-field">
                                <label for="text-input-name" data-i18n="name"></label>
                                <input type="text" id="text-input-name" />
                            </div>
                        </div>
                        <div class="o-form__row">
                            <div class="m-form-field -quarter">
                                <div class="a-text-field">
                                    <label for="text-input-cp" data-i18n="cpf"></label>
                                    <input type="text" id="text-input-cp" />
                                </div>
                            </div>
                            <div class="m-form-field -half">
                                <div class="a-text-field">
                                    <label for="text-input-em">Email*</label>
                                    <input type="text" id="text-input-em" />
                                </div>
                            </div>
                            <div class="m-form-field -quarter">
                                <div class="a-text-field">
                                    <label for="text-input-tn" data-i18n="telephone"></label>
                                    <input type="tel" id="text-input-tn" />
                                </div>
                            </div>
                        </div>
                        <p class="-size-s" data-i18n="required"></p>
                        <h4 data-i18n="contact_info"></h4>
                        <p data-i18n="accept"></p>
                        <div class="m-form-field m-form-field--checkbox">
                            <div class="a-checkbox">
                                <input type="checkbox" id="checkbox-agree" />
                                <label for="checkbox-agree" data-i18n="agree"></label>
                            </div>
                        </div>
                        <h4 data-i18n="general_eval"></h4>
                        <!-- nps question-->
                        <div class="nps-question-2">
                            <h5 data-i18n="NPS_score"></h5>
                            <div class="nps-rating-container">
                                <label>
                                    <input type="radio" name="nps_rating" value="1">
                                    <span>1</span>
                                </label>
                                <label>
                                    <input type="radio" name="nps_rating" value="2">
                                    <span>2</span>
                                </label>
                                <label>
                                    <input type="radio" name="nps_rating" value="3">
                                    <span>3</span>
                                </label>
                                <label>
                                    <input type="radio" name="nps_rating" value="4">
                                    <span>4</span>
                                </label>
                                <label>
                                    <input type="radio" name="nps_rating" value="5">
                                    <span>5</span>
                                </label>
                                <label>
                                    <input type="radio" name="nps_rating" value="6">
                                    <span>6</span>
                                </label>
                                <label>
                                    <input type="radio" name="nps_rating" value="7">
                                    <span>7</span>
                                </label>
                                <label>
                                    <input type="radio" name="nps_rating" value="8">
                                    <span>8</span>
                                </label>
                                <label>
                                    <input type="radio" name="nps_rating" value="9">
                                    <span>9</span>
                                </label>
                                <label>
                                    <input type="radio" name="nps_rating" value="10">
                                    <span>10</span>
                                </label>
                            </div>
                            <div class="nps-rating-explanation">
                                <span data-i18n="not-satis"></span>
                                <span data-i18n="much-satis"></span>
                            </div>
                        </div>
                        <!-- second question-->
                        <div class="nps-question">
                            <h5 data-i18n="trainer_question"></h5>
                            <div class="rating_container -single">
                                <div class="a-rating a-rating--large a-rating--selection">
                                    <div class="a-rating__star-container">
                                        <label>
                                            <input type="radio" name="trainer_rating" value="1" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                        <label>
                                            <input type="radio" name="trainer_rating" value="2" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                        <label>
                                            <input type="radio" name="trainer_rating" value="3" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                        <label>
                                            <input type="radio" name="trainer_rating" value="4" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                        <label>
                                            <input type="radio" name="trainer_rating" value="5" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                    </div>
                                    <div class="a-rating__label-container">
                                        <span class="output a-rating__label a-rating__label--complete">(0/5)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Third question-->
                        <div class="nps-question">
                            <h5 data-i18n="trainer_question_2"></h5>
                            <div class="rating_container -single">
                                <div class="a-rating a-rating--large a-rating--selection">
                                    <div class="a-rating__star-container">
                                        <label>
                                            <input type="radio" name="trainer_rating_2" value="1" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                        <label>
                                            <input type="radio" name="trainer_rating_2" value="2" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                        <label>
                                            <input type="radio" name="trainer_rating_2" value="3" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                        <label>
                                            <input type="radio" name="trainer_rating_2" value="4" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                        <label>
                                            <input type="radio" name="trainer_rating_2" value="5" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                    </div>
                                    <div class="a-rating__label-container">
                                        <span class="output a-rating__label a-rating__label--complete">(0/5)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fourth question-->
                        <div class="nps-question">
                            <h5 data-i18n="material_question"></h5>
                            <div class="rating_container -single">
                                <div class="a-rating a-rating--large a-rating--selection">
                                    <div class="a-rating__star-container">
                                        <label>
                                            <input type="radio" name="material_rating" value="1" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                        <label>
                                            <input type="radio" name="material_rating" value="2" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                        <label>
                                            <input type="radio" name="material_rating" value="3" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                        <label>
                                            <input type="radio" name="material_rating" value="4" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                        <label>
                                            <input type="radio" name="material_rating" value="5" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                    </div>
                                    <div class="a-rating__label-container">
                                        <span class="output a-rating__label a-rating__label--complete">(0/5)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fifth question-->
                        <div class="nps-question">
                            <h5 data-i18n="practice_question"></h5>
                            <div class="rating_container -single">
                                <div class="a-rating a-rating--large a-rating--selection">
                                    <div class="a-rating__star-container">
                                        <label>
                                            <input type="radio" name="practice_rating" value="1" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                        <label>
                                            <input type="radio" name="practice_rating" value="2" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                        <label>
                                            <input type="radio" name="practice_rating" value="3" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                        <label>
                                            <input type="radio" name="practice_rating" value="4" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                        <label>
                                            <input type="radio" name="practice_rating" value="5" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                    </div>
                                    <div class="a-rating__label-container">
                                        <span class="output a-rating__label a-rating__label--complete">(0/5)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sixth question-->
                        <div class="nps-question">
                            <h5 data-i18n="practice_question_2"></h5>
                            <div class="rating_container -single">
                                <div class="a-rating a-rating--large a-rating--selection">
                                    <div class="a-rating__star-container">
                                        <label>
                                            <input type="radio" name="practice_rating_2" value="1" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                        <label>
                                            <input type="radio" name="practice_rating_2" value="2" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                        <label>
                                            <input type="radio" name="practice_rating_2" value="3" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                        <label>
                                            <input type="radio" name="practice_rating_2" value="4" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                        <label>
                                            <input type="radio" name="practice_rating_2" value="5" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                    </div>
                                    <div class="a-rating__label-container">
                                        <span class="output a-rating__label a-rating__label--complete">(0/5)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Seventh question-->
                        <div class="nps-question">
                            <h5 data-i18n="food_question"></h5>
                            <div class="rating_container -single">
                                <div class="a-rating a-rating--large a-rating--selection">
                                    <div class="a-rating__star-container">
                                        <label>
                                            <input type="radio" name="food_rating" value="1" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                        <label>
                                            <input type="radio" name="food_rating" value="2" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                        <label>
                                            <input type="radio" name="food_rating" value="3" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                        <label>
                                            <input type="radio" name="food_rating" value="4" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                        <label>
                                            <input type="radio" name="food_rating" value="5" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                    </div>
                                    <div class="a-rating__label-container">
                                        <span class="output a-rating__label a-rating__label--complete">(0/5)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- eighth question-->
                        <div class="nps-question">
                            <h5 data-i18n="location_question"></h5>
                            <div class="rating_container -single">
                                <div class="a-rating a-rating--large a-rating--selection">
                                    <div class="a-rating__star-container">
                                        <label>
                                            <input type="radio" name="school_rating" value="1" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                        <label>
                                            <input type="radio" name="school_rating" value="2" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                        <label>
                                            <input type="radio" name="school_rating" value="3" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                        <label>
                                            <input type="radio" name="school_rating" value="4" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                        <label>
                                            <input type="radio" name="school_rating" value="5" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                    </div>
                                    <div class="a-rating__label-container">
                                        <span class=" output a-rating__label a-rating__label--complete">(0/5)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ninth question-->
                        <div class="nps-question">
                            <h5 data-i18n="inscription_question"></h5>
                            <div class="rating_container -single">
                                <div class="a-rating a-rating--large a-rating--selection">
                                    <div class="a-rating__star-container">
                                        <label>
                                            <input type="radio" name="inscription_rating" value="1" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                        <label>
                                            <input type="radio" name="inscription_rating" value="2" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                        <label>
                                            <input type="radio" name="inscription_rating" value="3" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                        <label>
                                            <input type="radio" name="inscription_rating" value="4" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                        <label>
                                            <input type="radio" name="inscription_rating" value="5" />
                                            <i class="a-icon ui-ic-nosafe-star" title="nosafe-star"></i>
                                        </label>
                                    </div>
                                    <div class="a-rating__label-container">
                                        <span class="output a-rating__label a-rating__label--complete">(0/5)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Selection container-->
                        <div class="nps-question">
                            <h5 data-i18n="media_question"></h5>
                            <div class="radio-container">
                                <div class="a-radio-button">
                                    <input type="radio" id="radio-button-1" name="active" value="test1" />
                                    <label for="radio-button-1" data-i18n="radio1"></label>
                                </div>
                                <div class="a-radio-button">
                                    <input type="radio" id="radio-button-2" name="active" value="test2" />
                                    <label for="radio-button-2" data-i18n="radio2"></label>
                                </div>
                                <div class="a-radio-button">
                                    <input type="radio" id="radio-button-3" name="active" value="test3" />
                                    <label for="radio-button-3" data-i18n="radio3"></label>
                                </div>
                                <div class="a-radio-button">
                                    <input type="radio" id="radio-button-4" name="active" value="test4" />
                                    <label for="radio-button-4" data-i18n="radio4"></label>
                                </div>
                                <div class="a-radio-button">
                                    <input type="radio" id="radio-button-5" name="active" value="test5" />
                                    <label for="radio-button-5" data-i18n="radio5"></label>
                                </div>
                                <div class="a-radio-button">
                                    <input type="radio" id="radio-button-6" name="active" value="test6" />
                                    <label for="radio-button-6" data-i18n="radio6"></label>
                                </div>
                            </div>
                        </div>
                        <div class="nps-question-2 comments">
                            <h5 data-i18n="question1"></h5>
                            <div class="a-text-area">
                                <label for="question1" data-i18n="comment_label"></label>
                                <textarea id="question1" name="question1"></textarea>
                            </div>
                        </div>
                        <div class="nps-question-2 comments">
                            <h5 data-i18n="question2"></h5>
                            <div class="a-text-area">
                                <label for="question2" data-i18n="comment_label"></label>
                                <textarea id="question2" name="question2"></textarea>
                            </div>
                        </div>
                        <div class="button_container">
                            <button type="submit" name="submit" class="a-button a-button--primary -without-icon">
                                <span class="a-button__label" data-i18n="survey_submit"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

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

</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Find each question container on the page
        const questions = document.querySelectorAll('.nps-question');

        questions.forEach(function(question) {
            // Within each question, select the related stars and output element.
            const stars = question.querySelectorAll('input[type="radio"]');
            const star_icons = question.querySelectorAll('i[title="nosafe-star"]');
            // Use a class selector for the output span instead of an ID.
            const rate_value = question.querySelector('.output');

            // Function to remove the filled state from the stars
            function removeFill() {
                star_icons.forEach((icon) => {
                    icon.classList.remove("ui-ic-nosafe-star-fill");
                    icon.classList.add("ui-ic-nosafe-star");
                });
            }

            // Attach event listeners for clicking a radio star.
            stars.forEach((star) => {
                star.addEventListener("click", function() {
                    removeFill(); // Clear all previous fills
                    const value = parseInt(star.getAttribute("value"), 10);

                    // Fill the stars up to the selected one
                    for (let i = 0; i < value; i++) {
                        star_icons[i].classList.remove("ui-ic-nosafe-star");
                        star_icons[i].classList.add("ui-ic-nosafe-star-fill");
                    }

                    // Display the selected rating
                    if (rate_value) {
                        rate_value.innerText = `(${value}/5)`;
                    }
                });
            });

            // Additional behavior: Prevent default click interference and manually trigger the fill update.
            const starLabels = question.querySelectorAll('.a-rating__star-container label');
            starLabels.forEach((label) => {
                label.addEventListener('click', function(e) {
                    // Prevent default behavior if necessary
                    e.preventDefault();

                    // Get the radio input in this label
                    const radioInput = label.querySelector('input[type="radio"]');
                    if (radioInput) {
                        const value = parseInt(radioInput.value, 10);
                        radioInput.checked = true; // Mark the radio as checked

                        // Update the stars for this question
                        removeFill();
                        for (let i = 0; i < value; i++) {
                            star_icons[i].classList.remove("ui-ic-nosafe-star");
                            star_icons[i].classList.add("ui-ic-nosafe-star-fill");
                        }
                        if (rate_value) {
                            rate_value.innerText = `(${value}/5)`;
                        }
                    }
                });
            });
        });



        // Select the form
        const npsForm = document.getElementById("nps-form");

        // Add event listener for the submit event
        npsForm.addEventListener("submit", function(e) {
            e.preventDefault(); // Prevent default form submission

            // Get form values
            const name = document.getElementById("text-input-name").value.trim();
            const cpf = document.getElementById("text-input-cp").value.trim();
            const email = document.getElementById("text-input-em").value.trim();
            const telephone = document.getElementById("text-input-tn").value.trim();
            const npsRating = document.querySelector("input[name='nps_rating']:checked");
            const trainer1 = document.querySelector("input[name='trainer_rating']:checked");
            const trainer2 = document.querySelector("input[name='trainer_rating_2']:checked");
            const material = document.querySelector("input[name='material_rating']:checked");
            const practice = document.querySelector("input[name='practice_rating']:checked");
            const practice2 = document.querySelector("input[name='practice_rating_2']:checked");
            const food = document.querySelector("input[name='food_rating']:checked");
            const school = document.querySelector("input[name='school_rating']:checked");
            const inscription = document.querySelector("input[name='inscription_rating']:checked");
            const media = document.querySelector("input[name='active']:checked")
            const comments1 = document.getElementById("question1").value.trim();
            const comments2 = document.getElementById("question2").value.trim();
            const agree = document.getElementById("checkbox-agree").checked; // Get checkbox state

            // Array to collect missing fields
            const missingFields = [];

            // Validate required fields
            if (!name) missingFields.push("Name");
            if (!cpf) missingFields.push("CPF");
            if (!email) missingFields.push("Email");
            if (!telephone) missingFields.push("Telephone number");
            if (!npsRating) missingFields.push("NPS Rating");
            if (!trainer1) missingFields.push("Trainer evaluation");
            if (!trainer2) missingFields.push("Trainer 2 evaluation");
            if (!material) missingFields.push("Training material");
            if (!practice) missingFields.push("Practice evaluation");
            if (!practice2) missingFields.push("Practice 2 evaluation");
            if (!food) missingFields.push("Food evalueation");
            if (!school) missingFields.push("Training center evaluation");
            if (!inscription) missingFields.push("Inscription evaluation");
            if (!media) missingFields.push("Media evaluation");


            // If there are missing fields, show an alert
            if (missingFields.length > 0) {
                alert("The following fields are missing:\n" + missingFields.join("\n"));
                return; // Stop further processing
            } else {

                // If all fields are valid, prepare data for submission
                const formData = new URLSearchParams();
                formData.append("name", name);
                formData.append("cpf", cpf);
                formData.append("email", email);
                formData.append("telephone", telephone);
                formData.append("npsRating", npsRating.value); // Get the value of the selected rating
                formData.append("trainer1", trainer1.value);
                formData.append("trainer2", trainer2.value);
                formData.append("material", material.value);
                formData.append("practice", practice.value);
                formData.append("practice2", practice2.value);
                formData.append("food", food.value);
                formData.append("school", school.value);
                formData.append("inscription", inscription.value);
                formData.append("media", media.value);
                formData.append("agree", agree ? '1' : '0'); // Send the checkbox value (1 if checked, 0 if not)
                formData.append("comments1", comments1);
                formData.append("comments2", comments2);


                // Submit the form data to the same page (nps.php)
                /*
                fetch("nps.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                        },
                        body: formData.toString(),
                    })
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.text(); // Get raw text for debugging
                    })
                    .then((text) => {
                        console.log("Raw response:", text);
                        try {
                            const data = JSON.parse(text); // Parse JSON manually
                            if (data.status === 'success') {
                                alert(data.message);
                                npsForm.reset();
                                location.href = ('login.php');
                            } else {
                                alert("Error: " + data.message);
                            }

                        } catch (error) {
                            console.error("Error:", error);
                            alert("An unexpected error occurred. Please try again.");
                        }

                    });  */

                console.log("Collected form data:", Array.from(formData.entries()));
            }
        });

        document.getElementById('menu_btn').addEventListener('click', () => {
            location.href = 'login.php';
        });

    });

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