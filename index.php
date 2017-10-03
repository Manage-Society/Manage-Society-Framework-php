<?php
//Fdsfds
// Affiche les erreurs
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);
session_start();

//--->

define('ROOT', dirname( __FILE__ ));

// Permet de faire un chargeur de class qu'il ne trouve pas
include_once("app/core/controller/autoloader.php");
require_once('vendor/autoload.php');
\app\core\controller\autoloader::register();
//-->
if(isset($_GET["app"])){
  $_SESSION["app"]=$_GET["app"];
}else if(!isset($_SESSION["app"])){
  echo 'Le chemin app manque';
die();
}

 $app= new \app\core\controller\appcontroller("","","",$_SESSION["app"]);
//Appel le controller

if(isset($_POST['controller'])){

	$requete=$_POST["controller"];
	 $l_donnee=array();
	 foreach ($_POST as $nomchamp => $valeurchamp){
			 $$nomchamp = $app->html->verif_val($valeurchamp,'text');
       $l_rep=$app->html->verif_val($valeurchamp,'text');
		   $l_donnee=array_merge($l_donnee,array($nomchamp=>$l_rep));
	 }

   if(isset($classaction)){
     $controllerxx = new $_POST["controllerrequest"]();
     $controllerxx->$_POST["controller"]($l_donnee);
   }else{
     include($_POST['controllerrequest']);
   }
//-->

}else{

  $app->view->route();

}

?>
