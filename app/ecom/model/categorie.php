<?php

  namespace app\ecom\model;

  class categorie extends \app\core\model\mysql{

   public function __construct(){
     $this->table='categorie';
     parent::__construct("ecom");
   }

  /**
   * Generateur de la base de donnee
   */
   public function la_bd(){
     $migration = new \app\core\model\migration(new categorie());
     $migration->champ("nom","text"); // champ:nom et type:text
     $migration->execute();
   }

  }

 ?>
