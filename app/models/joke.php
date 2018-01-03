<?php

  class Joke extends BaseModel{

    public $id, $owner_name, $title, $description;

    public function __constructor($attributes) {
    	parent::__constructor($attributes);
    }

    public static function all() {

    	$query = DB::connection()->prepare('SELECT * FROM joke');
    	$query -> execute();
    	$rows = $query->fetchAll();
    	$jokes = array();


    	foreach ($rows as $row) {
    		
    		$jokes[] = new Joke(array(
    			'id' => $row['id'],
    			'owner_name' => $row['owner_name'],
    			'title' => $row['title'],
    			'description' => $row['description']
        		));
    	}

    	return $jokes;
    }

    public static function find($id) {

    	$query = DB::connection()->prepare('SELECT * FROM joke WHERE id = :id LIMIT 1');
    	$query->execute(array('id' => $id));
    	$row = $query->fetch();

    	if($row) {
    		$joke = new Joke(array(
    			'id' => $row['id'],
    			'owner_name' => $row['owner_name'],
    			'title' => $row['title'],
    			'description' => $row['description']
    		));
    		return $joke;
    	}

    	return null;
    }


        public static function save() {

    	$query = DB::connection()->prepare('INSERT INTO category (owner_name, title, description) VALUES (:owner_name, :title, :description) RETURNING id');
    	$query->execute(array('owner_name' => $this->owner_name, 'title' => $this->title,
            'description' => $this->description));
    	$row = $query->fetch();
    	//Kint::trace();
    	//Kint::dump($row);
    	$this->id = row['id'];
    }
  }
