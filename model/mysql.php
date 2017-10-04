<?php
namespace ms\model;

/**
 * Connexion MySQL
 */
class mysql extends \ms\model\sql{

public $app;

  public function __construct($datable=null){
    $this->app=$GLOBALS["app"];
    if($datable=="") $datable=$this->app->config->get("db_datatable");
    $this->conect($datable);
  }

/**
 * Connecteur
 * @param  string $datable [base de donnee]
 * @return [connecteur]          [retourn un conecteur]
 */
  public function conect($datable){
 $this->hostname=$_SESSION["ip_bd"]=$this->app->config->get("db_hostname");
     $this->username=$_SESSION["bd_username"]=$this->app->config->get("db_username");
    $this->password=$_SESSION["bd_psswd"]=$this->app->config->get("db_mdp");
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
