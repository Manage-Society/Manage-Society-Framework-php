<?php
namespace core\controller;

/**
 * Gere l'application
 */
class appcontroller{
  /**
   * @var string $id [le ID du user]
   */
  public $id='';

  /**
   * @var string $title [le titre de la page]
   */
  public $title;

  /**
   * @var string $app []
   */
  public $app;

/**
 * la classe HTMl
 * @var [class] $html
 */
  public $html;

  /**
   * @var string $root [le dossier dans app de travail]
   */
  public $root;

  /**
   * @var string $notfound [La page non trouve]
   */
  public $notfound;

  /**
   * @var string $user [La classe qui gere l'utilisateur]
   */
  public $user;

  /**
   * @var string $config [La class de configuration]
   */
  public $config;

/**
 * @var [class] $recup [la class de recuperation]
 */
  public $recup;

  /**
   * @var [class] $tel [Class telecharge]
   */
    public $tel;

    /**
     * @var [class] $view [Class la vue]
     */
      public $view;


 /**
  * Le constructeur
  * @param string $id     [id de l'utilisateur]
  * @param string $user   [l chemin de la class qui gere utilisateur]
  * @param string $chemin [le chemin vers le fichier de configuration]
  * @param string $root [le dossier qui gere le projet]
  */
  public function __construct($id=null,$user=null,$chemin=null,$root=null){
if($root!="") $this->root=$root;
$this->html=new \app\core\model\html();
$this->recup=new \app\core\recupval();
$this->tel= new \app\core\tel();
$this->view=new \app\core\view();
    // Recupere les valeur dans le fichier config.php pour l'utiliser dans le projet
    if($chemin=="") $chemin="/".$this->root."/vendor/config.php";
  $this->config($chemin);
//-->

    $session= new \app\core\model\session;

// Recupere le dernier lien chez l'utilisateur
    $lastlink="https://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
    if(($_SERVER["REQUEST_URI"]!="") && ($_SERVER["REQUEST_URI"]!="/index.php"))   $session->session("lastlink","Huxi",$lastlink);
    //--->


    if($id==""){
      $this->id=$session->show_session("id");
      $id=$this->id;
    }else{
      $this->id=$id;
      $session->session("id","",$id);
    }

      // Appele la fonction qui gere les utilisateurs
    if($user!=""){
      $this->user=new $user($id);
    }
    //--->


  }

  /**
   * Gere le fichier de configuration
   * @param  string $chemin [le chemin vers le fichier de configuration]
   * @param  string $sauv   [Verfie si on doit l'intsancier dans $this->config]
   * @return [class]         [Retourne la classe]
   */
  public function config($chemin=null,$sauv=null){
  $var= new \app\core\config($chemin);
  if($sauv=="") $this->config=$var;
  return $var;
  }

/**
 * Recupere un model
 * @param  string $model    [le nom du model]
 * @param  string $root     [le dossier dans APP qui gere]
 * @param  array $variable [les variables]
 * @return [class]           [Retourne la classe]
 */
  public function getmodel($model,$root=null,$variable=null){
    if($root=="") $root=$this->root;
    $chemin ="\app\\".$root."\model\\".$model;
    return $rep= new $chemin($variable);
  }

/**
 * Charge un controller
 * @param  string $class    [Nom de la classe]
 * @param  string $root     [Le dossier qui gere le projet]
 * @param  array $variable [variable utilise par la classe]
 * @return [class]           []
 */
  public function getcontroller($class,$root=null,$variable=null){
    if($root=="") $root=$this->root;
    $chemin ="\app\\".$root."\controller\\".$class;
    return $rep= new $chemin($variable);
  }





}

 ?>
