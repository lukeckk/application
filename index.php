<?php
// Author: Luke Cheng
// Date: 4/13/2024
// Description: This PHP file serves as a controller using the Fat-Free Framework


//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require
require_once ('vendor/autoload.php');


//Instantiate the F3 Base Class
$f3 = Base::instance();
$con = new Controller($f3);

//Define a default route
//https://kcheng.greenriverdev.com/328/hello-fat-free/
$f3->route('GET /', function(){
    $GLOBALS['con']->home();
});

//Return to home
$f3->route('GET /home', function(){
    $GLOBALS['con']->home();
});

//Personal Information Page
$f3->route('GET|POST /apply', function($f3){
    $GLOBALS['con']->apply();
});


//Experience Page
$f3->route('GET|POST /experience', function($f3){
    $GLOBALS['con']->experience();
});

//Mailing Lists Page
$f3->route('GET|POST /mailing-list', function($f3){
    $GLOBALS['con']->mailing();
});

//Summary Page
$f3->route('GET|POST /summary', function($f3){
    $GLOBALS['con']->summary();
});


//Run Fat-Free
$f3->run();