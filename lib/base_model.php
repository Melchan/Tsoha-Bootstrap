<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();
      //ei saatana
      if (is_array($this->validators)){
        foreach($this->validators as $validator){
          // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
          $validator_errors = $this->{$validator}();
          $errors = array_merge($errors,$validator_errors);
        }
      } else {
        $errors = array('validators on tyhjä kutsutulle luokalle', 'en vittu tiedä mikä mättää');
      }
      return $errors;
    }

  }
