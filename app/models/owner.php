<?php

  class Owner extends BaseModel{

    public $id, $name, $password;

    public function __constructor($attributes) {
    	parent::__constructor($attributes);
    }
  }
