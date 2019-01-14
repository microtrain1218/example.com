<?php
require '../../core/functions.php';
require '../../core/session.php';
require '../../config/keys.php';
require '../../core/db_connect.php';

$meta=[];
$meta['title']="Inqueries";


$stmt = $pdo->query('SELECT * FROM inqueries');
$tr=null;
while($row = $stmt->fetch()){
  $tr .= "<tr>" .
    "<td><a href=\"inqueries/view.php?id={$row['id']}\">{$row['name']}</a></td>" .
    "<td><a href=\"inqueries/view.php?id={$row['id']}\">{$row['email']}</a></td>" .
    "<td><a href=\"inqueries/view.php?id={$row['id']}\">{$row['created']}</a></td>" .
  "</tr>";
}

$content=<<<EOT
<h1>Inqueries</h1>
<table class="table table-striped table-hover table-bordered">
  <thead>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Created</th>
    </tr>
  </thead>
  <tbody>
    {$tr}
  </tbody>
</table>
EOT;

require '../../core/layout.php';
