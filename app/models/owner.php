<?php

  class Owner extends BaseModel{

    public $id, $name, $password, $passwordRe, $validators;

    public function __constructor($attributes) {
    	parent::__constructor($attributes);
        $this->validators = array('validate_name', 'validate_password');
    }

    public static function all() {

    	$query = DB::connection()->prepare('SELECT * FROM owner');
    	$query -> execute();
    	$rows = $query->fetchAll();
    	$owners = array();

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
    		return $owner;
    	}

    	return null;
    }

    public static function save(){
  		$query = DB::connection()->prepare('INSERT INTO owner (name, password) VALUES (:id, :name, :password) RETURNING id');
  		$query->execute(array('name' => $this->name, 'password' => $this->password));
  		$row = $query->fetch();
  		//Kint::trace();
  		//Kint::dump($row);
  		$this->id = $row['id'];
    }

    public static function authenticate($user_name, $user_password){
        $query = DB::connection()->prepare('SELECT * FROM Owner WHERE name = :name AND password = :password 
            LIMIT 1');
        $query->execute(array('name' => $user_name, 'password' => $user_password));
        $row = $query->fetch();
        if($row){
            $owner = new Owner(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password']
            ));
            return $owner; 
        }else{
            return null;
        }
    }
    

    public function validate_name() {
        $errors = array();
        if($this->name == '' || $this->name == null) {
            $errors[] = 'nimi ei voi olla tyhjä.';
        }

        if(strlen($this->name) > 20) {
            $errors[] = 'nimi on yli 20 merkkiä.';
        }

        if(strlen($this->name) < 4) {
            $errors[] = 'nimi on alle 4 merkkiä.';
        }

        return $errors;
    }

    public function validate_password() {
        $errors = array();
        if($this->password == '' || $this->password == null) {
            $errors[] = 'salasana ei voi olla tyhjä.';
        }

        if($this->password != $this->passwordRe) {
            $errors[] = 'salasanat eivät täsmää.';
        }

        if(strlen($this->password) > 20) {
            $errors[] = 'salasana on yli 20 merkkiä.';
        }

        if(strlen($this->password) < 4) {
            $errors[] = 'salasana on alle 4 merkkiä.';
        }
        return $errors;
    }


  }
