<?php
  class User{
    private $user_name;

    function __construct__($user_name){
      $this->user_name = $user_name;
    }
    function getUserName(){
      return $this->user_name;
    }
    function setUserName($new_name){
      $this->user_name = (string)$new_name;
    }
    function nameSave(){
      array_push($_SESSION['list_of_user'], $this);
    }
    static function getUserName(){
      return $_SESSION['list_of_user'];
    }
  }
 ?>
