<?php
namespace app\ecom\controller;

/**
 *
 */
class commandectr extends \app\core\controller\controller
{

  function __construct()
  {
    // Il appel un model de notre framework
    parent::__construct("\app\\ecom\model\commande");
  }

  /**
  * Une requete venant de la vue
  */
  public function commande($data){
    $reponse= $this->app->recup->add($_POST,"add_");
    $lavalfinal=explode("!!!!!!",$reponse);
    $leschamps=$lavalfinal[0];
    $lesvariables=$lavalfinal[1];
    $lastid= $this->l_model->ajout(array(
    "cas"=>" $leschamps ",
    "valeur"=>" $lesvariables ",
    ));
    echo '<a href="index.php">Commande effectue</a>';
  }

  public function accueil(){

    $data["layout"]="bonjour comment vas tu?";
    $this->app->view->render("app/ecom/view/index.php",$data);

  }

}


 ?>
