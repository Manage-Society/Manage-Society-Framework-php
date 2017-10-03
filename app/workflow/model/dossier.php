<?php
namespace app\workflow\model;

class dossier extends \app\core\model\mysql{

 public function __construct(){
   $this->table='dossier';
   parent::__construct("workflow");
 }

 public function view($data){
   return '<li>'.$data["nom"].' <a href="framework/dossier/'.$data["id"].'">Modifier</a> <a href="framework/voirdossier/'.$data["id"].'">Afficher</a></li>';
 }

/**
 * Generateur de la base de donnee
 */
 public function la_bd(){
   $migration = new \app\core\model\migration(new dossier());
   $migration->champ("nom","text"); // champ:nom et type:text
   $migration->champ("description","text");
   $migration->execute();
 }

}
 ?>
