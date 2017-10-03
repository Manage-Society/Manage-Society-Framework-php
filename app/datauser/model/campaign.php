<?php
namespace app\datauser\model;

class campaign extends \app\core\model\mysql{

 public function __construct(){
   $this->table='campaign';
   parent::__construct("datauser");
 }

 public function la_bd(){
   $migration = new \app\core\model\migration(new campaign());
   $migration->champ("nom","text"); //Nom de la campagne
   $migration->champ("description","text"); //Description de la campagne
   $migration->champ("id_last_stape","text"); //ID de la derniere etape
   $migration->execute(); //
 }

}

 ?>
