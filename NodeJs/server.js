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

server.listen(8080, function(){
  console.log("Server runtime ...");
});
io.on('connection', function (socket) {

  console.log("new client connected");
  var redisClient = redis.createClient();
  redisClient.subscribe('message');

  redisClient.on("message", function(channel, message) {
    console.log("new message in queue "+ message + "channel");
    socket.emit(channel, message);
  });

  socket.on('disconnect', function() {
    redisClient.quit();
  });

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

