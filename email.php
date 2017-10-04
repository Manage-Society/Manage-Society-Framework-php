<?php
namespace core;

/**
 * Gere les emails
 */
class email extends \app\core\phpmailer\gmail
{

  function __construct($email=null,$mdp=null,$username=null)
  {
    parent::__construct($email,$mdp,$username);
    # code...
  }
}



 ?>
