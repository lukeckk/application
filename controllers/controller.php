<?php

class Controller
{
    private $_f3; //Fat-free Router

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    function home()
    {
        $view = new Template();
        echo $view->render('views/home.html');
    }

    function apply()
    {
        //    $firstName = "";
//    $lastName = "";

        // If the form has been posted
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            //Get data from post array

            $state = $_POST['state'];

            //First and Last name validation
            if(isset($_POST['first'], $_POST['last'] ) and Validate::validName($_POST['first'], $_POST['last'])){
                $firstName = $_POST['first'];
                $lastName = $_POST['last'];
            }
            else{
                $this->_f3->set('errors["first"]', 'Please enter your name with only alphabets');
            }

            //Email validation
            if(isset($_POST['email']) and Validate::validEmail($_POST['email'])){
                $email = $_POST['email'];
            }
            else{
                $this->_f3->set('errors["email"]', 'Please enter a valid email. Eg. JoeLee@gmail.com');
            }

            //Phone validation
            if(isset($_POST['phone']) and Validate::validPhone($_POST['phone'])){
                $phone = $_POST['phone'];
            }
            else{
                $this->_f3->set('errors["phone"]', 'Please enter a 10-digit US phone number without space and symbols');

            }


            // Add the data to the session array
            $this->_f3->set('SESSION.firstName', $firstName);
            $this->_f3->set('SESSION.lastName', $lastName);
            $this->_f3->set('SESSION.email', $email);
            $this->_f3->set('SESSION.state', $state);
            $this->_f3->set('SESSION.phone', $phone);
            $this->_f3->set('SESSION.mailingCheck', $_POST['mailingCheck']);

            //If there is no error, send the user to the next form, if not, stay on the current form
            if(empty($this->_f3->get('errors'))){
                $this->_f3->reroute('experience');
            }

        }

        $view = new Template();
        echo $view->render('views/personal-information.html');

    }

    function experience()
    {
        //    var_dump ( $f3->get('SESSION') );
//    // If the form has been posted
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            //Get data from post array
            $bio = $_POST['bio'];
            $relocate = $_POST['relocate'];

            //Github url validation
            if(Validate::validGithub($_POST['link'])){
                $link = $_POST['link'];
            }
            else{
                $this->_f3->set('errors["link"]', 'Please enter a valid URL');
            }

            //Exp validation
            if(isset($_POST['exp']) and Validate::validExperience($_POST['exp'])){
                $exp = $_POST['exp'];
            }
            else{
                $this->_f3->set('errors["exp"]', 'Please make a selection');
            }

            // Add the data to the session array
            $this->_f3->set('SESSION.bio', $bio);
            $this->_f3->set('SESSION.link', $link);
            $this->_f3->set('SESSION.exp', $exp);
            $this->_f3->set('SESSION.relocate', $relocate);
            $mailingCheck = $this->_f3->get('SESSION.mailingCheck');

            // Send the user to the next form
            if(empty($this->_f3->get('errors')) && $mailingCheck != null) {
                $this->_f3->reroute('mailing-list');
            }
            else{
                $this->_f3->reroute('summary');
            }


        }

        $view = new Template();
        echo $view->render('views/experience.html');

    }

    function mailing()
    {
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
                $this->_f3->set('SESSION.language', $language);
                $this->_f3->set('SESSION.industry', $industry);


                // Send the user to the next form
                $this->_f3->reroute('summary');

            } else {
                // Temporary
                echo "<p>Validation errors</p>";
            }
        }

        $language = DataLayer::getLanguage();
        $industry = DataLayer::getIndustry();

        $this->_f3->set('languages', $language);
        $this->_f3->set('industries', $industry);

        $view = new Template();
        echo $view->render('views/mailing-list.html');

    }

    function summary()
    {
        //        var_dump ( $f3->get('SESSION') );
        //echo below is used for testing before executing the template
//    echo '<h1>Hello Pets</h1>';

//    //Render a view page
        $view = new Template();
        echo $view->render('views/summary.html');

        session_destroy();
    }
}