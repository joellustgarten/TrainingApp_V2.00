// src/js/livecast.js
document.addEventListener('DOMContentLoaded', () => {
  if (typeof io !== 'function') {
    console.error('❌ Socket.IO client did not load!');
    return;
  }
  const SIGNALING = window.SIGNALING;
  const ROOM = window.ROOM;
  if (!SIGNALING || !ROOM) {
    console.error('❌ SIGNALING or ROOM not defined');
    return;
  }

  const socket = io(SIGNALING, { transports: ['websocket'] });
  console.log('[Teacher] Connecting to', SIGNALING, 'room', ROOM);

  socket.on('connect', () => {
    console.log('[Teacher] Socket connected:', socket.id);
    socket.emit('join-room', ROOM);
  });

  socket.on('student-ready', () => {
    console.log('[Teacher] Student is ready — enabling Start');
    startBtn.classList.remove('btn_function_active');
  });

  // Relay incoming signaling
  socket.on('answer', ans => {
    console.log('[Teacher] Received answer', ans);
    peerConnection && peerConnection.setRemoteDescription(ans);
  });
  socket.on('ice-candidate', c => {
    console.log('[Teacher] Received ICE candidate', c);
    peerConnection && peerConnection.addIceCandidate(new RTCIceCandidate(c));
  });

  // UI & WebRTC setup
  const startBtn = document.getElementById('startBtn');
  const localVideo = document.getElementById('localVideo');
  let peerConnection = null;
  let isBroadcasting = false; // Track broadcasting state

  startBtn.addEventListener('click', async () => {
    isBroadcasting = !isBroadcasting; // Toggle broadcasting state
    const buttonLabel = startBtn.querySelector('.a-button__label');
    buttonLabel.setAttribute('data-i18n', isBroadcasting ? 'stop_broadcasting' : 'livecast_btn');

    if (isBroadcasting) {
      startBtn.classList.add('btn_function_active');
      console.log('[Teacher] Start Livecast');

      try {
        // 1) Capture screen
        const stream = await navigator.mediaDevices.getDisplayMedia({ video: true });
        localVideo.srcObject = stream;

        // 2) Create PeerConnection
        peerConnection = new RTCPeerConnection({ iceServers: [] });
        peerConnection.onicecandidate = ({ candidate }) => {
          if (candidate) {
            console.log('[Teacher] Sending ICE candidate', candidate);
            socket.emit('ice-candidate', { room: ROOM, payload: candidate });
          }
        };

        stream.getTracks().forEach(track => peerConnection.addTrack(track, stream));

        // 3) Create & send offer
        const offer = await peerConnection.createOffer();
        await peerConnection.setLocalDescription(offer);
        console.log('[Teacher] Sending offer', offer);
        socket.emit('offer', { room: ROOM, payload: offer });

      } catch (err) {
        console.error('[Teacher] Livecast error:', err);
        startBtn.classList.remove('btn_function_active');
      }
    } else {
      // Stop broadcasting
      if (peerConnection) {
        peerConnection.close(); // Close the peer connection
        peerConnection = null; // Reset the peer connection
      }
      if (localVideo.srcObject) {
        localVideo.srcObject.getTracks().forEach(track => track.stop()); // Stop all tracks
        localVideo.srcObject = null; // Clear the video source
      }
      startBtn.classList.remove('btn_function_active');
      console.log('[Teacher] Stop Livecast');
    }
  });

  const streamBtn = document.querySelector('.stream_btn');


  localVideo.addEventListener('click', function () {
    streamBtn.style.opacity = streamBtn.style.opacity === '0.3' ? '1' : '0.3';
  });

});
