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

//Define a default route
//https://kcheng.greenriverdev.com/328/hello-fat-free/
$f3->route('GET /', function(){
    //echo below is used for testing before executing the template
//    echo '<h1>Hello Pets</h1>';

//    //Render a view page
    $view = new Template();
    echo $view->render('views/home.html');
});

//Return to home
$f3->route('GET /home', function(){
    //echo below is used for testing before executing the template
//    echo '<h1>Hello Pets</h1>';

//    //Render a view page
    $view = new Template();
    echo $view->render('views/home.html');
});

//Personal Information Page
$f3->route('GET|POST /apply', function($f3){
    $firstName = "";
    $lastName = "";

    // If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        //Get data from post array
        $email = $_POST['email'];
        $state = $_POST['state'];
        $phone = $_POST['phone'];

        //First and Last name validation
        if(validName($_POST['first'], $_POST['last'])){
            $firstName = $_POST['first'];
            $lastName = $_POST['last'];
        }
        else{
            $f3->set('errors["first"]', 'Please enter only alphabet');
            $f3->set('errors["last"]', 'Please enter only alphabet');
        }


        // Add the data to the session array
        $f3->set('SESSION.firstName', $firstName);
        $f3->set('SESSION.lastName', $lastName);
        $f3->set('SESSION.email', $email);
        $f3->set('SESSION.state', $state);
        $f3->set('SESSION.phone', $phone);

        //If there is no error, send the user to the next form, if not, stay on the current form
        if(empty($f3->get('errors'))){
            $f3->reroute('experience');
        }

    }



    $view = new Template();
    echo $view->render('views/personal-information.html');
});


//Experience Page
$f3->route('GET|POST /experience', function($f3){
    echo "Is vardump working? ";
    var_dump ( $f3->get('SESSION') );
//    // If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //Get data from post array
        $bio = $_POST['bio'];
        $link = $_POST['link'];
        $exp = $_POST['exp'];
        $relocate = $_POST['relocate'];

        // If the data valid
        if (true) {

            // Add the data to the session array
            $f3->set('SESSION.bio', $bio);
            $f3->set('SESSION.link', $link);
            $f3->set('SESSION.exp', $exp);
            $f3->set('SESSION.relocate', $relocate);

            // Send the user to the next form
            $f3->reroute('mailing-list');

        } else {
            // Temporary
            echo "<p>Validation errors</p>";
        }
    }

    $view = new Template();
    echo $view->render('views/experience.html');
});

//Mailing Lists Page
$f3->route('GET|POST /mailing-list', function($f3){
    var_dump ( $f3->get('SESSION') );
//    // If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //Get data from post array
//        $language = $_POST['language'];
//        $industry = $_POST['industry'];

        // Get the data from the post array language
        if (isset($_POST['language']))
            $language = implode(", ", $_POST['language']);
        else
            $language = "None selected";

        // Get the data from the post array language
        if (isset($_POST['industry']))
            $industry = implode(", ", $_POST['industry']);
        else
            $industry = "None selected";


        // If the data valid
        if (true) {

            // Add the data to the session array
            $f3->set('SESSION.language', $language);
            $f3->set('SESSION.industry', $industry);


            // Send the user to the next form
            $f3->reroute('summary');

        } else {
            // Temporary
            echo "<p>Validation errors</p>";
        }
    }

    $view = new Template();
    echo $view->render('views/mailing-list.html');
});

//Summary Page
$f3->route('GET|POST /summary', function($f3){
        var_dump ( $f3->get('SESSION') );
    //echo below is used for testing before executing the template
//    echo '<h1>Hello Pets</h1>';

//    //Render a view page
    $view = new Template();
    echo $view->render('views/summary.html');
});


//Run Fat-Free
$f3->run();