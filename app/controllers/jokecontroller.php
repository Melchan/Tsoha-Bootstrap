<?php

class JokeController extends BaseController {
	
    public static function newJoke(){
        View::make('joke/newjoke.html');
    }

    public static function userJokes(){
        $user = BaseController::get_user_logged_in();
        $jokes = Joke::user_all($user->id);
        View::make('joke/ownerjokes.html', array('jokes' => $jokes));
    }

    public static function destroyJoke(){
        $params = $_POST;

        if(!is_null($params['id'])) {
            $joke = Joke::find($params['id']);
            $joke->destroy();
        
            $user = BaseController::get_user_logged_in();
            $jokes = Joke::user_all($user->id);
            View::make('joke/ownerjokes.html', array('jokes' => $jokes, 'message' => 'Vitsi poistettu'));
        }else{
            $errors = array();
            $errors[] = 'Vitsi ei poistunut';
            View::make('joke/ownerjokes.html', array('jokes' => $jokes, 'errors' => $errors));
        }
    }


	public static function store(){
        $params = $_POST;
        $user = BaseController::get_user_logged_in();

        $attributes = array(
            'title' => $params['title'],
          	'owner_id' => $user->id,
            'description' => $params['description'],
        );

        $joke = new Joke($attributes);
        $errors = $joke->errors();

        if(count($errors) > 0) {
            View::make('joke/newjoke.html', array('errors' => $errors, 'attributes' => $attributes));
        }else{
            $joke->save();

            Redirect::to('/', array('message' => 'Vitsi lisätty onnistuneesti!'));
        }   	
    }

    public static function show($id) {
    	$joke = Joke::find($id);
        $comments = Comment::jokeAll($id);
        $user = BaseController::get_user_logged_in();
    	View::make('/joke/joke.html', array('joke' =>$joke, 'user' =>$user, 'comments' => $comments));
    }
    // HTML puoli toteuttamatta
    public static function update($id) {
        $params = $_POST;
        $user = Owner::get_user_logged_in();

        $attributes = array(
            'title' => $params['title'],
            'owner_id' => $user->id,
            'description' => $params['description'],
        );

        $joke = new Joke($attributes);
        $errors = $joke->errors();

        if(count($errors) > 0) {
            View::make('joke/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        }else{
            $joke->update();
            Redirect::to('joke' . $joke->$id, array('message' => 'Vitsi muokattu onnistuneesti!'));
        }
    }
    public static function destroy($id) {
        $joke = new Joke(array('id' => $id));
        $joke->destroy();
        Redirect::to('/joke', array('message' => 'Vitsi poistettu onnistuneesti!'));
    }
}