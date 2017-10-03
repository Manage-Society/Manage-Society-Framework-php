<?php
namespace app\datauser\model;

class transaction extends \app\core\model\mysql{

 public function __construct(){
   $this->table='transaction';
   parent::__construct("datauser");
 }

 public function la_bd(){
   $migration = new \app\core\model\migration(new transaction());
   $migration->champ("id_campaign","INT"); //ID de la campagne
   $migration->champ("type_module","INT"); //Le type de module
   $migration->champ("entree","text"); //Les ID de début de la transaction
   $migration->champ("echec","text"); //Les ID en echec
   $migration->champ("reussi","text"); //Les ID qui ont reussi l'etape
   $migration->champ("next_stape","text"); //Prochaine etape
   $migration->execute(); //
 }

}

 ?>
