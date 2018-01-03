<?php

class JokeController extends BaseController {
	
	public static function index() {
		$jokes = Joke::all();
		View::make('index.html', array('tasks' => $jokes));
	}
}