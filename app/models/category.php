<?php

  class Category extends BaseModel{

    public $id, $tag;

    public function __constructor($attributes) {
    	parent::__constructor($attributes);
    }
  }
