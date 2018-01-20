<?php
  
  function check_logged_in(){
    BaseController::check_logged_in();
  }



  $routes->get('/', function() {
    HomeController::home();
  });




  $routes->get('/login', function() {
    UserController::login();
  });
  
  $routes->post('/login', function(){
    UserController::handle_login();
  });

  $routes->post('/logout', 'check_logged_in', function(){
    UserController::logout();
  });

  $routes->get('/profile', 'check_logged_in', function(){
    UserController::profile();
  });

  $routes->post('/destroy', 'check_logged_in', function(){
    UserController::destroy();
  });

  $routes->post('/change_password', 'check_logged_in', function(){
    UserController::changePassword();
  });

  $routes->get('/register', function(){
    UserController::register();
  });

  $routes->post('/register', function(){
    UserController::handleRegistration();
  });



  $routes->get('/newjoke', 'check_logged_in', function(){
    JokeController::newJoke();
  });

  $routes->post('/newjoke', 'check_logged_in', function(){
    JokeController::store();
  });

  $routes->get('/userjokes', 'check_logged_in', function(){
    JokeController::userJokes();
  });

  $routes->get('/:id', function($id){
    JokeController::show($id);
  });

  $routes->post('/destroyjoke', 'check_logged_in', function(){
    JokeController::destroyJoke();
  });



  $routes->post('/addcomment', 'check_logged_in', function(){
    CommentController::addcomment();
  });