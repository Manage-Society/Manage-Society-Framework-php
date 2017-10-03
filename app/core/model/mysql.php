<?php
namespace app\core\model;

/**
 * Connexion MySQL
 */
class mysql extends \app\core\model\sql{


  public function __construct($datable){
    $this->conect($datable);
  }

/**
 * Connecteur
 * @param  string $datable [base de donnee]
 * @return [connecteur]          [retourn un conecteur]
 */
  public function conect($datable){
    $var= new \app\core\config("/datauser/vendor/config.php");
 $this->hostname=$_SESSION["ip_bd"]=$var->get("db_hostname");
     $this->username=$_SESSION["bd_username"]=$var->get("db_username");
    $this->password=$_SESSION["bd_psswd"]=$var->get("db_mdp");
    $this->datatable=$_SESSION["datatable"]=$datable;

    parent::con();

  }

/**
 * Faire un rech dans une table
 * @param  string $req [la requete]
 * @return [array]      []
 */
  public function voir($req=null){
    if($req=="") $req=" 1=1 ";
    return $this->rech(array(
    "condition"=>" $req ",));
  }
}
 ?>
