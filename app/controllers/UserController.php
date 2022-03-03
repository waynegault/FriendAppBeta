<?php
class UserController extends BossController {
// 'extends' makes 'UserController' a child class of the parent controller, 'BossController'.
// This controller simply renders the login.

    function beforeroute(){} // This is empty to override the beforeroute function in the parent 'controller' class.
    // This is needed to enable the login page to be displayed even if the user is not logged in.
    // (Otherwise a lack of session id would prevent the login page running before we've logged in

    function render() { // starts the login screen
        $template = new Template;
        echo $template->render('login.html');    }

    function authenticate() {
        $email = $this->f3->get('POST.email'); //data from login.html via POST method
        $password = $this->f3->get('POST.password');
        $user = new user($this->DB);    // get new instance of the mapper
        $user->getUserByEmail($email);      // ie running a query in user.php against the db to find the user with this email.
        if($user->dry())
            {  //'dry' if no records with this email. Dry is a method of the SQL mapper class.
                $this->f3->reroute('/login'); // if dry, user does not exist -> sends user back to login
            }
        else
            {
                 // Password saved to db prepared with 'echo password_hash('Hello123', PASSWORD_DEFAULT);'
                if(password_verify($password,  $user -> password))
                    { //compare pw given with pw stored in db. if ok: Create  FFF session variables to enable the user to stay logged in during the session
                        $this->f3->set('SESSION.user.email', $user->email);
                        $this->f3->set('SESSION.user.id', $user->id);
                        // Increment visit count



                        $this->f3->reroute('/');   // - Reroute to root page
                    }
                else
                    {
                        $this->f3->reroute('/login'); // - Reroute to login page
                    }
            }

    $visit = $user->get(visits);



    }// end of authenticate method

}// end of UserController class definition
