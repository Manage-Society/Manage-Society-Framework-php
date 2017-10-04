<?php
namespace core\model;

/**
 * S'occupe des routes

 */
class route{

/**
 * Charge le https
 * @param  [type] $SERVER [la variable $SERVER du navigateur]
 * @return [string]         [le lien]
 */
  public static function https($SERVER){
    $url  = @( $SERVER["HTTPS"] != 'on' ) ? 'http://'.$SERVER["SERVER_NAME"] :  'https://'.$SERVER["SERVER_NAME"];

  if(substr($url,"0","11") !="https://www"){
  // echo substr($url,"12");

  $xxoporrer="https://www.".$SERVER["SERVER_NAME"].''.$SERVER['REQUEST_URI'];
  $xxoporrer=str_replace("www.www", "www",$xxoporrer);

   self::header($xxoporrer);
   }

  }

/**
 * Change de page
 * @param  string $lien [le lien]
 * @return [type]       [description]
 */
  public static function header($lien){
    header("Location: $lien");
  }

}


 ?>
