<?php
namespace core\model;

/**
 * Charge les validators
 */
trait validator
{

  /**
   * Charge des validators, our voir les erreurs
   * @param  string $valide [liste des function validator]
   * @param array $data [donne de la vue]
   * @return string         [Retourn les erreurs]
   */
  public function validate($valide,$data)
  {
    $error="";
    if($valide!="") foreach (explode(",",$valide) as $valdep) {
      $error .=$this->$valdep($data);
      # code...
    }
    return $error;
    # code...
  }
}



 ?>
