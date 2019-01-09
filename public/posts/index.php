<?php

require '../../core/db_connect.php';
$meta=[];
$meta['title']="Bob's Blog";

$content="<h1>Blogs Posts</h1>";
$stmt = $pdo->query('SELECT * FROM posts');

while($row = $stmt->fetch()){
  $content .= "<a href=\"posts/view.php?slug={$row['slug']}\">{$row['title']}</a>";
}

require '../../core/layout.php';
