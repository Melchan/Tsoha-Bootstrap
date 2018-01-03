<?php

class JokeController extends BaseController {
	
	public static function index() {
		$jokes = Joke::all();
		View::make('joke/index.html', array('tasks' => $jokes));
	}
}