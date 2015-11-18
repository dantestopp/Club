<?php
require_once("flight/Flight.php");

require_once("conf/config.php");

require_once("conf/settings.php");

session_start();
require_once("conf/routes.php");

Flight::start();
