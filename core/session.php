<?php
$hasSession=false;

if(!empty($_SESSION['user']['id'])){
  $hasSession=true;
}

if($hasSession===false){
  $goto = $_SERVER['PHP_SELF'];
  $qs = !empty($_SERVER['QUERY_STRING'])?"?{$_SERVER['QUERY_STRING']}":false;
  header('Location: /login.php?goto='.$goto.$qs);
}
