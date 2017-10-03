<?php

namespace app\ecom\model;

class produit extends \app\core\model\mysql{

 public function __construct(){
   $this->table='produit';
   parent::__construct("ecom");
 }

/**
 * Affiche un produit
 * @param  [type] $data [description]
 * @return [type]       [description]
 */
 public function affiche($data){

    return "<h3><a href='produit/".$data["id"]."'>".$data["nom"]."</a> (".$data["prix"].")</h3><p>
    ".$data["description"]."</p><hr>";

 }

/**
 * Generateur de la base de donnee
 */
 public function la_bd(){
   $migration = new \app\core\model\migration(new produit());
   $migration->champ("nom","text"); // champ:nom et type:text
   $migration->champ("id_categorie","INT");
   $migration->champ("description","text");
   $migration->champ("image","text");
   $migration->champ("prix","text");
   $migration->execute();
 }

}

 ?>
