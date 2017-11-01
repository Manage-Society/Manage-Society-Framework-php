<?php
namespace ms\controller;

/**
 * Gere l'application
 */
class appcontroller{

  /**
   * @var string $title [Nom du projet]
   */
  public $nom;



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
     * @var [class] $route [Gere les routes]
     */
      public $route;

        public $session;

        public $migration;

        public $api_ms;

 /**
  * Le constructeur
  * @param string $root     [le dossier dans app de travail]
  * @param string $chemin [lien vers le fichier de configuration]
  */
  public function __construct($root=null,$chemin=null){
    if($root=="") $root="home";
    if($root!="") $this->root=$root;
    // Recupere les valeur dans le fichier config.php pour l'utiliser dans le projet
    if($chemin=="") $chemin="app/".$this->root."/asset/config.php";
//-->

$this->html=new \ms\view\html();
$this->recup=new \ms\view\recupval();
$this->tel= new \ms\controller\tel();
$this->migration= new \ms\model\migration();
$var=$this->config= new \ms\controller\config($chemin);

$this->api_ms= new \ms\controller\apictr($var->get("api_ms"),$var->get("serveur_ms"));

$this->route=new \ms\view\route($var);
  $session=$this->session= new \ms\controller\session();

// Recupere le dernier lien chez l'utilisateur
    $lastlink="https://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
    if(($_SERVER["REQUEST_URI"]!="") && ($_SERVER["REQUEST_URI"]!="/index.php"))   $session->session("lastlink","Huxi",$lastlink);
    //--->

  }

/**
 * Creer architecture du framework
 * @return [type] [description]
 */
  public function init(){

    //On creer les dossier
       mkdir("app", 0777);
       mkdir("app/home", 0777);
       mkdir("app/home/controller", 0777);
       mkdir("app/home/model", 0777);
       mkdir("app/home/view", 0777);
       mkdir("app/home/asset", 0777);
//--->

      // On creer le dossier de config
      $confdoc = fopen('app/home/asset/config.php', 'a');
      $config_doc=file_get_contents("vendor/managesociety/framework/asset/config.php");
      fputs($confdoc, $config_doc);
      fclose($confdoc);
      //--->

      //--->  // On creer le premier controler
        $confdoc = fopen('app/home/controller/homectr.php', 'a');
        $config_doc=file_get_contents("vendor/managesociety/framework/asset/examplectr.php");
        fputs($confdoc, $config_doc);
        fclose($confdoc);
        //--->

        //--->  // On creer le premier controler
          $confdoc = fopen('app/home/view/index.php', 'a');
          $config_doc=file_get_contents("vendor/managesociety/framework/asset/exampleview.php");
          fputs($confdoc, $config_doc);
          fclose($confdoc);
          //--->


      var_dump("Architecture do");
      return true;
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
