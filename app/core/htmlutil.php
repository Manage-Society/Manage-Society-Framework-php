<?php
namespace app\core;

/**
 * Utilitaire html, chercher plusieurs utilitaire
 */
trait htmlutil{

  /**
   * @var [class] $html [la classe html]
   */
  public $html;

  /**
   * @var [class] $session [la classe session]
   */
  public $session;

  /**
   * @var [class] $recupval [la classe recupval]
   */
  public $recupval;

  /**
   * @var string $lang [la langue de l'utilisateur]
   */
  public $lang;

/**
 * Constructeur
 */
  public function construct_htmlutil(){
    $this->html= new \app\core\model\html();
    $this->session= new \app\core\model\session();
    $this->recupval= new \app\core\recupval();
  
  }

  /**
   * Translate
   * @param  string $lang    [la langue]
   * @param  string $text_fr [le texte en francais]
   * @param  string $text_en [le texte en anglais]
   * @param string $sortie [type de sortie]
   * @return string          []
   */
    public function translate($lang,$text_fr,$text_en,$sortie=null){

      $reponse="";
      if($lang=="fr"){ $reponse=$text_fr;
      }else{
        $reponse=$text_en;
     }

      if($sortie==""){
       return utf8_decode($reponse);
      }else if($sortie=="1"){
        return utf8_encode($reponse);
      }else{
         return $reponse;
      }

    }



}

 ?>
