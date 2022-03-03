<?php
// 'extends' makes 'PageController' a child class of the parent controller, 'BossController'.
// PageController is the controller of the page commands following routing from index.php

class PageController extends BossController {

    // Remember 'beforeroute()' from parent BossController will run first
    // also these are equivelent:

    // - function display($f3) {

    // - function display() {
    //    $f3=Base::instance();

    // Home
    //==================================================================================================================
    function render($f3) {
        $f3->set('content', 'dashboard.html'); // Provide the name of the view that will be rendered in the template
        echo Template::instance()->render('template.html');
        // or substitute last line for:
        // $template = new Template;
        // echo $template->render('template.html');
    }

    // Testing
    //==================================================================================================================

        function test($f3)
            {
                $f3->set('html_title', 'Test');
                echo Template::instance()->render('test.html');
            }

     function test1 ($f3)
         { /// notice the need to put $f3 as an argument in the function
            $f3->set('message', 'Hello world from a global variable set in index.php on ');
        echo $f3->get('message');
        }

    function test2($f3) {
        echo 'hello world from a call from index.php to the test2 function in MainController class ';
    }

    function error($f3)    {
        $f3->set('html_title', 'Error: '.$f3['ERROR']['code']);
        $f3->set('DUMP', catchData($f3['ERROR']));
        $f3->set('content', 'error.html');
        echo Template::instance()->render('template.html');
    }

    function test4 ($f3) { $f3->error(404); }

    function test5($f3)    {
        $f3->set('html_title','Test 5');
        $f3->set('content', 'jstest.html');
        echo Template::instance()->render('template.html');
    }

    function test6 ($f3)    {
        global $test;
        $test = $_SERVER['HOME'];
        $f3->set('html_title','Test 6 '.$test);
        $f3->set('DUMP', catchData($f3));
        $f3->set('content','error.html');
        echo template::instance()->render('template.html');
    }

    // Users
    //==================================================================================================================

    function listusers($f3){
        $user = new user($this->DB); // get new instance of the user mapper
        $f3->set('user',$user->getUsers());



//        public function getQuizVals() {
//            $list = $this->quizmapper->find();
//            $vals = array();
//            foreach ($list as $row) {
//                $arr = $this->quizmapper->cast($row);
//                array_push($vals, $arr);
//            }
//            return $vals;




        $f3->set('html_title','User List');
        $f3->set('content','listusers.html');
        echo Template::instance()->render('template.html');
    }

    function showImage($f3)  {
        $user = new user($this->DB); // get new instance of the mapper
        $user->getImage($f3->get('PARAMS.id'));
    }

    function callnewuser ($f3) {
        $f3->set('html_title','Register');
//        $f3->set('content','Register.html');
        echo Template::instance()->render('Register.html');
        // Notice that this does not call template.
        // ALso note that in BossController::BeforeRoute() there is an exclusion for requirement of session var to
        // run this page
    }

    function savenewuser ($f3) {

        // Hash password
        $password = $f3->get('POST.password'); // get the password from POST before saving it
        $f3->set('POST.password', password_hash( $password, PASSWORD_DEFAULT)); //return the modified password to POST

        // Avoid null image
        $imageprovided = $f3->get('POST.imageprovided');
        if ($imageprovided = '1'){ // image controller will crash if no image provided. This uses a fake field in register.html to avoid that.
            $users = new user($this->DB);    // get new instance of the mapper
            $image = new ImageController;   //instantiates a new object of type ImageController defined in ImageController.php
            // allowing use of its functions
            $filedata = $image->upload();   // this will be null if unsuccessful upload (upload() is in ImageController)
        }
        else
        {
            $f3->set('POST.pic_file', 'Person.png'); //the placeholder image will be returned to the db if no user image supplied
        }

        // Save form & acknowledge
        $user = new user($this->DB); // get new instance of the mapper
        $user->newUser();                //newUser() saves all post values to SQL table 'user'
        $f3->set('html_title', 'Welcome');
        $f3->set('content', 'welcome.html');    // Welcome new user
        echo Template::instance()->render('template.html');
    }

    function callupdateuser($f3) {
        $user = new user($this->DB); // get new instance of the mapper
        $user-> getUserById($f3->get('PARAMS.id')); // get specified users' details
        $check = $user->get('email'); // reroute if there is no user for that id
            if (is_null($check)) {
                $f3->reroute('/');
            }
            else
            {
                $f3->set('user', $user);
                $f3->set('html_title', 'Update User');
                $f3->set('content', 'UpdateUser.html');
                echo Template::instance()->render('template.html');
            }
    }// end of callupdateuser function

