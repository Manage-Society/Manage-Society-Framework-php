<?php
// Gere la page d accueil
namespace app\home\controller;

/**
 * Les vues par défauts
 */
class homectr extends \ms\controller\controller
{

  function __construct()
  {
    // Il appel un model de notre framework
    parent::__construct("");
    # code...
  }

  public function view_controller_action($data){
    var_dump($data);
  }

  /**
  * La vue par defaut
  */
  public function index($data){
    $this->app->route->render("app/home/view/index.php",$data);
  }

}


 ?>
