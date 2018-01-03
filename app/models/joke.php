<?php

  class Joke extends BaseModel{

    public $id, $owner_id, $title, $picture, $description, $postDate;

    public function __constructor($attributes) {
    	parent::__constructor($attributes);
    }

    public static function all() {

    	$query = DB::connection()->prepare('SELECT * FROM joke');
    	$query -> execute();
    	$rows = $query->fectAll();
    	$jokes = array();


    	foreach ($rows as $row) {
    		
    		$jokes[] = new Joke(array(
    			'id' => $row['id'],
    			'owner_id' => $row['owner_id'],
    			'title' => $row['title'],
    			'picture' => $row['picture'],
    			'description' => $row['description'],
    			'postDate' => $row['postDate']
    		));
    	}

    	return $jokes;
    }

    public static function find($id) {

    	$query = DB::connection()->prepare('SELECT * FROM joke WHERE id = :id LIMIT 1');
    	$query->execute(array('id' => $id));
    	$row = $query->fetc();

    	if($row) {
    		$joke = new Joke(array(
    			'id' => $row['id'],
    			'owner_id' => $row['owner_id'],
    			'title' => $row['title'],
    			'picture' => $row['picture'],
    			'description' => $row['description'],
    			'postDate' => $row['postDate']
    		));
    		return $joke;
    	}

    	return null;
    }

        public static function save() {

    	$query = DB::connection()->prepare('INSERT INTO category (owner_id, title, picture, description, postDate) VALUES (:owner_id, :title, :description, :postDate) RETURNING id');
    	$query->execute(array('owner_id' => $this->owner_id, 'title' => $this->title, 'picture' => $this->picture, 'description' => $this->description));
    	$row = $query->fetc();
    	//Kint::trace();
    	//Kint::dump($row);
    	$this->id = row['id'];
    	$this->postDate = row['postDate'];
    }
  }
