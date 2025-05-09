<?php
require('config.php');
$room = 'training123';  // same room as teacher
?>
<!DOCTYPE html>
<html lang="en">
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
<title>CTA | Training App</title>

<head>

</head>
<style>
    .container {
        display: grid;
        place-items: center;
        /* centers both axes */
        height: 100vh;
        margin: 0;
        background: black;
    }

    .video-container {
        width: 100vw;
        max-width: 1150px;
        aspect-ratio: 16/9;
        position: relative;
    }

    .video-container video {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    /* the “button” text overlay */
    #exitBtn {
        position: absolute;
        bottom: 16px;
        right: 16px;
        font-size: 16px;
        color: rgba(255, 255, 255, 0.8);
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
        user-select: none;
    }

    #exitBtn.visible {
        opacity: 1;
        pointer-events: auto;
    }
</style>


<body>
    <div class="container">
        <div class="video-container">
            <video id="remoteVideo" autoplay style="width:100%"></video>
            <div class="stream_btn">
                <button type="button" id="exitBtn" name="livecast" class="a-button a-button--primary -without-icon">
                    <span class="a-button__label" style="padding-right: 0.85rem;" data-i18n="viewStream_exit_btn"></span>
                </button>
            </div>
        </div>
    </div>
</body>
<script>
    window.SIGNALING = `http://${window.location.hostname}:3000`;
    window.ROOM = <?= json_encode($room) ?>;
</script>
<script src="http://localhost:3000/socket.io/socket.io.js"></script>
<script src="../js/viewstream.js"></script>
<script>
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
    }

    // Call updateContent() on page load
    window.addEventListener("DOMContentLoaded", async () => {
        const userPreferredLanguage = localStorage.getItem("language") || "pt";
        const langData = await fetchLanguageData(userPreferredLanguage);
        updateContent(langData);
    });


    document.addEventListener('DOMContentLoaded', () => {
        const container = document.querySelector('.video-container');
        const exitBtn = document.getElementById('exitBtn');
        let hideTimer;

        function showExit() {
            clearTimeout(hideTimer);
            exitBtn.classList.add('visible');
            hideTimer = setTimeout(() => {
                exitBtn.classList.remove('visible');
            }, 5000);
        }

        // on any touch or pointer movement over the video area:
        container.addEventListener('touchstart', showExit);
        container.addEventListener('pointermove', showExit);

        // exit button tap
        exitBtn.addEventListener('click', () => {
            // navigate back to your main menu page
            window.location.href = 'login.php';
        });

        // Optionally, you can trigger fullscreen on first tap if needed:
        let firstTouch = true;
        container.addEventListener('touchstart', function initFS() {
            if (firstTouch && container.requestFullscreen) {
                container.requestFullscreen().catch(() => {
                    /*ignore*/
                });
                firstTouch = false;
            }
            // remove this listener so it only fires once
            container.removeEventListener('touchstart', initFS);
        });
    });
</script>

</html>