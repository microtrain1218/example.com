<?php
require '../../core/functions.php';
require '../../core/session.php';
require '../../config/keys.php';
require '../../core/db_connect.php';

$meta=[];
$meta['title']="Users";

$content="<h1>Users</h1>";
$stmt = $pdo->query('SELECT * FROM users');

while($row = $stmt->fetch()){
  $content .= "<div><a href=\"users/view.php?id={$row['id']}\">" .
    "{$row['first_name']} {$row['last_name']}</a></div>";
}

$content .= "<br><br><hr><div><a href=\"users/add.php\">New User</a></div>";

require '../../core/layout.php';
