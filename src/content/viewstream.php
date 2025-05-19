<?php
require('config.php');
$room = 'training123';  // same room as teacher
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
    <title>CTA | Training App</title>
</head>
<style>
    body,
    html {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        background: black;
    }

    .container {
        width: 100vw;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }

    .video-container {
        width: 100%;
        height: 100%;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .video-container video {
        width: 100%;
        height: 100%;
        object-fit: contain;
        background: black;
    }

    .stream_btn {
        position: absolute;
        bottom: 40px;
        right: 20px;
        z-index: 2;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .stream_btn.visible {
        opacity: 1;
    }

    .tap-message {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        color: rgba(255, 255, 255, 0.7);
        font-size: 14px;
        text-align: center;
        padding: 8px 16px;
        background: rgba(0, 0, 0, 0.5);
        border-radius: 4px;
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
    }

    .tap-message.visible {
        opacity: 1;
    }

    @media (max-width: 768px) {
        .video-container video {
            object-fit: contain;
        }
    }

    @media (max-height: 600px) {
        .video-container video {
            object-fit: contain;
        }
    }
</style>


<body>
    <div class="container">
        <div class="video-container">
            <video id="remoteVideo" autoplay style="width:100%"></video>
            <div class="stream_btn">
                <button type="button" id="exitBtn" name="livecast" class="a-button a-button--primary -without-icon">
                    <span class="a-button__label" style="padding-right: 0.85rem;" data-i18n="back_to_main_menu"></span>
                </button>
            </div>
            <div class="tap-message" data-i18n="tap_to_show_controls"></div>
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
        const exitBtn = document.querySelector('.stream_btn');
        const tapMessage = document.querySelector('.tap-message');
        let hideTimer;
        let touchStartTime;
        let touchStartX;
        let touchStartY;

        function showControls() {
            clearTimeout(hideTimer);
            exitBtn.classList.add('visible');
            tapMessage.classList.remove('visible');
            hideTimer = setTimeout(() => {
                exitBtn.classList.remove('visible');
                tapMessage.classList.add('visible');
            }, 5000);
        }

        // Show tap message initially
        tapMessage.classList.add('visible');

        // Handle touch start
        container.addEventListener('touchstart', (e) => {
            touchStartTime = Date.now();
            touchStartX = e.touches[0].clientX;
            touchStartY = e.touches[0].clientY;
            showControls();
        });

        // Handle touch end to detect taps
        container.addEventListener('touchend', (e) => {
            const touchEndTime = Date.now();
            const touchEndX = e.changedTouches[0].clientX;
            const touchEndY = e.changedTouches[0].clientY;

            // Calculate touch duration and distance
            const touchDuration = touchEndTime - touchStartTime;
            const touchDistance = Math.sqrt(
                Math.pow(touchEndX - touchStartX, 2) +
                Math.pow(touchEndY - touchStartY, 2)
            );

            // If it's a short touch (less than 300ms) and minimal movement (less than 10px)
            if (touchDuration < 300 && touchDistance < 10) {
                showControls();
            }
        });

        // Handle mouse movement for non-touch devices
        container.addEventListener('mousemove', showControls);

        // exit button tap
        document.getElementById('exitBtn').addEventListener('click', () => {
            window.location.href = 'login.php';
        });

        // Handle fullscreen on first tap
        let firstTouch = true;
        container.addEventListener('touchstart', function initFS() {
            if (firstTouch && container.requestFullscreen) {
                container.requestFullscreen().catch(() => {
                    /*ignore*/
                });
                firstTouch = false;
            }
            container.removeEventListener('touchstart', initFS);
        });
    });
</script>

</html>