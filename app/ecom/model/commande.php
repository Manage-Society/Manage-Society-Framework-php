<?php

namespace app\ecom\model;

class commande extends \app\core\model\mysql{

 public function __construct(){
   $this->table='commande';
   parent::__construct("ecom");
 }

/**
 * Generateur de la base de donnee
 */
 public function la_bd(){
   $migration = new \app\core\model\migration(new commande());
   $migration->champ("nom","text");
   $migration->champ("telephone","text");
   $migration->champ("adresse","text");
   $migration->champ("id_produit","text"); 
   $migration->execute();
 }

}

 ?>
