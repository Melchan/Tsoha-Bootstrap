<?php

  class HomeController extends BaseController {

  	public static function home(){
  		$jokes = Joke::all();
		View::make('home.html', array('jokes' => $jokes));
  	}
  }