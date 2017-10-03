<?php
namespace app\datauser\model;

class session_user extends \app\core\model\mysql{

 public function __construct(){
   $this->table='session_user';
   parent::__construct("datauser");
 }

 public function la_bd(){
   $migration = new \app\core\model\migration(new session_user());
   $migration->champ("id_user","text"); //Nom de l'utilisateur
   $migration->champ("url","text"); //le lien ou il se trouve
   $migration->champ("http_referer","text"); //Lien d'ou il vient
   $migration->champ("datos","VARCHAR(10) NULL"); //Date
   $migration->champ("heuros","VARCHAR(10) NULL"); //heure
   $migration->execute(); //Il cree la table test avec les champs bonjour,  nbr_paint
 }

}

 ?>
