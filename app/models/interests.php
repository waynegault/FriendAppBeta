<?php
//This interests 'model class' is an Object Relational controller (ORM) of the FFF that uses F3's mapper method by extending
// its parent DB\SQL\Mapper class. ORMs sit between the app and the data and oversee CRUD Functions and map PHP object
// interactions to corresponding backend SQL queries. see https://fatfreeframework.com/3.7/databases#MapperDataStatus

class interests extends DB\SQL\Mapper { // DB\SQL\Mapper is a special mapping class component of F3.

    // Map Database---------------------------------------------

    public function __construct(DB\SQL $db){
        parent::__construct($db,'topic_people_link');}

    // CRUD Model Functions ------------------------------------------

   //Retrieve: Get the interests of a particular user id
    public function getInterests($id){
        $query = "SELECT topics.topic_name FROM topics, topic_people_link 
        WHERE topics.id = topic_people_link.topic_id AND topic_people_link.person_id =?";
        $this->DB->exec($query, $id);
        return $this->query;
    }



//
//    // Create: save new objects to database function
//    public function newinterests() {
//        $this->copyfrom('POST');
//        $this->save(); // save new record
//    }
//    //Retrieve: Get all interestss
//    public function getinterestss() { //query and retrieve all records from the DB table, results returned as an object.
//        $this->load(); // $this is this class, 'interests'.
//        return $this->query;
//    }
//    //Retrieve: a particular interests by email
//    public function getinterestsByEmail($email) { // gets a particular record for subsequent processing
//        $this->load(array('email=?',$email));
//        $this->copyto('POST');
//    }
//
//    //Update: Change an existing object
//    public function editinterests($id) {
//        $this->load(array('id=?',$id));
//        $this->copyfrom('POST');
//        $this->update();
//    }
//    //Delete:---------delete existing interestss
//    public function deleteinterests($id) {
//        $this->load(['id=?', $id]); // load DB record matching the given ID then delete it
//        $this->erase(); // deleted
//    }
}//End of interests mapping class definition
