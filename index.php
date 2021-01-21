<?php

const EMAIL_PARAM_NAME = 'email';
const SPAM_DOMAINS = ['spamming.com', 'mailinator.com', 'oneminutemail.com'];

/**
 * Undocumented function
 *
 * @param string $name
 * @return bool|string
 */
function getRequestParam(string $name) {
  if (empty($_GET) || empty($_GET[$name])) {
    return false;
  }
  
  return $_GET[$name];
}

/**
 * Undocumented function
 *
 * @param string $email
 * @return boolean
 */
function isEmailValid(string $email): bool {
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return false
  }
  return true;
}

/**
 * Undocumented function
 *
 * @param string $email
 * @return bool|string
 */
function extractDomainFromEmail(string $email) {
  $emailParts = explode('@', $email);
  if ($emailParts === false || count($emailParts) !== 2) {
    return false;
  }
  return $emailParts[1];
}

/**
 * Undocumented function
 *
 * @param string $domain
 * @param array $spamDomain
 * @return boolean
 */
function isSpam(string $domain, array $spamDomain): bool {
  if (in_array($domain, SPAM_DOMAINS)) {
    return true;
  }
  return false;
}


function validateEmail() {
  $errorsMessages = [
    "SPAM_ERROR" => "Email is spam",
    "INVALID_EMAIL" => "Invalid email address",
    "EXTRACT_DOMAIN_ERROR" => "Unable to extract domain from email address",
    "REQUEST_PARAM_ERROR" => "Please provide a valid request params"
  ];
  
  $email = getRequestParam(EMAIL_PARAM_NAME);
  $error = null;
  if ($email) {
    if (isEmailValid($email)) {
      $domain = extractDomainFromEmail($email);
      if ($domain) {
        if (!isSpam($domain, SPAM_DOMAINS)) {
          echo "Email is valid";
        } else {
          $error = $errorsMessages['SPAM_ERROR'];
        }
      } else {
        $error = $errorsMessages['EXTRACT_DOMAIN_ERROR'];
      }
    } else {
      $error = $errorsMessages['INVALID_EMAIL'];
    }
  } else {
    $error = $errorsMessages['REQUEST_PARAM_ERROR'];
  }
  echo $error;
}

validateEmail();  
