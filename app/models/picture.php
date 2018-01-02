<?php

  class Picture extends BaseModel{

    public $id, $owner_id, $title, $picture, $description, $postDate;

    public function __constructor($attributes) {
    	parent::__constructor($attributes);
    }
  }
