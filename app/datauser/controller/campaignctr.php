<?php

namespace app\datauser\controller;

class campaignctr extends \app\datauser\model\campaign{



  public function __construct(){
    parent::__construct();
  }

  public function execute_condition($id_module,$transaction){
    $mod_cond= new \app\datauser\model\modulecondition();
      $cond=$mod_cond->info($id_module,"id");
      if(isset($cond["id"])){

        if($transaction["entree"]==""){

          $requete_sql="";
            if($cond["condition_req"]=="like"){
              $requete_sql=" ".$cond["req_sql"]." LIKE '%".$data["rep_req"]."%'";
            }else{
              $requete_sql=" ".$cond["req_sql"]."".$cond["condition_req"]."'".$cond["rep_req"]."'";
            }
var_dump($cond);
if($cond["la_table"]=="user"){
    $exo= new \app\datauser\model\user();
}

          $rep_exo=$exo->rech(array(
          "condition"=>" $requete_sql ",));
          if(!empty($rep_exo)) foreach($rep_exo as $valdeps){
            if(!in_array($valdeps["id"],explode(",",$transaction["reussi"]))){

                $transaction["reussi"] .=','.$valdeps["id"];

            }
          }

        }else{

        }
      }



$done=$transaction["reussi"];
$transac= new \app\datauser\model\transaction();
      $transac->miseajour(array(
      "valeur"=>" reussi='$done' ",
      "cas"=>" id='".$transaction["id"]."'",
      ));


  }

  public function execute($data){
    $transac= new \app\datauser\model\transaction();
    $req=$transac->rech(array(
    "condition"=>" 	id_campaign='1' ORDER by stape DESC ",));
    if(!empty($req)) foreach($req as $valdep){
      if($valdep["type_module"]=="1") $this->execute_condition($valdep["id_module"],$valdep);
    }
  }

  public function condition_stape($data){
    $id_camp=$data["id_campaign"];
    $class_user= new \app\datauser\model\user();
   $liste_user=$class_user->list_champ_table();
   $class_session_user= new \app\datauser\model\session_user();
  $liste_session_user=$class_session_user->list_champ_table();
  $la_table='';
  if(in_array($data["le_champ"],explode(",",$liste_user))) $la_table='user';
  if(in_array($data["le_champ"],explode(",",$liste_session_user))) $la_table='session_user';
$requete_sql="";
  if($data["la_condition"]=="like"){
    $requete_sql=" ".$data["le_champ"]." LIKE '%".$data["reponse_req"]."%'";
  }else if($data["la_condition"]=="="){
    $requete_sql=" ".$data["le_champ"]."".$data["la_condition"]."'".$data["reponse_req"]."'";
  }
$mod_cond= new \app\datauser\model\modulecondition();
$transac= new \app\datauser\model\transaction();

  $id_module=$mod_cond->ajout(array(
  "cas"=>" req_sql,la_table,condition_req,rep_req ",
  "valeur"=>" '".$data["le_champ"]."','$la_table','".$data["la_condition"]."','".$data["reponse_req"]."' ",
  ));

  $id_transaction=$transac->ajout(array(
  "cas"=>" id_campaign,id_module,type_module ",
  "valeur"=>" '$id_camp','$id_module','1' ",
  ));

  $this->miseajour(array(
  "valeur"=>" id_last_stape='$id_transaction' ",
  "cas"=>" id='$id_camp'",
  ));



echo $requete_sql.'<br>'.$la_table;
    var_dump($data);
  }

}

 ?>
