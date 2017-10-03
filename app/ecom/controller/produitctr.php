<?php

namespace app\ecom\controller;

/**
 *
 */
class produitctr extends \app\core\controller\controller
{

  function __construct()
  {
    // Il appel un model de notre framework
    parent::__construct("");
    # code...
  }

  /**
  * Une requete venant de la vue
  */
  public function voirprod($data){
    $this->app->view->render("app/ecom/view/index.php",$data);
  }

}


 ?>
