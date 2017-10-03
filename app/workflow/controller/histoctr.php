<?php
namespace app\workflow\controller;

/**
 *
 */
class histoctr extends \app\core\controller\controller
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
  public function add_data($data){
    $i=1;
    while($i<$data["nbr_transac"]+1){
    $casos="addtransac_".$i.'_';
  //  $this->app->getmodel("histo")->la_bd();
    $this->app->recup->add_sql("histo",$casos);
    $i++;
  }
  header("location: index.php ");
    //var_dump($data);
    # code...
  }

}

 ?>
