<?php

Flight::path("controllers/");

Flight::path("classes/");

Flight::register('db','mysqli',[$config['db']['host'], $config['db']['username'], $config['db']['password'], $config['db']['databasename']]);

Flight::register('auth','auth');

Flight::register('util','util');

Flight::register('absence','absenceController');

Flight::register('events','eventController');

Flight::register('players','playerController');

Flight::register('teams','teamController');

Flight::register('users','userController');

Flight::set("flight.base_url", $config['web']['base_url']);

Flight::map('link',function($url){
  echo Flight::get('flight.base_url').$url;
});

Flight::map('noAccess', function(){
  Flight::util()->render('noAccess');
  die();
});
Flight::map('notFound',function(){
  Flight::util()->render('404');
  die();
});

Flight::map('notLogedIn',function(){
  Flight::util()->render('notLogedIn');
  die();
});
