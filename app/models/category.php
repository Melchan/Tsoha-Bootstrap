<?php

  class Category extends BaseModel{

    public $id, $tag;

    public function __constructor($attributes) {
    	parent::__constructor($attributes);
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

    public static function save() {

    	$query = DB::connection()->prepare('INSERT INTO category (tag) VALUES (:tag) RETURNING id');
    	$query->execute(array('tag' => $this->tag));
    	$row = $query->fetch();
    	//Kint::trace();
    	//Kint::dump($row);
    	$this->id = row['id'];
    }
  }
