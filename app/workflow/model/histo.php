<?php
namespace app\workflow\model;

class histo extends \app\core\model\mysql{

 public function __construct(){
   $this->table='histo';
   parent::__construct("workflow");
 }

/**
 * Generateur de la base de donnee
 */
 public function la_bd(){
   $migration = new \app\core\model\migration(new histo());
   $migration->champ("id_transac","text"); // champ:nom et type:text
   $migration->champ("val","text"); // champ:nom et type:text
   $migration->champ("id_dossier","text"); // champ:nom et type:text
   $migration->execute();
 }

}
 ?>
