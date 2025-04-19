<?php
require('config.php');
$room = 'training123';  // same room as teacher
?>
<!DOCTYPE html>
<html>

<head>
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
</head>

<body>
    <div class="container">
        <div class="video-container">
            <video id="remoteVideo" autoplay style="width:100%"></video>
            <span id="exitBtn" role="button">press to exit fullscreen and go back to main menu</span>
        </div>
    </div>
</body>
<script>
     window.SIGNALING = `http://${window.location.hostname}:3000`;
     window.ROOM      = <?= json_encode($room) ?>;
</script>
<script src="http://localhost:3000/socket.io/socket.io.js"></script>
<script src="../js/viewstream.js"></script>
<script>
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