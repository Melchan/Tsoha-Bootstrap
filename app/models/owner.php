<?php

  class Owner extends BaseModel{

    public $id, $name, $password, $passwordRe, $validators;

    public function __construct($attributes) {
    	parent::__construct($attributes);
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

    public static function find($id){

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

    public function update(){
        $query = DB::connection()->prepare('UPDATE owner SET password = :password WHERE id = :id');
        $query->execute(array('id' => $this->id, 'password' => $this->password));
    }

    public function save(){
  		$query = DB::connection()->prepare('INSERT INTO owner (name, password) VALUES (:name, :password) RETURNING id');
  		$query->execute(array('name' => $this->name, 'password' => $this->password));
  		$row = $query->fetch();
  		//Kint::trace();
  		//Kint::dump($row);
  		$this->id = $row['id'];
    }

    public function destroy(){
        $query = DB::connection()->prepare('DELETE FROM owner WHERE id = :id');
        $query->execute(array('id' => $this->id));
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

    public function checkName($name){
        $query = DB::connection()->prepare('SELECT * FROM owner WHERE name = :name LIMIT 1');
        $query->execute(array('name' => $name));
        $row = $query->fetch();

        $query = DB::connection()->prepare('SELECT * FROM owner WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $this->id));
        $row2 = $query->fetch();

        if(strcmp($row['name'],$name) && is_null($row2)){
            return 1;
        } else {
            return 0;
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

        if($this->checkName($this->name)){
            $errors[] = 'nimi ei ole uniikki';
        }

        return $errors;
    }

    public function validate_password() {
        $errors = array();
        if($this->password == '' || $this->password == null){
            $errors[] = 'salasana ei voi olla tyhjä.';
        }

        if(strcmp($this->password,$this->passwordRe)){
            $errors[] = 'salasanat eivät täsmää.';
        }

        if(strlen($this->password) > 20){
            $errors[] = 'salasana on yli 20 merkkiä.';
        }

        if(strlen($this->password) < 4){
            $errors[] = 'salasana on alle 4 merkkiä.';
        }
        return $errors;
    }


  }
