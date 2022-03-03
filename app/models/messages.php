<?php
//This messages 'model class' is an Object Relational controller (ORM) of the FFF that uses F3's mapper method by extending
// its parent DB\SQL\Mapper class. ORMs sit between the app and the data and oversee CRUD Functions and map PHP object
// interactions to corresponding backend SQL queries. see https://fatfreeframework.com/3.7/databases#MapperDataStatus

class messages extends DB\SQL\Mapper { // DB\SQL\Mapper is a special mapping class component of F3.

    // Map Database---------------------------------------------

    public function __construct(DB\SQL $db){
        parent::__construct($db,'messages');}

    // CRUD Model Functions ------------------------------------------

    // Create: save new objects to database function
    public function newmessages() {
        $this->copyfrom('POST');
        $this->save(); // save new record
    }
    //Retrieve: Get all messagess
    public function getmessagess() { //query and retrieve all records from the DB table, results returned as an object.
        $this->load(); // $this is this class, 'messages'.
        return $this->query;
    }
    //Retrieve: a particular messages by email
    public function getmessagesByEmail($email) { // gets a particular record for subsequent processing
        $this->load(array('email=?',$email));
        $this->copyto('POST');
    }
    //Retrieve: a particular messages
    public function getmessagesById($id) { // gets a particular record for subsequent processing
        $this->load(array('id=?',$id));
        $this->copyto('POST');
    }
    //Update: Change an existing object
    public function editmessages($id) {
        $this->load(array('id=?',$id));
        $this->copyfrom('POST');
        $this->update();
    }
    //Delete:---------delete existing messagess
    public function deletemessages($id) {
        $this->load(['id=?', $id]); // load DB record matching the given ID then delete it
        $this->erase(); // deleted
    }
}//End of messages mapping class definition
