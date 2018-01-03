<?php

  $routes->get('/', function() {
    HelloWorldController::index();
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

  $routes->get('/login', function() {
    HelloWorldController::login();
  });

  $routes->get('/joke', function() {
    JokeController::index();
  });




