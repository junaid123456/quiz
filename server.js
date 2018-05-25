"use strict";

const io = require('socket.io').listen(5000);
const request = require("request");

class Quiz 
{
  constructor(io, socket) {
    this.io = io;
	this.socket = socket;
	this.search_opponent_attempt = 1;
  }
  
  emitToSocketIds(socket_ids, e, data) { 
	if (typeof socket_ids != undefined && socket_ids.length > 0)
	{
		for(let i in socket_ids)
			this.io.to(socket_ids[i]).emit(e, data);
	}
  }
  
  isUserPlaying(user_id) {
    if(this.io.playing != undefined && this.io.playing.indexOf(user_id) != -1)
		return 'Yes';
	else
		return 'No';
  }
  
  console(label, obj) {
    console.log('--- '+label+' ---');
	console.log(obj);
	console.log('\n');
  }
    
  searchOpponent() {
	if(this.isUserPlaying(this.socket.user.user_id) == 'Yes') return;
	  	
	let sockets = this.io.sockets.sockets;
	let opponents = {};

	for(let i in sockets)
	{
		let socket_id = sockets[i].id;
		let user 	  = sockets[i].user;
		let user_id   = sockets[i].user.user_id;

		if(this.socket.user.user_id != user_id)
		{
			if(!opponents.hasOwnProperty(user_id))
			{
				opponents[user_id] = user;
				let socket_ids = [];
				socket_ids.push(socket_id);
				 
				opponents[user_id].socket_ids = socket_ids;
			}
			else
				opponents[user_id].socket_ids.push(socket_id);
		}
	}
	
	if( Object.keys(opponents).length == 0 && 
		this.search_opponent_attempt == 1 )
	{
		var that = this;
		var data = {'message':'Wait...Searching for opponent...', 'opponents': opponents};
		this.io.to(this.socket.id).emit('searchOpponent', data);

		setTimeout(function(){ 
							that.search_opponent_attempt++;  
							that.searchOpponent();
		}, 10000);
	}
	else if( Object.keys(opponents).length == 0 && 
			 this.search_opponent_attempt == 2 )
	{
		var data = {'message':'No Opponent Availble.', 'opponents': opponents};
		this.io.to(this.socket.id).emit('searchOpponent', data);
		return;	
	}
	else if(Object.keys(opponents).length > 0 )
	{
		// Emit all opponents to this.socket.id
		var data = {'message':'', 'opponents': opponents};
		this.io.to(this.socket.id).emit('searchOpponent', data);
		
		// Select opponent
		let opponent_user_id = opponents[Object.keys(opponents)[0]].user_id;
		this.io.to(this.socket.id).emit('yourOpponent', opponent_user_id);
		
		let socket_ids = opponents[Object.keys(opponents)[0]].socket_ids;
		//console.log(socket_ids);
		this.emitToSocketIds(socket_ids,'yourOpponent',  this.socket.user.user_id );
		
		//this.io.to().emit('yourOpponent', opponent_user_id);
		
		
		//this.socket.user.opponent_user_id = opponent_user_id;
		//opponents[opponent_user_id].opponent_user_id = this.socket.user.user_id;
		
		if(this.io.playing == undefined)
			this.io.playing = [];
		
		this.io.playing.push(this.socket.user.user_id);
		this.io.playing.push(opponent_user_id);
		
		/*let opponent = opponents[opponent_user_id];

		this.console('USER1', opponent);
		this.console('USER2', this.socket.user);
		*/
		
		
		
		
	}
	
  }
}

// Before connection validate access token
io.use((socket, next) => {
  let access_token = socket.handshake.query._a;
  request.get("http://localhost/quiz/api.php?check_access_token=1&access_token="+access_token, (error, response, body) => {
		if(error)
			socket.disconnect(true);
		
		if(response.statusCode == 200)
		{
			let response = JSON.parse(body);
			if(response.user_id)
			{
				socket.user = response;
				next();
			}
			else
			{
				 let err  = new Error('Authentication error');
				 err.data = { type : 'authentication_error', notify : 'my notfy' };
				 next(err);
				 setTimeout(() => socket.disconnect(true), 1000);
			}
		}
		else
			socket.disconnect(true);
 	});
});

// Only authenticated users will be able to connect
io.sockets.on('connection', function (socket) {

	let quiz = new Quiz(io, socket);
	quiz.searchOpponent();
	
	
/*	var Gamee = new Gamee();
	var users = Gamee.getOnlineUsers(); 
	console.log(users);
	*/

	/*let opponents = []; // All online users
	
	
	for(var i in sockets)
	{
		// users[]['sockets'] = sockets[i].id;
		
		// if(socket.id != sockets[i].id)
			opponents.push(sockets[i].user);
	}
	
	
	
	console.log(opponents);*/
	
//	socket.emit('select_opponent', {opponents: opponents});

	
	
	// console.log(Object.keys(io.engine.clients));
	
	/*
	
	*/
	/*
	 socket.join('room 237', () => {
    let rooms = Objects.keys(socket.rooms);
    console.log(rooms); // [ <socket.id>, 'room 237' ]
    io.to('room 237', 'a new user has joined the room'); // broadcast to everyone in the room
  });
	*/
	
	
	
	
/*	socket.on('authenticated', function(data){
		console.log('2.Total Connected Users:' + io.engine.clientsCount+ '\n');
		console.log('this is only authenticated user \n ');
	});
	
	io.sockets.emit('forallusers', 'test broadcast');
*/
	
	
	
	/* setTimeout(function(){
    
	if (!socket.auth) {
	  console.log("User is not logedin ", socket.id + " \n ");
	 // socket.disconnect();
	}
 	}, 1000); */


});

