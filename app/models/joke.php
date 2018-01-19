<?php

  class Joke extends BaseModel{

    public $id, $owner_id, $title, $description, $validators;

    public function __construct($attributes) {
    	parent::__construct($attributes);
        $this->validators = array('validate_title', 'validate_description', 'validate_owner_id');
    }

    public static function all() {

    	$query = DB::connection()->prepare('SELECT * FROM joke ORDER BY ts_create DESC');
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
        $query = DB::connection()->prepare('SELECT * FROM joke WHERE owner_id = :owner_id ORDER BY ts_create DESC');
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

    public function update(){
        $query = DB::connection()->prepare('UPDATE joke SET title = :title, description = :description 
            WHERE id = :id');
        $query->execute(array('id' => $this->id, 'title' => $this->title, 'description' => $this->description));
    }


    public function save() {

        $query = DB::connection()->prepare('INSERT INTO joke (owner_id, title, description) VALUES (:owner_id, :title, :description) RETURNING id');
    	$query->execute(array('owner_id' => $this->owner_id, 'title' => $this->title,
            'description' => $this->description));
    	$row = $query->fetch();
    	$this->id = $row['id'];
    }

    public function destroy(){
        $query = DB::connection()->prepare('DELETE FROM joke WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

    public function identicalTitle($title){
        $query = DB::connection()->prepare('SELECT * FROM joke WHERE title = :title LIMIT 1');
        $query->execute(array('title' => $title));
        $row = $query->fetch();
        if (strcmp($row['title'], $title)){
            return 0;
        } else {
            return 1;
        }
    }

    public function validate_title() {
        $errors = array();
        if($this->title == '' || $this->title == null) {
            $errors[] = 'Otsikko ei saa olla tyhjä.';
        }
        if($this->identicalTitle($this->title)){
            $errors[] = 'Otsikko ei ole uniikki';
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
        if(!is_int($this->owner_id)){
            $errors[] = 'owner_id sisältää jotain muuta kuin lukuja';
        }
        return $errors;
    }
  }
