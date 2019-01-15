<?php
require '../../core/functions.php';
require '../../config/keys.php';
require '../../core/db_connect.php';

$input = filter_input_array(INPUT_GET);

$slug = preg_replace("/[^a-z0-9-]+/","",$input['slug']);

$stmt = $pdo->prepare("SELECT * FROM posts WHERE slug=:slug");
$stmt->execute(['slug'=>$slug]);
$row = $stmt->fetch();

$meta=[];
$meta['title']=$row['title'];
$meta['description']=$row['meta_description'];
$meta['keywords']=$row['meta_keywords'];

$body = nl2br($row['body']);

$content=<<<EOT
<h1>{$row['title']}</h1>
{$body}

<hr>
<div>
  <a class="btn btn-link" href="posts/edit.php?id={$row['id']}">Edit</a>
  <a class="btn btn-link text-danger" href="posts/delete.php?id={$row['id']}">Delete</a>
</div>
EOT;

require '../../core/layout.php';
