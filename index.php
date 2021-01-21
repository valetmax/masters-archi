<?php

const EMAIL_PARAM_NAME = 'email';
const SPAM_DOMAINS = ['spamming.com', 'mailinator.com', 'oneminutemail.com'];

if (empty($_GET) || empty($_GET[EMAIL_PARAM_NAME])) {
  echo "Please provide a valid email address";
  exit;
}

$email = $_GET['email'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo "Invalid email address";
  exit;
}

$emailParts = explode('@', $email);

if ($emailParts === false || count($emailParts) !== 2) {
  echo "Unable to extract domain from email address";
  exit;
}

$domain = $emailParts[1];

if (in_array($domain, SPAM_DOMAINS)) {
  echo "Email is spam";
  exit;
}

echo "Email is valid";
