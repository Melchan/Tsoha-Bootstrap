<?php

  class Joke extends BaseModel{

    public $id, $owner_id, $title, $description, $validators;

    public function __constructor($attributes) {
    	parent::__constructor($attributes);
        $this->validators = array('validate_title', 'validate_description', 'validate_owner_id');
    }

    public static function all() {

    	$query = DB::connection()->prepare('SELECT * FROM joke');
    	$query -> execute();
    	$rows = $query->fetchAll();
    	$jokes = array();


    	foreach ($rows as $row) {
    		
    		$jokes[] = new Joke(array(
    			'id' => $row['id'],
    			'owner_id' => $row['owner_id'],
    			'title' => $row['title'],
    			'description' => $row['description']
        		));
    	}

    	return $jokes;
    }

    public static function user_all($id){
        $query = DB::connection()->prepare('SELECT * FROM joke WHERE owner_id = :owner_id');
        $query -> execute(array('owner_id' => $id));
        $rows = $query->fetchAll();
        $jokes = array();

        foreach ($rows as $row) {
            
            $jokes[] = new Joke(array(
                'id' => $row['id'],
                'owner_id' => $row['owner_id'],
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
    			'owner_id' => $row['owner_id'],
    			'title' => $row['title'],
    			'description' => $row['description']
    		));
    		return $joke;
    	}

    	return null;
    }


        public static function save() {

    	$query = DB::connection()->prepare('INSERT INTO category (owner_id, title, description) VALUES (:owner_id, :title, :description) RETURNING id');
    	$query->execute(array('owner_id' => $this->owner_id, 'title' => $this->title,
            'description' => $this->description));
    	$row = $query->fetch();
    	//Kint::trace();
    	//Kint::dump($row);
    	$this->id = row['id'];
    }

        public function validate_title() {
            $errors = array();
            if($this->title == '' || $this->title == null) {
                    $errors[] = 'Otsikko ei saa olla tyhjä.';
            }
            return $errors;
        }

        public function validate_description() {
            $errors = array();
            if($this->description == '' || $this->description == null) {
                $errors[] = 'Vitsi osio ei saa olla tyhjä';
            }
            return $errors;
        }

        public function validate_owner_id() {
            $errors = array();
            if($this->owner_id == '' || $this->owner_id == null) {
                $errors[] = 'owner_id on tyhjä';
            }
            if(!is_int($this->owner_id){
                $errors[] = 'owner_id sisältää jotain muuta kuin lukuja';
            }
            return $errors;
        }
  }
