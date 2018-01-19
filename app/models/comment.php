<?php

  class Comment extends BaseModel{

    public $id, $message, $owner_id, $joke_id, $validators;

    public function __construct($attributes) {
    	parent::__construct($attributes);
        $this->validators = array('validate_message','validate_owner_id', 'validate_joke_id') ;
    }

    public static function all() {

    	$query = DB::connection()->prepare('SELECT * FROM comment ORDER BY ts_create DESC');
    	$query -> execute();
    	$rows = $query->fetchAll();
    	$comments = array();


    	foreach ($rows as $row) {
    		
    		$comments[] = new Comment(array(
    			'id' => $row['id'],
    			'message' => $row['message'],
    			'owner_id' => $row['owner_id'],
    			'joke_id' => $row['joke_id']
    		));
    	}

    	return $comments;
    }

    public static function find($id) {

    	$query = DB::connection()->prepare('SELECT * FROM comment WHERE id = :id LIMIT 1');
    	$query->execute(array('id' => $id));
    	$row = $query->fetch();

    	if($row) {
    		$comment = new Comment(array(
    			'id' => $row['id'],
    			'message' => $row['message'],
    			'owner_id' => $row['owner_id'],
    			'joke_id' => $row['joke_id'],
    		));
    		return $comment;
    	}

    	return null;
    }

    public static function jokeAll($joke_id){
        $query = DB::connection()->prepare('SELECT * FROM comment WHERE joke_id = :joke_id ORDER BY ts_create DESC');
        $query -> execute(array('joke_id' => $joke_id));
        $rows = $query->fetchAll();
        $comments = array();

        foreach ($rows as $row) {
            
            $comments[] = new Comment(array(
                'id' => $row['id'],
                'message' => $row['message'],
                'owner_id' => $row['owner_id'],
                'joke_id' => $row['joke_id'],
                ));
        }
        return $comments;
    }

    public static function userAll($owner_id){
        $query = DB::connection()->prepare('SELECT * FROM comment WHERE owner_id = :owner_id');
        $query -> execute(array('owner_id' => $owner_id));
        $rows = $query->fetchAll();
        $comments = array();

        foreach ($rows as $row) {
            
            $comments[] = new Comment(array(
                'id' => $row['id'],
                'message' => $row['message'],
                'owner_id' => $row['owner_id'],
                'joke_id' => $row['joke_id']
                ));
        }
        return $comments;
    }

    public function update(){
        $query = DB::connection()->prepare('UPDATE comment SET message = :message WHERE id = :id');
        $query->execute(array('id' => $this->id, 'message' => $this->message));
    }

    public function save() {

    	$query = DB::connection()->prepare('INSERT INTO comment (message, owner_id, joke_id) 
    		VALUES (:message, :owner_id, :joke_id) RETURNING id');
    	$query->execute(array('message' => $this->message, 'owner_id' => $this->owner_id, 
    		'joke_id' => $this->joke_id));
    	$row = $query->fetch();
    	//Kint::trace();
    	//Kint::dump($row);
    	$this->id = row['id'];
    }

    public function destroy(){
        $query = DB::connection()->prepare('DELETE FROM comment WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

    public function validate_message() {
        $errors = array();
        if($this->message == '' || $this->message == null) {
            $errors[] = 'viesti ei voi olla tyhjä.';
        }
        if(strlen($this->message) > 300) {
           $errors[] = 'viesti on yli 300 merkkiä pitkä.'; 
        }
        return $errors;
    }

    public function validate_owner_id() {
        $errors = array();
        if($this->owner_id == '' || $this->owner_id == null || !is_int($this->owner_id)) {
            $errors[] = 'owner_id ei ole automaattisesti asetettu kunnolla';
        }
        return $errors;
    }

    public function validate_joke_id() {
        $errors = array();
        if($this->joke_id == '' || $this->joke_id == null || !is_int($this->joke_id)) {
            $errors[] = 'joke_id ei ole automaattisesti asetettu kunnolla';
        }
        return $errors;
    }
  }
