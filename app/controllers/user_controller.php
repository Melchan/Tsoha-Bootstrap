<?php

class UserController extends BaseController {
	
	public static function login(){
		View::make('user/login.html');
	}

	public static function register(){
		View::make('user/register.html');
	}

	public static function handle_login(){
		$params = $_POST;

		$user = Owner::authenticate($params['name'], $params['password']);

		if(!$user){
			View::make('user/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana.', 
				'name' => $params['name']));
		}else{
			$_SESSION['user'] = $user->$id;

			Redirect::to('/', array('message' => 'Tervetuloa' . $user->name . '!'));
		}
	}

	public static function logout(){
    	$_SESSION['user'] = null;
    	Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
    }

    public static function handleRegistration() {
    	$params = $_POST;

    	$attributes = array(
      		'name' => $params['name'],
      		'password' => $params['password'],
      		'passwordRe' => $params['passwordRe'],
    	);

    	$owner = new Owner($attributes);
    	$errors = $owner->errors();

    	if(count($errors) > 0){
    		view::make('user/register.html', array('errors' => $errors, 'attributes' => $attributes));
    	}else{
    		$owner->save();

    		Redirect::to('/' . $owner->id, array('message' => 'Olet luonut käyttäjätunnuksen!'));	
    	}
    }

}