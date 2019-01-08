<?php
require '../core/processContactForm.php';

$meta=[];
$meta['title']='Contact Bob Smith';

$content = <<<EOT
{$message}
<form action="contact.php" method="POST" novalidate>
  <h1>Contact Form</h1>

  <div class="form-group">
    <label for="name">Name</label>
    <input class="form-control" id="name" type="text" name="name" value="{$valid->userInput('name')}">
    <div class="text-danger">{$valid->error('name')}</div>
  </div>

  <div class="form-group">
    <label for="email">Email</label>
    <input class="form-control" id="email" type="email" name="email" value="{$valid->userInput('email')}">
    <div class="text-danger">{$valid->error('email')}</div>
  </div>

  <div class="form-group">
    <label for="message">Message</label>
    <textarea class="form-control" id="message" name="message">{$valid->userInput('message')}</textarea>
    <div class="text-danger">{$valid->error('message')}</div>
  </div>

  <div>
    <input type="hidden" name="subject" value="New submission!">
  </div>

  <div>
    <input type="submit" value="Send" class="btn btn-primary">
  </div>

</form>
EOT;

require '../core/layout.php';
