<?php

namespace app\ecom\controller;

/**
 * Les vues par défauts
 */
class view extends \app\core\controller\controller
{

  function __construct()
  {
    // Il appel un model de notre framework
    parent::__construct("");
    # code...
  }

  /**
  * La vue par defaut 
  */
  public function index($data){
    $this->app->view->render("app/ecom/view/index.php",$data);
  }

}


 ?>
