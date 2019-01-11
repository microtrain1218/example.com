<?php
require '../core/functions.php';
require '../core/session.php';
session_destroy();
header('LOCATION: /');
