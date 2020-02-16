<?php
//Include Config
session_start();

require('config.php');

require('classes/Bootstrap.php');
require('classes/Controller.php');
require('classes/Model.php');

require('models/home.php');
require('models/user.php');
require('models/share.php');
require('models/movie.php');

require('controllers/home.php');
require('controllers/user.php');
require('controllers/share.php');
require('controllers/movie.php');

$bootstrap = new Bootstrap($_GET);

$controller = $bootstrap->CreateController();
if($controller)
{
    $controller->ExecuteAction();
}