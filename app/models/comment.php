<?php

  class Comment extends BaseModel{

    public $id, $message, $owner_id, $picture_id;

    public function __constructor($attributes) {
    	parent::__constructor($attributes);
    }

    public static function all() {

    	$query = DB::connection()->prepare('SELECT * FROM comment');
    	$query -> execute();
    	$rows = $query->fectAll();
    	$comments = array();


    	foreach ($rows as $row) {
    		
    		$comments[] = new Comment(array(
    			'id' => $row['id'],
    			'message' => $row['message'],
    			'owner_id' => $row['owner_id']
    			'picture_id' => $row['picture_id']
    		));
    	}

    	return $comments;
    }

    public static function find($id) {

    	$query = DB::connection()->prepare('SELECT * FROM comment WHERE id = :id LIMIT 1');
    	$query->execute(array('id' => $id));
    	$row = $query->fetc();

    	if($row) {
    		$comment = new Comment(array(
    			'id' => $row['id'],
    			'message' => $row['message'],
    			'owner_id' => $row['owner_id']
    			'picture_id' => $row['picture_id']
    		));
    		return $comment;
    	}

    	return null;
    }

        public static function save() {

    	$query = DB::connection()->prepare('INSERT INTO comment (message, owner_id, picture_id) 
    		VALUES (:message, :owner_id, :picture_id) RETURNING id');
    	$query->execute(array('message' => $this->message, 'owner_id' => $this->owner_id, 
    		'picture_id' => $this->picture_id));
    	$row = $query->fetc();
    	//Kint::trace();
    	//Kint::dump($row);
    	$this->id = row['id'];
    }
  }
