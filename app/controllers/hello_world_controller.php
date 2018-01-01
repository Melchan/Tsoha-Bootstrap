<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('home.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');
    }

    public static function testedit(){
      // Testaa koodiasi täällä
      View::make('testedit.html');
    }

    public static function testlogin(){
      // Testaa koodiasi täällä
      View::make('testlogin.html');
    }

    public static function testuser(){
      // Testaa koodiasi täällä
      View::make('userpictures.html');
    }

    public static function testuserpicture(){
      // Testaa koodiasi täällä
      View::make('userpicture.html');
    }

  }
