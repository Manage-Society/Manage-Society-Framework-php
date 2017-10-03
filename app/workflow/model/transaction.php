<?php
namespace app\workflow\model;

class transaction extends \app\core\model\mysql{

 public function __construct(){
   $this->table='transaction';
   parent::__construct("workflow");
 }

/**
 * Generateur de la base de donnee
 */
 public function la_bd(){
   $migration = new \app\core\model\migration(new transaction());
   $migration->champ("nom","text"); // champ:nom et type:text
   $migration->champ("typos","text"); // champ:nom et type:text
   $migration->champ("id_dossier","text"); // champ:nom et type:text
   $migration->execute();
 }

}
 ?>
