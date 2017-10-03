<?php
namespace app\workflow\controller;

/**
 *
 */
class dossierctr extends \app\core\controller\controller
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
  public function add_dossier($data){
    $this->app->recup->add_sql("dossier");
    header("location: index.php ");
  }

/**
 * Voir un dossier
 * @param  [type] $data [description]
 * @return [type]       [description]
 */
  public function voirdossier($data){
    $info_dossier=$this->app->getmodel("dossier")->info($data["id_dossier"],"id");
    $data["info_dossier"]=$info_dossier;
    $info_transac=$this->app->getmodel("transaction")->rech(array(
    "condition"=>" id_dossier='".$info_dossier["id"]."' ",));
    $data["info_transac"]=$info_transac;
    $data["nbr_transac"]=count($info_transac);
    $this->app->view->render("app/workflow/view/dossier.php",$data);
  }

  public function data_dossier($data){
    $info_dossier=$this->app->getmodel("dossier")->info($data["id_dossier"],"id");
    $data["info_dossier"]=$info_dossier;
    $info_transac=$this->app->getmodel("transaction")->rech(array(
    "condition"=>" id_dossier='".$info_dossier["id"]."' ",));
    $data["info_transac"]=$info_transac;
    $data["nbr_transac"]=count($info_transac);
    $this->app->view->render("app/workflow/view/data_dossier.php",$data);
  }

  /**
   * Creer sous dossier
   * @param  [type] $data [description]
   * @return [type]       [description]
   */
    public function create_dossier($data){
      $this->app->recup->update_sql("dossier"," id='".$data["id_dossier"]."' ","moddossier_");
      $i=1;
      while($i<30){
        $casos="addtransac_".$i.'_';
        if(isset($data["$casos"."nom"])) if($data["$casos"."nom"]!=""){
          $this->app->recup->add_sql("transaction",$casos,"id_dossier"," '".$data["id_dossier"]."' ");
        }
        $i++;
      }

      $i=1;
      while($i<$data["nbr_transac"]+1){
        $casos="modtransac_".$i.'_';
        if(isset($data["$casos"."nom"])) if($data["$casos"."nom"]!=""){
          $this->app->recup->update_sql("transaction"," id='".$data["idtransac_".$i.""]."' ",$casos);
        }
        $i++;
      }

    header("location: index.php");
    }

}

 ?>
