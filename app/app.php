<?php
  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/Contact.php";
  require_once __DIR__."/../src/User.php";

  session_start();

  if (empty($_SESSION['list_of_address'])){
    $_SESSION['list_of_address'] = array();
  }
  if (empty($_SESSION['list_of_user'])){
    $_SESSION['list_of_user'] = array();
  }

  $app = new Silex\Application();
  $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

  $app->get("/", function() use ($app){
    return $app['twig']->render('index.html.twig');
  });
  $app->post("/form", function() use ($app){
    $userName = new User($_POST['username']);
    $userName->setUserName();
    $userName->nameSave();
    return $app['twig']->render('form.html.twig', array('Username' => $userName));
  });
  $app->post('/addcontact', function() use ($app){
    $new_contact = new Contact($_POST['input_name'],$_POST['input_phone'],$_POST['input_address']);
    $new_contact->save();
    return $app['twig']->render('addcontact.html.twig', array('new_contact' => $new_contact));
  });
  $app->post('/viewcontacts', function() use ($app){
    $get_user_name = User::getUserName();
    $all_contacts = Contact::getAll();
    return $app['twig']->render('viewcontacts.html.twig', array('allcontacts' => $all_contacts, 'Username' => $get_user_name));
  });
  $app->post('/delete_all', function() use ($app){
    Contact::deleteAll();
    return $app['twig']->render('deleted.html.twig');
  });

  return $app;
 ?>
