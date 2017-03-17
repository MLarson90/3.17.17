<?php
  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/Contact.php";

  session_start();

  if (empty($_SESSION['list_of_address'])){
    $_SESSION["list_of_address"] = array();
  }

  $app = new Silex\Application();
  $app->regester(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));
 ?>
