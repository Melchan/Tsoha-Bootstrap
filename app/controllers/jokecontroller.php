<?php

class JokeController extends BaseController {
	
	public static function index() {
		$jokes = Joke::all();
		View::make('index.html', array('jokes' => $jokes));
	}

	public static function store(){
    $params = $_POST;
    $joke = new Joke(array(
      'title' => $params['title'],
      'owner_name' => $params['owner_name'],
      'description' => $params['description'],
      'publisher' => $params['publisher']
    ));

    $joke->save();

    Redirect::to('/' . $joke->id, array('message' => 'Vitsi on lisätty kirjastoosi!'));
    }

    public static function joke($id) {
    	$joke = Joke::find(:id);
    	View::make('joke.html', array('joke' =>$joke))
    }

}