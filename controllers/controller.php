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
        $firstName = "";
        $lastName = "";
        $email = "";
        $phone = "";

        // If the form has been posted
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $state = $_POST['state'];

            //Validate checkbox and instantiate class accordingly
//            if(isset($_POST['mailingCheck'])){
//                //Applicant subscribed
//            }
//            else{
//                //Applicant
//            }

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

            //Mailing subscription check
            if(isset($_POST['mailingCheck'])){
                //post to subscribed applicant session
                $subscribedApplicant = new Applicant_SubscribedToLists($firstName, $lastName, $email, $state, $phone);
                $this->_f3->set('SESSION.subscribedApplicant', $subscribedApplicant);
            }
            else{
                //post to applicant session
                $applicant = new Applicant($firstName, $lastName, $email, $state, $phone);
                $this->_f3->set('SESSION.applicant', $applicant);
            }


//            // Add the data to the session array
//            $applicant = new Applicant($firstName, $lastName, $email, $state, $phone);
//            $this->_f3->set('SESSION.applicant', $applicant);

            $this->_f3->set('SESSION.mailingCheck', $_POST['mailingCheck']); //storing in the session for next method

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
        $bio = "";
        $relocate = "";
        $link = "";
        $exp = "";
//            echo "<pre>";
//            var_dump ( $this->_f3->get('SESSION') );
//            echo "</pre>";


        // If the form has been posted
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

            //mailing from apply page
            $mailingCheck = $this->_f3->get('SESSION.mailingCheck');

            // Add the data to the session array
            if(isset($mailingCheck)){
                $this->_f3->get('SESSION.subscribedApplicant')->setBio($bio);
                $this->_f3->get('SESSION.subscribedApplicant')->setRelocate($relocate);
                $this->_f3->get('SESSION.subscribedApplicant')->setGithub($link);
                $this->_f3->get('SESSION.subscribedApplicant')->setExperience($exp);
            }
            else{
                $this->_f3->get('SESSION.applicant')->setBio($bio);
                $this->_f3->get('SESSION.applicant')->setRelocate($relocate);
                $this->_f3->get('SESSION.applicant')->setGithub($link);
                $this->_f3->get('SESSION.applicant')->setExperience($exp);
            }

            // Send the user to the next form
            if(empty($this->_f3->get('errors')) && $mailingCheck != null) {
                $this->_f3->reroute('mailing-list');
            }
            else if(empty($this->_f3->get('errors'))){
                $this->_f3->reroute('summary');
            }


        }

        $view = new Template();
        echo $view->render('views/experience.html');

    }

    function mailing()
    {
        $language = [];
        $industry = [];

        $mailingCheck = $this->_f3->get('SESSION.mailingCheck');

        // Add the data to the session array
        if(isset($mailingCheck)) {
            $applicant = $this->_f3->get('SESSION.subscribedApplicant');
        }
        else{
            $applicant = $this->_f3->get('SESSION.applicant');
        }

        //retrieving applicant class
        $firstName = $applicant->getFname();
        $lastName = $applicant->getLname();
        $email = $applicant->getEmail();
        $state = $applicant->getState();
        $phone = $applicant->getPhone();
        $github = $applicant->getGithub();
        $exp = $applicant->getExperience();
        $relocate = $applicant->getRelocate();
        $bio = $applicant->getBio();


        // var_dump ( $f3->get('SESSION') );
        // If the form has been posted
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            //Get data from post array
            // $language = $_POST['language'];
            //$industry = $_POST['industry'];

            // Get the data from the post array language
            if (isset($_POST['language']) ) {
                $language = $_POST['language'];
            }
            else {
                $language = [];
            }

            // Get the data from the post array language
            if (isset($_POST['industry'])) {
                $industry = $_POST['industry'];
            }
            else {
                $industry = [];
            }


            // If the data valid
            if (true) {
//                $subscribedApplicant = new Applicant_SubscribedToLists();
//                $this->_f3->set('SESSION.subscribedApplicant', $subscribedApplicant);

                // Add the data to the session array
                $this->_f3->get('SESSION.subscribedApplicant')->setSelectionsVerticals($language);
                $this->_f3->get('SESSION.subscribedApplicant')->setSelectionsJobs($industry);
                $this->_f3->get('SESSION.subscribedApplicant')->setFname($firstName);
                $this->_f3->get('SESSION.subscribedApplicant')->setLname($lastName);
                $this->_f3->get('SESSION.subscribedApplicant')->setEmail($email);
                $this->_f3->get('SESSION.subscribedApplicant')->setState($state);
                $this->_f3->get('SESSION.subscribedApplicant')->setPhone($phone);
                $this->_f3->get('SESSION.subscribedApplicant')->setGithub($github);
                $this->_f3->get('SESSION.subscribedApplicant')->setExperience($exp);
                $this->_f3->get('SESSION.subscribedApplicant')->setRelocate($relocate);
                $this->_f3->get('SESSION.subscribedApplicant')->setBio($bio);


                // Send the user to the next form
                $this->_f3->reroute('summary');

            } else {
                // Temporary
                echo "<p>Validation errors</p>";
            }
        }

        //repeat checkboxes
        $language = DataLayer::getLanguage();
        $industry = DataLayer::getIndustry();
        $this->_f3->set('languages', $language);
        $this->_f3->set('industries', $industry);

        // Convert arrays to comma-separated strings for display
        $languageString = implode(', ', $language);
        $industryString = implode(', ', $industry);

        // Set these strings to the hive for use in the view
        $this->_f3->set('selectedLanguage', $languageString);
        $this->_f3->set('selectedIndustry', $industryString);

        $view = new Template();
        echo $view->render('views/mailing-list.html');

    }

    function summary()
    {
        echo "<pre>";
        var_dump ( $this->_f3->get('SESSION') );
        echo "</pre>";
        $this->_f3->set('user', $this->_f3->get('SESSION.mailingCheck') !== null ? $this->_f3->get('SESSION.subscribedApplicant') : $this->_f3->get('SESSION.applicant'));


        //echo below is used for testing before executing the template
//    echo '<h1>Hello Pets</h1>';

//    //Render a view page
        $view = new Template();
        echo $view->render('views/summary.html');

        session_destroy();
    }
}