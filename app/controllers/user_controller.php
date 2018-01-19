<?php

class UserController extends BaseController {
	
	public static function login(){
		View::make('user/login.html');
	}

	public static function register(){
		View::make('user/register.html');
	}

	public static function profile(){
		View::make('user/profile.html');
	}

	public static function handle_login(){
		$params = $_POST;

		$user = Owner::authenticate($params['name'], $params['password']);

		if(!$user){
			View::make('user/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana.', 
				'name' => $params['name']));
		}else{
			$_SESSION['user'] = $user->id;

			Redirect::to('/', array('message' => 'Tervetuloa' . $user->name . '!'));
		}
	}

	public static function logout(){
    	$_SESSION['user'] = null;
    	Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
    }

    public static function changePassword(){
    	$params = $_POST;
        $user = BaseController::get_user_logged_in();
        $owner = Owner::authenticate($user->name, $params['password']);

        $attributes = array(
        	'id' => $user->id,
      		'name' => $user->name,
      		'password' => $params['newPassword'],
      		'passwordRe' => $params['newPasswordRe'],
    	);

        $user = new Owner($attributes);
        $errors = $user->errors();

        if(count($errors) > 0){
    		View::make('user/profile.html', array('errors' => $errors));
    	}else{
    		$user->update();

    		Redirect::to('/profile', array('message' => 'Olet luonut vaihtanut salasanan!'));	
    	}
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
    		View::make('user/register.html', array('errors' => $errors, 'attributes' => $attributes));
    	}else{
    		$owner->save();

    		Redirect::to('/login', array('message' => 'Olet luonut käyttäjätunnuksen!'));	
    	}
    }

    public static function destroy() {
    	$params = $_POST;
        $user = BaseController::get_user_logged_in();
        $owner = Owner::authenticate($user->name, $params['password']);

        if (is_null($owner)) {
        	$errors = array();
        	$errors[] = 'salasana oli väärin';
        	View::make('user/profile.html', array('errors' => $errors));
        } else {
            $comments =  Comment::userAll($owner->id);
            if (!is_null($comments)){
                foreach ($comments as $comment) {
                    $comment->destroy();
                }
            }
        	$jokes = Joke::user_all($owner->id);
        	if (!is_null($jokes)){
        		foreach ($jokes as $joke) {
        			$joke->destroy();
        		}
        	}
    		$owner->destroy();
    		$_SESSION['user'] = null;
    		Redirect::to('/login', array('error' => 'Olet tuhonnut käyttäjä tilisi, vitsisi, kommenttisi ja vitseihisi liitetyt kommentit!'));
        }
    } 
}