    function saveupdateuser($f3)
    {

        $failedvalidation=0;
        // Check if user id exists, if so user will be updated
        if ($f3->exists('POST.id')) {
            $user = new user($this->DB);    // get new instance of the mapper
            $oldpassword = $f3->get('POST.oldpassword');  // Check that old password given is correct, if not back to changeuser
            if ($oldpassword === "" |$oldpassword === null)
                {
                    //do stuff
                }
            else{
                    // ignore this section if password not changed
                    echo'checking if password changed <br>';
                    if (password_verify($oldpassword, $user->password)) { //check that old password is correct.
                        echo'checking if password ok <br>';
                        // if ok encrypt and save new password
                        $password = $f3->get('POST.password'); // get the password from POST before saving it
                        $f3->set('POST.password', password_hash($password, PASSWORD_DEFAULT)); //return the modified password to POST
                    }
                    else
                    { // Password not ok -
                        echo 'Password not ok';
                        $failedvalidation=1;
                    } // end of password checks
            }// end of check if password changed

//            $image = new ImageController;   //instantiates a new object of type ImageController defined in ImageController.php
//            // allowing use of its functions
//            $filedata = $image->upload();   // this will be null if unsuccessful upload (upload() is in ImageController)

            $user->UpdateUserById($f3->get('POST.id'));
        } // end of updating and end of user does exist
        else
        { //user doesnt exist
            echo 'No such user! - we should never see this warning!!';
            $failedvalidation=1;
        }// end of user exists check
        if ($failedvalidation ==1){
            $f3->set('html_title', 'Wrong Passwords');
            $f3->set('content', 'WrongPW.html');    // Welcome new user
            echo Template::instance()->render('template.html');
        }
        else{
            $f3->set('html_title', 'Changes Saved');
            $f3->set('content', 'ChangesSaved.html');    // Welcome new user
            echo Template::instance()->render('template.html');
        }
      } // end of saveupdateuser function.


    function deleteuser($f3){
        if ($f3->exists('PARAMS.id')) { // if the user id exists, it will be deleted
            $user = new User($this->DB);// get new instance of the mapper
            $user->deleteUser($f3->get('PARAMS.id'));
        }
        $f3->reroute('/ListUsers');
    }


        function logout($f3){
            // remove all session variables
            session_unset();
            session_destroy();
            $this->f3->reroute('/login'); // - Reroute to login page
            exit;                                    // stop continuation of this controller.
        }


    // Topics
    //==================================================================================================================

    function listtopics ($f3) {
        $topics = new topics($this->DB);// get new instance of the mapper
        $f3->set('topics', $topics->gettopics());
        $f3->set('html_title','Topic List');
        $f3->set('content','ListTopics.html');
        echo Template::instance()->render('template.html');
    }

    function callnewtopic ($f3) {
        $f3->set('html_title','New Topic');
        $f3->set('content','NewTopic.html');
        echo Template::instance()->render('template.html');
    }

    function savenewtopic ($f3) {
        $topic = new topics($this->DB);   // get new instance of the mapper
        $topic->newtopic();                //newtopic() saves all post values to SQL table 'topic'
        echo 'Topic Saved';
    }

    // Events
    //==================================================================================================================

    function listevents ($f3) {
        $event = new event($this->DB);// get new instance of the mapper
        $f3->set('event', $event->getevents());
        $f3->set('html_title','Event List');
        $f3->set('content','ListEvents.html');
        echo Template::instance()->render('template.html');
    }

    function callnewevent ($f3) {
        $f3->set('html_title','New Topic');
        $f3->set('content','NewEvent.html');
        echo Template::instance()->render('template.html');
    }

    function savenewevent ($f3) {
        $event = new event($this->DB);    // get new instance of the mapper
        $event->newevent();                //newevent() saves all post values to SQL table 'event'
        echo 'Event Saved';
    }

    // User Interests
    //==================================================================================================================

    function interests($f3)  {
        $user = new interests($this->DB);// get new instance of the mapper
        $user->getInterests($f3->get('PARAMS.id'));
    }

    // Messages
    //==================================================================================================================

    function displayMessages($f3) {
        $messages= new Messages($this->DB); // // get new instance of the mapper
        $f3->set('messages', $messages->getmessagess()); // Create variable to pass all the messages to the template
        $f3->set('content', 'messages.html'); // Provide the name of the view that will be rendered in the template
        echo Template::instance()->render('template.html');
    }

    //this is a function to return json data rather than render a template
    function apiMessages($f3){
        $messages = new Messages($this->DB);// get new instance of the mapper
        $data = $messages->getmessagess();           // retrieve all data from the table
        // However, by design, PHP will not allow serialisation of query data
        // if the object has protected attributes with json_encode. Need this workaround.
        $json = array();
        foreach($data as $row) {            // Manually extract each attribute value pair into an array for each row.
            $item = array();
            foreach($row as $key => $value) {
                $item[$key] = $value;
            }
            array_push($json, $item);
        }
        $f3->set('html_title', 'JSON Messages');
        $f3->set('content', json_encode($json));  // can now convert the array $json into json data
        echo json_encode($json);
    }

    function displayMessagesAjaxView($f3) {
        $f3->set('content', 'messagesajax.html');
        echo Template::instance()->render('template.html');
    }


    // Others yet to be developed
    //==================================================================================================================

    function about ($f3) {
        $file = F3::instance()->read('app/assets/text/readme.md');
        $html = Markdown::instance()->convert($file);
        $f3->set('article_html', $html);
        $f3->set('content','article.html');
        echo Template::instance()->render('template.html');
    }

    function search ($f3) {
        $f3->set('html_title','Search');
        $f3->set('content','search.html');
        echo Template::instance()->render('template.html');
    }




}// End of PageController Class
