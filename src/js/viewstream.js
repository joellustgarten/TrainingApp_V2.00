// src/js/viewstream.js
document.addEventListener('DOMContentLoaded', () => {
  if (typeof io !== 'function') {
    console.error('❌ Socket.IO client did not load!');
    return;
  }
  const SIGNALING = window.SIGNALING;
  const ROOM      = window.ROOM;
  if (!SIGNALING || !ROOM) {
    console.error('❌ SIGNALING or ROOM not defined');
    return;
  }

  const socket      = io(SIGNALING, { transports: ['websocket'] });
  const remoteVideo = document.getElementById('remoteVideo');
  let peerConnection = null;

  console.log('[Student] Connecting to', SIGNALING, 'room', ROOM);
  socket.on('connect', () => {
    console.log('[Student] Socket connected:', socket.id);
    socket.emit('join-room', ROOM);

    // Tell teacher we’re ready only **after** our handlers are set up
    socket.emit('ready-for-offer', ROOM);
  });

  // Relay incoming signaling
  socket.on('offer', async offer => {
    console.log('[Student] Received offer', offer);
    try {
      peerConnection = new RTCPeerConnection({ iceServers: [] });
      peerConnection.ontrack = e => {
        console.log('[Student] ontrack', e);
        remoteVideo.srcObject = e.streams[0];
      };
      peerConnection.onicecandidate = ({ candidate }) => {
        if (candidate) {
          console.log('[Student] Sending ICE candidate', candidate);
          socket.emit('ice-candidate', { room: ROOM, payload: candidate });
        }
      };

      await peerConnection.setRemoteDescription(offer);
      const answer = await peerConnection.createAnswer();
      await peerConnection.setLocalDescription(answer);
      console.log('[Student] Sending answer', answer);
      socket.emit('answer', { room: ROOM, payload: answer });

    } catch (err) {
      console.error('[Student] Error handling offer:', err);
    }
  });

  socket.on('ice-candidate', c => {
    console.log('[Student] Received ICE candidate', c);
    if (peerConnection) {
      peerConnection.addIceCandidate(new RTCIceCandidate(c));
    }
  });
});
