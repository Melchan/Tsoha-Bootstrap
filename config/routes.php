<?php

  $routes->get('/', function() {
    JokeController::index();
  });

  $routes->get('/login', function() {
    UserController::login();
  });
  
  $routes->post('/login', function(){
    UserController::handle_login();
  });

  $routes->get('/joke', function() {
    JokeController::index();
  });




  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/testuser', function() {
    HelloWorldController::testuser();
  });

  $routes->get('/testownerjoke', function() {
    HelloWorldController::testowenerjoke();
  });

  $routes->get('/testedit', function() {
    HelloWorldController::testedit();
  });