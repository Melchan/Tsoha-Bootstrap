<?php
  class Category extends BaseModel{

    public $id, $tag, $validators;

    public function __construct($attributes) {
    	parent::__construct($attributes);
        $this->validators = array('validate_tag');
    }

    public static function all() {

    	$query = DB::connection()->prepare('SELECT * FROM category');
    	$query -> execute();
    	$rows = $query->fetchAll();
    	$categories = array();


    	foreach ($rows as $row) {
    		
    		$categories[] = new Category(array(
    			'id' => $row['id'],
    			'tag' => $row['tag']
    		));
    	}

    	return $categories;
    }

    public static function find($id) {

    	$query = DB::connection()->prepare('SELECT * FROM category WHERE id = :id LIMIT 1');
    	$query->execute(array('id' => $id));
    	$row = $query->fetch();

    	if($row) {
    		$category = new category(array(
    			'id' => $row['id'],
    			'tag' => $row['tag']
    		));
    		return $category;
    	}

    	return null;
    }

    public function update(){
        $query = DB::connection()->prepare('UPDATE category SET tag = :tag WHERE id = :id');
        $query->execute(array('id' => $this->id, 'tag' => $this->tag));
    }

    public function save() {

    	$query = DB::connection()->prepare('INSERT INTO category (tag) VALUES (:tag) RETURNING id');
    	$query->execute(array('tag' => $this->tag));
    	$row = $query->fetch();
    	//Kint::trace();
    	//Kint::dump($row);
    	$this->id = row['id'];
    }

    public function destroy(){
        $query = DB::connection()->prepare('DELETE FROM category WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

    public function validate_tag() {
        $errors = array();
        if($this->tag == '' || $this->tag == null) {
            $errors[] = 'categorian tagi ei saa olla tyhjä';
        }
        return $errors;
    }
  }
