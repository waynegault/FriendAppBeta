<?php
// This is the parent class of all the other controllers in this app.
// What ever is added here is available to all child controllers.
// The database is mainly used via this controller - ie where we get data from and pass data to the database; where we maintain connection with the  database.

class BossController {

    // definitions of visibility of a property/method:
    //protected: all classes that extend current class including the parent class.

    protected $f3; //create another instance of $f3.
    protected $DB;

	function beforeroute() //this event handler method will run before any other function or routing occurs
        {
          if($this->f3->get('PATH') == "/Register")
            {
                //            stuff
            }
            else
            {
                if ($this->f3->get('SESSION.user.email') === null) { //if session.user is null, we are not logged in.
                    $this->f3->reroute('/login');            // therefor go back to login page
                    exit;                                    // stop continuation of this controller.
                }
            }
	} // End of beforeroute()

	function afterroute(){ //this event handler method will run after any other function when a routing is called
	} // End of afterroute()

    function __construct() { // Database connection
        $f3=Base::instance(); // create a new instance of F3
        $db = DatabaseConnectionApp::connect(); // In AboveWebRoot/autoload/. Creates a new instance of DB/SQL
        $this->DB=$db; // get new instance of the database
        $this->f3=$f3; // Added to the parent controller, these class variables provide easy access in our other controllers.

    }

}//End of BossController class
