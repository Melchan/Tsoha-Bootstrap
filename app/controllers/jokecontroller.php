<?php

class JokeController extends BaseController {
	
	public static function index() {
		$jokes = Joke::all();
		View::make('index.html', array('jokes' => $jokes));
	}


	public static function store(){
    $params = $_POST;
    $user = $this->get_user_logged_in();

    	$joke = new Joke(array(
      		'title' => $params['title'],
      		'owner_id' => $user->id,
      		'description' => $params['description'],
    	));

    	$joke->save();

    	Redirect::to('/' . $joke->id, array('message' => 'Vitsi on lisätty kirjastoosi!'));

    	
    }

    public static function joke($id) {
    	$joke = Joke::find($id);
    	View::make('joke.html', array('joke' =>$joke));
    }
    // HTML puoli toteuttamatta
    public static function update($id) {
        $params = $_POST;
        $user = $this->get_user_logged_in();

        $attributes = array(
            'title' => $params['title'],
            'owner_id' => $user->id,
            'description' => $params['description'],
        );

        $joke = new Joke($attributes);
        $errors = $joke->errors();

        if(count($errors) > 0) {
            view::make('joke/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        }else{
            $joke->update();

            Redirect::to('joke' . $joke->$id, array('message' => 'Vitsi muokattu onnistuneesti!'));
        }
    }
    //html puoli toteuttamatta
    public static function destroy($id) {
        $joke = new Joke(array('id' => $id));
        $joke->destroy();
        Redirect::to('/joke', array('message' => 'Vitsi poistettu onnistuneesti!'));
    }

}