<?php
require 'Jason/src/Validation/Validate.php';

use Jason\Validation;

$message = null;
$valid = new Jason\Validation\Validate();

$args = [
  'name'=>FILTER_SANITIZE_STRING,
  'subject'=>FILTER_SANITIZE_STRING,
  'message'=>FILTER_SANITIZE_STRING,
  'email'=>FILTER_SANITIZE_EMAIL
];

$input = filter_input_array(INPUT_POST, $args);

if(!empty($input)){
  $valid->validation = [
    'email'=>[[
      'rule'=>'email',
      'message'=>'Please enter a valid email'
    ],[
      'rule'=>'notEmpty',
      'message'=>'Please enter an email'
    ]],
    'name'=>[[
      'rule'=>'notEmpty',
      'message'=>'Please enter a your name'
    ]],
    'message'=>[[
      'rule'=>'notEmpty',
      'message'=>'Please add a message'
    ]]
  ];

  $valid->check($input);

  if(empty($valid->errors)){

    $args = [
      'name'=>FILTER_SANITIZE_STRING,
      'message'=>FILTER_SANITIZE_STRING,
      'email'=>FILTER_SANITIZE_EMAIL
    ];

    $input = filter_input_array(INPUT_POST, $args);

    if(!empty($input)){

      $input = array_map('trim', $input);

      $sql = 'INSERT INTO
          inqueries
        SET
          id=uuid(),
          name=?,
          body=?,
          email=?';

      if($pdo->prepare($sql)->execute([
        $input['name'],
        $input['message'],
        $input['email']
      ])){
        header('LOCATION:/thanks.php');
      }else{
        $message = 'Something bad happened';
      }
    }

  }else{
    $message = "<div class=\"alert alert-danger\">Your form has errors!</div>";
  }
}
