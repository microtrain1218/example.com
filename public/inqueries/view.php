<?php
require '../../core/functions.php';
require '../../core/session.php';
require '../../config/keys.php';
require '../../core/db_connect.php';

$input = filter_input_array(INPUT_GET);

$id = !(empty($input['id']))?$input['id']:null;
$email = !(empty($input['email']))?$input['email']:null;

if(!empty($email)){
  $lookup = $email;
  $where = 'email = :lookup';
}else{
  $lookup = $id;
  $where = 'id = :lookup';
}


$stmt = $pdo->prepare("SELECT * FROM inqueries WHERE {$where}");
$stmt->execute(['lookup'=>$lookup]);
$row = $stmt->fetch();

$meta=[];
$meta['title']="{$row['name']} says:";

$content=<<<EOT
<h1>{$row['name']} Says</h1>
<div><strong>name:</strong> {$row['name']}</div>
<div><strong>email:</strong> {$row['email']}</div>
<div><strong>message:</strong> {$row['body']}</div>

<hr>
<div>
  <a class="btn btn-link" href="mailto:{$row['email']}">Respond</a>
  <a class="btn btn-link text-danger" href="inqueries/delete.php?id={$row['id']}">Delete</a>
</div>
EOT;

require '../../core/layout.php';
