<?php

  class Owner extends BaseModel{

    public $id, $name, $password;

    public function __constructor($attributes) {
    	parent::__constructor($attributes);
    }

    public static function all() {

    	$query = DB::connection()->prepare('SELECT * FROM owner');
    	$query -> execute();
    	$rows = $query->fetchAll();
    	$owners = array();
        echo sizeof($owners);


    	foreach ($rows as $row) {
    		
    		$owners[] = new Owner(array(
    			'id' => $row['id'],
    			'name' => $row['name'],
    			'password' => $row['password']
    		));
    	}

    	return $owners;
    }

    public static function find($id) {

    	$query = DB::connection()->prepare('SELECT * FROM owner WHERE id = :id LIMIT 1');
    	$query->execute(array('id' => $id));
    	$row = $query->fetch();

    	if($row) {
    		$owner = new Owner(array(
    			'id' => $row['id'],
    			'name' => $row['name'],
    			'password' => $row['password']
    		));
    		return $game;
    	}

    	return null;
    }

    public function save(){
  		$query = DB::connection()->prepare('INSERT INTO owner (name, password) VALUES (:id, :name, :password) RETURNING id');
  		$query->execute(array('name' => $this->name, 'password' => $this->password));
  		$row = $query->fetch();
  		//Kint::trace();
  		//Kint::dump($row);
  		$this->id = $row['id'];
}
  }
