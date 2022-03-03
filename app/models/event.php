<?php
//This event 'model class' is an Object Relational controller (ORM) of the FFF that uses F3's mapper method by extending
// its parent DB\SQL\Mapper class. ORMs sit between the app and the data and oversee CRUD Functions and map PHP object
// interactions to corresponding backend SQL queries. see https://fatfreeframework.com/3.7/databases#MapperDataStatus

Class event extends DB\SQL\Mapper { // DB\SQL\Mapper is a special mapping class component of F3 and at the heart of f3's ORM

    // Map Database---------------------------------------------

    public function __construct(DB\SQL $db)
    {
        parent::__construct($db, 'event');
    }

    // CRUD Model Functions ------------------------------------------

    //Create: save new objects to database function
        public function newevent() {
        $this->copyfrom('POST');
        $this->save();  
    }
    //Retrieve: Get all events
    public function getevents() { //query and retrieve all records from the DB table, results returned as an object.
        $this->load(); // $this is this class, 'event'.
        return $this->query;
    }
    //Retrieve: a particular event by email
    public function geteventByEmail($email) { // gets a particular record for subsequent processing
        $this->load(array('email=?',$email));
        $this->copyto('POST');
    }
    //Retrieve: a particular event
    public function geteventById($id) { // gets a particular record for subsequent processing
        $this->load(array('id=?',$id));
        $this->copyto('POST');
    }
    //Update: Change an existing object
    public function editevent($id) {
        $this->load(array('id=?',$id));
        $this->copyfrom('POST'); // array keys must be identical to database field names.
        $this->update();
    }
    //Delete:---------delete existing events
    public function deleteevent($id) {
        $this->load(['id=?', $id]); // load DB record matching the given ID then delete it
        $this->erase(); // deleted
    }
}//End of event mapping class definition
