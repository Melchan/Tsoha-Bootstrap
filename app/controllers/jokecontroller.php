<?php

class JokeController extends BaseController {
	
	public static function index() {
		$jokes = Joke::all();
		View::make('index.html', array('jokes' => $jokes));
	}

	public static function store(){
    $params = $_POST;
    	if (checkTitle($params['name']) 
    		&& checkOwnerName($params['owner_name'])
    		&& checkDescription($params['description'])) 
    	{
    		$joke = new Joke(array(
      			'title' => $params['title'],
      			'owner_name' => $params['owner_name'],
      			'description' => $params['description'],
    		));

    		$joke->save();

    		Redirect::to('/' . $joke->id, array('message' => 'Vitsi on lisätty kirjastoosi!'));

    	} 
    }

    public static function joke($id) {
    	$joke = Joke::find($id);
    	View::make('joke.html', array('joke' =>$joke));
    }

    private boolean function checkTitle($title) {
    	if ($title != '' && strlen($title) >= 3) {
    		return true;
    	} else {
    		View::make('/new.html', array('error' => 'Otsikossa oli virhe!'));
    		return false;
    	}
    }

    private boolean function checkOwnerName($name) {
    	if ($name != '' && strlen($name) >= 2) {
    		return true;
    	} else {
    		View::make('/new.html', array('error' => 'Luojan nimessä virhe oli virhe!'));
    		return false;
    	}
    }

    private boolean function checkDescription($description) {
    	if ($title != '' && strlen($title) >= 5) {
    		return true;
    	} else {
    		View::make('/new.html', array('error' => 'Vitsissä oli virhe!'));
    		return false;
    	}
    }

    private boolean function checkTitle($title) {
    	if ($title != '' && strlen($title) >= 3) {
    		return true;
    	} else {
    		View::make('/new.html', array('error' => 'Otsikossa oli virhe!'));
    		return false;
    	}
    }

}