<?php
Flight::route('/',function(){
    if(Flight::auth()->online()){
      Flight::redirect('/teams');
    }
    Flight::util()->render('login');
});

Flight::route("POST /editUser",['userController','saveUserSettings']);

Flight::route("GET /editUser(/@id)",['userController','showUserSettings']);

Flight::route("GET /createUser",['userController','showNewUser']);

Flight::route("POST /createPlayer",['playerController','saveNewPlayer']);

Flight::route("GET /createPlayer",['playerController','showNewPlayer']);

Flight::route("POST /player/@id/update",['playerController','updatePlayer']);

Flight::route("GET /player/@id/delete",['playerController','deletePlayer']);

Flight::route("GET /player/@id",['playerController','showPlayer']);

Flight::route("GET /player/@id/update",['playerController','showUpdatePlayer']);

Flight::route("GET /players",['playerController','showAllPlayers']);

Flight::route('GET /teams',['teamController','showTeamList']);

Flight::route('GET /team/@id',['teamController','showTeam']);

Flight::route("POST /createTeam",['teamController','saveNewTeam']);

Flight::route("GET /createTeam",['teamController','showNewTeam']);

Flight::route("GET /deleteTeam/@id",['teamController','deleteTeam']);

Flight::route('GET /createEvent/@team',['eventController','showNewEvent']);

Flight::route('POST /createEvent',['eventController','saveNewEvent']);

Flight::route("GET /event/@id",['eventController','showEvent']);

Flight::route("GET /deleteEvent/@id",['eventController','deleteEvent']);

Flight::route('GET /createAbsence/@team(/@event)',['absenceController','showNewAbsence']);

Flight::route('POST /createAbsence/@team(/@event)',['absenceController','saveNewAbsence']);

Flight::route("GET /deleteAbsence/@id",['absenceController','deleteAbsence']);

Flight::route("POST /login",["auth","login"]);

Flight::route("POST /createUser",["auth","register"]);

Flight::route("GET /logout",["auth","logout"]);
