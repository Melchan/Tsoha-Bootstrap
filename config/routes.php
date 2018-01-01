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

  $routes->get('/testuserpicture', function() {
    HelloWorldController::testedit();
  });

