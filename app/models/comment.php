<?php

  class Comment extends BaseModel{

    public $id, $message, $owner_id, $picture_id;

    public function __constructor($attributes) {
    	parent::__constructor($attributes);
    }
  }
