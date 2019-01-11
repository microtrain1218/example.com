<?php
$hasSession=false;

if(!empty($_SESSION['user']['id'])){
  $hasSession=true;
}

if($hasSession===false){
  //var_dump($_SESSION);
  header('Location: /login.php');
}
