<?php
// Author: Luke Cheng
// Date: 4/13/2024
// Description: This PHP file serves as a controller using the Fat-Free Framework


//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require
require_once ('vendor/autoload.php');
require_once ('model/validate.php');
require_once ('model/data-layer.php');


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
//    $firstName = "";
//    $lastName = "";

    // If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        //Get data from post array

        $state = $_POST['state'];

        //First and Last name validation
        if(isset($_POST['first'], $_POST['last'] ) and validName($_POST['first'], $_POST['last'])){
            $firstName = $_POST['first'];
            $lastName = $_POST['last'];
        }
        else{
            $f3->set('errors["first"]', 'Please enter your name with only alphabets');
        }

        //Email validation
        if(isset($_POST['email']) and validEmail($_POST['email'])){
            $email = $_POST['email'];
        }
        else{
            $f3->set('errors["email"]', 'Please enter a valid email. Eg. JoeLee@gmail.com');
        }

        //Phone validation
        if(isset($_POST['phone']) and validPhone($_POST['phone'])){
            $phone = $_POST['phone'];
        }
        else{
            $f3->set('errors["phone"]', 'Please enter a 10-digit US phone number without space and symbols');

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
//    var_dump ( $f3->get('SESSION') );
//    // If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //Get data from post array
        $bio = $_POST['bio'];
        $relocate = $_POST['relocate'];

        //Github url validation
        if(validGithub($_POST['link'])){
            $link = $_POST['link'];
        }
        else{
            $f3->set('errors["link"]', 'Please enter a valid URL');
        }

        //Exp validation
        if(isset($_POST['exp']) and validExperience($_POST['exp'])){
            $exp = $_POST['exp'];
        }
        else{
            $f3->set('errors["exp"]', 'Please make a selection');
        }

        // Add the data to the session array
        $f3->set('SESSION.bio', $bio);
        $f3->set('SESSION.link', $link);
        $f3->set('SESSION.exp', $exp);
        $f3->set('SESSION.relocate', $relocate);

    // Send the user to the next form
    if(empty($f3->get('errors'))) {
        $f3->reroute('mailing-list');
    }


    }

    $view = new Template();
    echo $view->render('views/experience.html');
});

//Mailing Lists Page
$f3->route('GET|POST /mailing-list', function($f3){
//    var_dump ( $f3->get('SESSION') );
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

    $language = getLanguage();
    $industry = getIndustry();

    $f3->set('languages', $language);
    $f3->set('industries', $industry);

    $view = new Template();
    echo $view->render('views/mailing-list.html');
});

//Summary Page
$f3->route('GET|POST /summary', function($f3){
//        var_dump ( $f3->get('SESSION') );
    //echo below is used for testing before executing the template
//    echo '<h1>Hello Pets</h1>';

//    //Render a view page
    $view = new Template();
    echo $view->render('views/summary.html');
});


//Run Fat-Free
$f3->run();