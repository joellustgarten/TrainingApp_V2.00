const express  = require('express');
const http     = require('http');
const socketIo = require('socket.io');

const app    = express();
const server = http.createServer(app);
const io     = socketIo(server, { cors: { origin: '*' } });

// No static serving here—you serve your PHP app via Apache.
io.on('connection', socket => {
  console.log('[server] client connected:', socket.id);

  // 1) Join a named room
  socket.on('join-room', room => {
    socket.join(room);
    console.log(`[server] ${socket.id} joined room ${room}`);
  });

  // 2) Student tells us it’s ready to receive an offer
  socket.on('ready-for-offer', room => {
    console.log(`[server] ${socket.id} ready for offer in ${room}`);
    // Notify teacher(s) in that room
    socket.to(room).emit('student-ready');
  });

  // 3) Relay signaling messages within the room
  ['offer','answer','ice-candidate'].forEach(evt => {
    socket.on(evt, ({ room, payload }) => {
      console.log(`[server] ${evt} from ${socket.id} in ${room}`);
      socket.to(room).emit(evt, payload);
    });
  });

  socket.on('disconnect', () => {
    console.log('[server] client disconnected:', socket.id);
  });
});

server.listen(3000, () => console.log('Signaling Server running on port 3000'));
