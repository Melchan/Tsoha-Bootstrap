<?php

  class CommentController extends BaseController {

  	public static function addcomment(){
  		$params = $_POST;
        $user = BaseController::get_user_logged_in();

        $attributes = array(
            'message' => $params['message'],
          	'owner_id' => $user->id,
            'joke_id' => $params['joke_id']
        );

        $comment = new Comment($attributes);
        $errors = $comment->errors();

        if(count($errors) > 0) {
            Redirect::to('/'.$params['joke_id'], array('errors' => $errors));
        }else{
            $comment->save();

            Redirect::to('/'.$params['joke_id'], array('message' => 'Kommentti lisätty!'));
        }   	
  	}
  }