<?php
namespace app\datauser\model;

class modulecondition extends \app\core\model\mysql{

 public function __construct(){
   $this->table='module_condition';
   parent::__construct("datauser");
 }

 public function la_bd(){
   $migration = new \app\core\model\migration(new modulecondition());
   $migration->champ("req_sql","text"); //La requete SQL
   $migration->champ("nbr_req","INT"); //Le nombre de personne qui correspond a la requete
   $migration->champ("id_transaction","text"); //ID de la transaction
   $migration->champ("la_table","text"); //La table
   $migration->execute(); //
 }

}

 ?>
