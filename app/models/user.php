<?php
//This user 'model class' is an Object Relational controller (ORM) of the FFF that uses F3's mapper method by extending
// its parent DB\SQL\Mapper class. ORMs sit between the app and the data and oversee CRUD Functions and map PHP object
// interactions to corresponding backend SQL queries. see https://fatfreeframework.com/3.7/databases#MapperDataStatus
class user extends DB\SQL\Mapper { // DB\SQL\Mapper is a special mapping class component of F3.

    // Map Database---------------------------------------------

        public function __construct(DB\SQL $db){
            $combined= parent::__construct($db,'user');}


    // CRUD  Model Functions ------------------------------------------


    // Create: ========================================================================================================
    // save new objects to database function. called from pagecontroller/register.

    public function newUser() {
        $this->copyFrom('POST');
        $this->save(); // save new record
    }

    // Retrieve: ======================================================================================================

    // Get all Users
    public function getUsers() { //query and retrieve all records from the DB table, results returned as an object.
        $this->age='YEAR(CURDATE()) - YEAR(dob)';
//        $interests = $this->DB->exec('SELECT DISTINCT topics.topic_name
//                            FROM topics INNER JOIN topic_people_link
//                            ON topics.id=topic_people_link.topic_id
//                            WHERE topic_people_link.person_id');
        $this->load(); // $this is this class, 'user'.
        return $this->query;
        }

    //Retrieve: a particular image and output its contents with a header so that <img src="/image/ID" /> will work.
    // This is necessary because image files stored above the web root, have no direct URL.
    public function getImage($id)
    {
        global $f3;
        $this->load(['id=?', $id]); // load DB record matching the given ID
        $fileToShow =$f3->UPLOADS.$this['pic_file'];
        $type = mime_content_type($fileToShow);
        header('Content-type: ' . $type);  // write out the image file http header
        readfile($fileToShow);                    // write out raw file contents (image data) from the file path
    }

    //Retrieve: a particular user by id
    public function getUserById($id) { // gets a particular record for subsequent processing
        $this->load(array('id=?',$id));
        $this->copyTo('POST');
    }

    //Retrieve: a particular user by email
    public function getUserByEmail($email) { // gets a particular record for subsequent processing
        $this->load(array('email=?',$email));
        $this->copyTo('POST');
    }

    // Update: ========================================================================================================

    // Change an existing object
    public function UpdateUserById($id) {
        $this->load(array('id=?',$id));
        $this->copyFrom('POST');
        $this->update();
    }

    // Delete: ========================================================================================================
    // delete existing users
    public function deleteUser($id) {
        global $f3;
        $this->load(['id=?', $id]); // load DB record matching the given ID then delete it
        unlink($f3->UPLOADS.$this['pic_file']);  // remove the image file
        $this->erase(); // deleted
     }

    // Functions: =====================================================================================================

    public function calcAge($dob)
    { // Adapted from Madara's Ghost answer at https://stackoverflow.com/a/13648096
        function format_interval(DateInterval $interval)
        {
            $result = '';
            if ($interval->y) {
                $result .= $interval->format('%y years ');
            }
            if ($interval->m) {
                $result .= $interval->format('%m months ');
            }
            if ($interval->d) {
                $result .= $interval->format('%d days ');
            }
            if ($interval->h) {
                $result .= $interval->format('%h hours ');
            }
            if ($interval->i) {
                $result .= $interval->format('%i minutes ');
            }
            if ($interval->s) {
                $result .= $interval->format('%s seconds ');
            }
            return $result;
        }
        $first_date = new DateTime($dob);
        $second_date = new DateTime('now');
        $difference = $first_date->diff($second_date);
        return format_interval($difference);
    }

}//End of user mapping class definition
