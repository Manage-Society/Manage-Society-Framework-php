<?php
namespace app\datauser\model;

class user extends \app\core\model\mysql{

 public function __construct(){
   $this->table='user';
   parent::__construct("datauser");
 }

 public function la_bd(){
   $migration = new \app\core\model\migration(new user());
   $migration->champ("name","text"); //Nom de l'utilisateur
   $migration->champ("id_user_client","text"); //Nom de l'utilisateur
   $migration->champ("email","text"); //email du l'utilisateur
   $migration->champ("phone","text"); //email du l'utilisateur
   $migration->champ("country","text"); //email du l'utilisateur
   $migration->champ("addres","text"); //email du l'utilisateur
   $migration->champ("company_name","text"); //email du l'utilisateur
   $migration->champ("datos","VARCHAR(10) NULL"); //Date
   $migration->champ("heuros","VARCHAR(10) NULL"); //heure
   $migration->execute(); //Il cree la table test avec les champs bonjour,  nbr_paint
 }

}

 ?>
