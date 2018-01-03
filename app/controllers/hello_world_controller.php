<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('home.html');
    }

    public static function sandbox(){
      //$skyrim = Joke::find(1);
      $Owners = Owner::all();
      // Kint-luokan dump-metodi tulostaa muuttujan arvon
      Kint::dump($Owners);
      //Kint::dump($skyrim);
    }

    public static function testedit(){
      // Testaa koodiasi täällä
      View::make('testedit.html');
    }

    public static function login(){
      // Testaa koodiasi täällä
      View::make('login.html');
    }

    public static function testuser(){
      // Testaa koodiasi täällä
      View::make('ownerjokes.html');
    }

    public static function testownerjoke(){
      // Testaa koodiasi täällä
      View::make('ownerjoke.html');
    }

  }
