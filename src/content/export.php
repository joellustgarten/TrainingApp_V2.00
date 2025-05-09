<?PHP

echo "\xEF\xBB\xBF"; // This adds the BOM at the start of the file

require_once('config.php'); // Include the database connection and session handling
require '../../vendor/autoload.php'; // Include PHPSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx; // Use the Xlsx writer


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['action'])) {
            if ($_POST['action'] === 'fetch_events') {
                $stmt = $pdo->prepare("
                    SELECT e.training_id, e.start_date, e.end_date, t.training_name
                    FROM event e
                    JOIN training t ON e.training_id = t.training_id
                ");
                $stmt->execute();
                $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($events);
                exit();
            } elseif ($_POST['action'] === 'fetch_survey') {
                $training_id = $_POST['training_id'] ?? null;
                $start_date = $_POST['start_date'] ?? null;
                $end_date = $_POST['end_date'] ?? null;

                if (!$training_id || !$start_date || !$end_date) {
                    echo json_encode(['error' => 'Missing required fields.']);
                    exit;
                }

                $stmt = $pdo->prepare("
                    SELECT name, cpf, email, telephone, rating, nps, comments, agree, training_id, training_name, created_date
                    FROM nps_survey
                    WHERE training_id = :training_id AND created_date BETWEEN :start_date AND :end_date
                ");
                $stmt->execute([
                    ':training_id' => $training_id,
                    ':start_date' => $start_date,
                    ':end_date' => $end_date,
                ]);
                $surveyData = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Store the survey data in session for later use in Excel export
                $_SESSION['survey_data'] = $surveyData;

                echo json_encode($surveyData);
                exit;
            }
            if ($_POST['action'] === 'download_excel') {
                // Retrieve the stored survey data from the session
                if (isset($_SESSION['survey_data']) && !empty($_SESSION['survey_data'])) {
                    $data = $_SESSION['survey_data'];

                    if (ob_get_length()) {
                        ob_end_clean();
                    }
                    header_remove();

                    // Create the Spreadsheet
                    $spreadsheet = new Spreadsheet();
                    $sheet = $spreadsheet->getActiveSheet();

                    // Set the header row
                    $headers = [
                        'Name',
                        'CPF',
                        'Email',
                        'Telephone',
                        'Rating',
                        'NPS',
                        'Comments',
                        'Agree',
                        'Training ID',
                        'Training Name',
                        'Created Date'
                    ];

                    $columnIndex = 'A';
                    foreach ($headers as $header) {
                        $sheet->setCellValue("{$columnIndex}1", $header);
                        $columnIndex++;
                    }

                    // Populate the data rows
                    $rowNumber = 2; // Start from the second row
                    foreach ($data as $row) {
                        $sheet->setCellValue("A{$rowNumber}", $row['name']);
                        $sheet->setCellValue("B{$rowNumber}", $row['cpf']);
                        $sheet->setCellValue("C{$rowNumber}", $row['email']);
                        $sheet->setCellValue("D{$rowNumber}", $row['telephone']);
                        $sheet->setCellValue("E{$rowNumber}", $row['rating']);
                        $sheet->setCellValue("F{$rowNumber}", $row['nps']);
                        $sheet->setCellValue("G{$rowNumber}", $row['comments']);
                        $sheet->setCellValue("H{$rowNumber}", $row['agree']);
                        $sheet->setCellValue("I{$rowNumber}", $row['training_id']);
                        $sheet->setCellValue("J{$rowNumber}", $row['training_name']);
                        $sheet->setCellValue("K{$rowNumber}", $row['created_date']);
                        $rowNumber++;
                    }

                    // Set headers for Excel file download
                    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                    header('Content-Disposition: attachment; filename="survey_data.xlsx"');
                    header('Cache-Control: max-age=0');

                    // Use PHPSpreadsheet's Xlsx Writer
                    $writer = new Xlsx($spreadsheet);
                    $writer->save('php://output'); // Output to browser

                    // Reset session and data
                    unset($_SESSION['survey_data']); // Clear the session data
                    unset($data); // Clear the local data variable

                    exit;
                }
            }
        }
    }
} catch (Exception $e) {
    ob_end_clean();
    echo json_encode(['error' => 'Server error: ' . $e->getMessage()]);
    exit;
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
    <meta name="robots" content="all">
    <meta http-equiv="imagetoolbar" content="no" />
    <meta name="rating" content="general" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="copyright" content="© Robert Bosch Ltda." />
    <meta name="keywords" content="Bosch, Technical training, Technical training center, Mechanics">
    <link rel="icon" type="image/x-icon" href="../style/resources/favicon.ico" />
    <link rel="stylesheet" href="../style/style.css">
    <script defer="" src="../js/main.js"></script>
    <title>CTA | T.A. EXPORT</title>
</head>

<style>
    body {
        overflow: hidden;
    }

    .main_container {
        height: calc(100vh - 160px);
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

    .i-container h3 {
        margin-bottom: 10px;
    }

    .i_container h4 {
        margin: 15px 0 15px 0;
    }

    .i_container h5 {
        margin: 0 0 10px 0;
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

    .i_container h3 {
        margin-top: 75px;
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

    .download_control {
        display: flex;
        justify-content: flex-end;
        margin-top: 30px;
        align-items: end;
        padding: 20px;
    }

    #event_btn {
        margin-top: 10px;
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

    .m-table {
        width: 100%;
        /* Make the table responsive */
        border-collapse: collapse;
    }

    .a-button__label {
        padding-right: 0.75rem;
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
                                <span>Export</span>
                                <span>
                                    NPS
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
                <span class="o-header__subbrand">Training App - Export NPS</span>
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
                                <span class="a-button__label">Main menu</span>
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
            <div id="index_container" class="i_container">
                <h3>Events & Trainings</h3>
                <h4>NPS Download</h4>
                <form>
                    <h5>Select training and training dates</h5>
                    <div class="m-form-field">
                        <div class="a-dropdown">
                            <label for="training3">Training event</label>
                            <select id="training3" aria-label="training event">
                                <option value="" disabled selected>Select an option</option>
                            </select>
                        </div>
                    </div>
                    <button type="button" class="a-button a-button--primary -without-icon" id="event_btn">
                        <span class="a-button__label" style="padding-right: 0.75rem !important;">Display surveys</span>
                    </button>
                </form>
                <div class="table_container"></div>
                <div class="download_control">
                    <button type="button" class="a-button a-button--primary -without-icon" id="download_btn">
                        <span class="a-button__label" style="padding-right: 0.75rem !important;">Download</span>
                    </button>
                </div>
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
        const trainingDropdown = document.getElementById('training3');
        const displayButton = document.getElementById('event_btn');
        const tableContainer = document.querySelector('.table_container');

        // Fetch events and populate the dropdown
        fetch('export.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    action: 'fetch_events'
                }).toString(),
            })
            .then(response => {
                // Check if the response is OK
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                return response.text(); // Get the response as text for debugging
            })
            .then(text => {

                try {
                    // Attempt to parse the response as JSON
                    const data = JSON.parse(text);

                    if (Array.isArray(data)) {
                        // If valid JSON and an array, populate the dropdown
                        data.forEach(event => {
                            const option = document.createElement('option');
                            option.value = JSON.stringify({
                                training_id: event.training_id,
                                start_date: event.start_date,
                                end_date: event.end_date,
                            });
                            option.textContent = `${event.training_id} - ${event.training_name} (${event.start_date} / ${event.end_date})`;
                            trainingDropdown.appendChild(option);
                        });
                    } else if (data.error) {
                        // Handle error message in JSON
                        console.error('Error fetching events:', data.error);
                        alert('Error: ' + data.error);
                    } else {
                        console.error('Unexpected response format:', data);
                    }
                } catch (err) {
                    // If JSON parsing fails, log and alert the user
                    console.error('Error parsing JSON:', err.message);
                    alert('The server returned invalid JSON. See console for details.');
                }
            })
            .catch(err => {
                // Handle network or other fetch errors
                console.error('Fetch error:', err.message);
                alert('Fetch error: ' + err.message);
            });

        // Handle event selection and fetch survey data
        displayButton.addEventListener('click', function() {
            const selectedValue = trainingDropdown.value;
            if (!selectedValue) {
                alert('Please select a training event.');
                return;
            }

            const {
                training_id,
                start_date,
                end_date
            } = JSON.parse(selectedValue);

            fetch('export.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({
                        action: 'fetch_survey',
                        training_id: training_id,
                        start_date: start_date,
                        end_date: end_date,
                    }).toString(),
                })
                .then(response => response.json())
                .then(data => {
                    let tableHTML = `
            <table class="m-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>CPF</th>
                        <th>Training ID</th>
                        <th>Training Name</th>
                        <th>Date</th>
                        <th>Rating</th>
                        <th>NPS Score</th>
                    </tr>
                </thead>
                <tbody>
        `;

                    if (Array.isArray(data) && data.length > 0) {
                        tableHTML += data.map(row => `
                <tr>
                    <td>${row.name}</td>
                    <td>${row.cpf}</td>
                    <td>${row.training_id}</td>
                    <td>${row.training_name}</td>
                    <td>${row.created_date}</td>
                    <td>${row.rating}</td>
                    <td>${row.nps}</td>
                </tr>
            `).join('');
                    } else {
                        // Add a single placeholder row if no data is available
                        tableHTML += `
                <tr>
                    <td colspan="7" style="text-align: center;">No data to display</td>
                </tr>
            `;
                    }

                    tableHTML += `
                </tbody>
            </table>
        `;

                    // Insert the table into the container
                    tableContainer.innerHTML = tableHTML;

                })
                .catch(err => {
                    console.error('Error fetching survey data:', err);
                    tableContainer.innerHTML = '<p>Error fetching survey data.</p>';
                });

        });

        document.getElementById('download_btn').addEventListener('click', function() {
            // Send a request to the server to trigger the export to Excel
            fetch('export.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({
                        action: 'download_excel' // This triggers the Excel export
                    }).toString(),
                })
                .then(response => response.blob()) // Expecting a file (Excel)
                .then(blob => {
                    // Create a temporary link to download the file
                    const link = document.createElement('a');
                    link.href = URL.createObjectURL(blob);
                    link.download = 'survey_data.xlsx'; // Set the default file name
                    link.click();
                })
                .catch(err => {
                    console.error('Error during Excel export:', err);
                });
        });

        document.getElementById('menu_btn').addEventListener('click', () => {
            location.href = 'login.php';
        });


    });
</script>

</html>