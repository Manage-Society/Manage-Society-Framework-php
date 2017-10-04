<?php
namespace ms\model;

/**
 * [Il s'occupe des migration de base de donne]
 */
class migration{

/**
 * @var string $requete [Reqeute SQL]
 */
  public $requete='';

  /**
   * @var string $table [Table SQL]
   */
  public $table='';

  /**
   * @var string $datatable [DataBase SQL]
   */
  public $datatable="";

  /**
   * @var  $sql [Class qui gere le model]
   */
  public $sql;

  /**
   * [On appel le model pour avoir la table et base de donnee]
   * @param [class] $sql [La classe qui recoit de mysql par exemple]
   */
  public function __construct($sql){
    $class_sql=$sql;
    $this->sql=$class_sql;
    $this->datatable=$class_sql->datatable;
    $this->table=$class_sql->table;



  }

/**
 * [Execute la commande, sachant il a deja le champ id on auto-incrementation]
 * @return [string] [la requete]
 */
  public function execute(){

$ma_req=" CREATE TABLE IF NOT EXISTS `".$this->table."` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      PRIMARY KEY (`id`),";
    $ma_req .=$this->requete;
    $ma_req .='
    `created_at` date NULL,
    `update_at` date NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
    $this->sql->requete($ma_req,$this->datatable);
    return $ma_req;

  }

/**
 * [Cree un champ]
 * @param  [string] $champ [Le nom du champ]
 * @param  [string] $type  [int,text]
 * @param  [string] $plus  [Mettre plus d'attribut]
 * @return [string]        [la requete]
 */
  public function champ($champ=null,$type,$plus=null){
$rep_champ="";
  $requete= $this->requete;
if($champ!="") $rep_champ=" `".$champ."` ";
  $requete .=" $rep_champ $type ".$plus." ,";
  $this->requete=$requete;
  return $requete;
  }

  /**
   * affiche les requetes
   * @return [string] [requete]
   */
  public function affiche_requete(){
    return $this->requete;
  }

  /**
   * detruit les requetes
   * @return [string] [remet 0]
   */
  public function destroy_requete(){
    $this->requete="";
  }

  /**
   * [Met à jour les champs]
   * @param  [string] $tab_avant [nom de la table avant]
   * @param  [string] $tab_apres [nom de la table apres]
   * @param  [string] $cas       [les attributs]
   * @return [string]            [ma requete]
   */
  public function update($tab_avant,$tab_apres,$cas){
    $ma_req=" ALTER TABLE `".$this->table."` CHANGE `".$tab_avant."` `".$tab_apres."` ".$cas." ";
      $this->sql->requete($ma_req,$this->datatable);
      return $ma_req;
  }

  /**
   * [Creation d'une base de donnée]
   * @param  string $datatable [nom de la base de donne]

   * @return [string]            [ma requete]
   */
  public function create_database($datatable=null){
    if($datatable=="") $datatable=$this->datatable;
    $ma_req=" CREATE DATABASE IF NOT EXISTS `$datatable` ";
      $this->sql->requete($ma_req,$this->datatable);
      return $ma_req;
  }

  /**
   * [ajout un champ]
   * @param [string] $table [nom de la table]
   * @param [string] $cas   [attribut]
   */
  public function add($table,$cas){
    $ma_req=" ALTER TABLE `".$this->table."` ADD `".$table."` ".$cas." ";
      $this->sql->requete($ma_req,$this->datatable);
      return $ma_req;
  }

  /**
   * [supprimer un champ de la table]
   * @param  [string] $champ [nom du champ]
   * @return [string]        [requete]
   */
  public function sup($champ){
    $ma_req=" ALTER TABLE `".$this->table."` DROP `".$champ."` ";
      $this->sql->requete($ma_req,$this->datatable);
      return $ma_req;
  }

}

// Exemple d'exécution:
// $migration = new migration('\app\default\model\test.php');
// $migration->champ("bonjour","text"); //Champ bonjour de type text
// $migration->champ("nbr_paint","int"); //champ nbr_paint de type int
// $migration->execute(); Il cree la table test avec les champs bonjour,  nbr_paint
// $migration->update("allo","allos","INT(19) NULL DEFAULT NULL");
// $migration->add("tiesto","INT(10) NULL ");



 ?>
