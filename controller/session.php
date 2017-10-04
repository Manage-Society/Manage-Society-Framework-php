<?php
namespace ms\controller;

/**
 * Gere les sessions
 */
class session extends \ms\model\crypte {


/**
 * Ajoute ou modifie une session
 * @param  string $nom         [nom de la session]
 * @param  string $cle         [cle de cryptage]
 * @param  string $description [la valeur a mettre dans la session]
 * @return string              [la valeur crypte]
 */
  public function session($nom,$cle=null,$description=null){
if($cle=="") $cle="Huxi";
  $valeur=parent::cryptevariable($cle,$nom);
  $_SESSION[''.$valeur.'']=$description;
  return $description;
}

/**
 * Affiche une session
 * @param  string $nom [nom de la session]
 * @param  string $cle [cle de cryptage]
 * @return string      [la reponse de la commande]
 */
 public function show_session($nom,$cle=null){
  if(is_null($cle)) $cle="Huxi";

  $valeur=parent::cryptevariable($cle,$nom);
  $val="";
  if(isset($_SESSION[''.$valeur.''])){
  $val=$_SESSION[''.$valeur.''];
  }
  return $val;
 }

/**
 * Retour le dernier lien
 * @param  string $lien [lien de redirectionnement]
 * @return []       []
 */
public function goback($lien=null){
  if($lien==""){
    $lastlink= $this->show_session("lastlink","Huxi");
  }else{
    $lastlink=$lien;
  }

  \ms\model\route::header($lastlink);
}


}

 ?>
