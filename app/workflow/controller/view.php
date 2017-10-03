<?php
namespace app\workflow\controller;

/**
 *
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
  * Une requete venant de la vue
  */
  public function index($data){
    $data["liste_dossier"]=$this->app->getmodel("dossier")->rech(array(
    "condition"=>" 1=1 ",));
    $this->app->view->render("app/workflow/view/index.php",$data);
  }

  

}

 ?>
