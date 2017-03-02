const SERVER_PORT = 8000;
/*
var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var redis = require('redis');

server.listen(8080);
io.on('connection', function (socket) {

  console.log("new client connected");
  var redisClient = redis.createClient();
  redisClient.subscribe('message');

  redisClient.on("message", function(channel, data) {
    console.log("new message in queue "+ data + "channel");
    socket.emit(channel, message);
  });

  socket.on('disconnect', function() {
    redisClient.quit();
  });

});
*/
//https
const fs = require('fs');
const options = {
  key: fs.readFileSync(__dirname+'/ssl/server.key'),
  cert: fs.readFileSync(__dirname+'/ssl/server.crt')
};
var app = require('express')();
// var server = require('https').Server(options, app);
var server = require('https').createServer(options, app);
var io = require('socket.io').listen(server);
var redis = require('redis');
var ioredis = require('socket.io-redis');
//
// Multi-server socket handling allowing you to scale horizontally 
// or use a load balancer with Redis distributing messages across servers.
io.adapter(ioredis({host: 'localhost', port: 6379}))
//

    /*
   * Redis pub/sub
   */

  // Listen to local Redis broadcasts
  // console.log("new client connected");
  var redisClient = redis.createClient();
  //error client
  redisClient.on('error', function (error) {
    console.log('ERROR ' + error);
  });
  //on subscribe
  redisClient.on('subscribe', function (channel, count) {
    console.log('SUBSCRIBE', channel, count);
  });
  //
  // Handle messages from channels we're subscribed to
  redisClient.on('message', function (channel, payload) {
    console.log('INCOMING MESSAGE', channel, payload)
    payload = JSON.parse(payload)
    
    // Merge channel into payload
    payload.data._channel = channel
    
    // Send the data through to any client in the channel room (!)
    // (i.e. server room, usually being just the one user)
    io.sockets.in(channel).emit(payload.event, payload.data)
  })
  // Start listening for incoming client connections
  io.sockets.on('connection', function (socket) {
    
    console.log('NEW CLIENT CONNECTED')
    
    socket.on('subscribe-to-channel', function (data) {
        console.log('SUBSCRIBE TO CHANNEL', data)
        
        // Subscribe to the Redis channel using our global subscriber
        redisClient.subscribe(data.channel)
        
        // Join the (somewhat local) server room for this channel. This
        // way we can later pass our channel events right through to 
        // the room instead of broadcasting them to every client.
        socket.join(data.channel)
    })
    
    socket.on('disconnect', function () {
        console.log('DISCONNECT')
    })
    
  })
//
server.listen(SERVER_PORT, function(){
  console.log("Server runtime ..."+SERVER_PORT);
});
// curl -k https://localhost:8000/
// const https = require('https');
// const fs = require('fs');

// const options = {
//   key: fs.readFileSync(__dirname+'/ssl/server.key'),
//   cert: fs.readFileSync(__dirname+'/ssl/server.crt')
 
// };

// https.createServer(options, (req, res) => {
//   res.writeHead(200);
//   res.end('hello world\n');
// }).listen(8000);
// var http = require('http');
// http.createServer(function (req, res) {
// res.writeHead(200, {'Content-Type': 'text/plain'});
// res.end('Hello Node.js\n');
// }).listen(3000, "localhost");

