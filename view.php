<?php
namespace core;

/**
 * Gere les vues
 */
class view
{

  public $body;
  public $layout;

  function __construct()
  {
    # code...
  }

  /**
   * Renvoie une vue
   * @param  [sting] $doc  [lien vers le document]
   * @param  [array] $data [donnee de la vue]
   * @return [type]       [description]
   */
  public function render($doc,$data){
    $app=$GLOBALS["app"];
    require($doc);
  }

  /**
   * Gere les routes avec le refactorie
   * @return [type] [description]
   */
  public function route(){
    $app=$GLOBALS["app"];
    $var= new \app\core\config("/".$app->root."/vendor/config.php");
    $rules=$var->get("route");
    $uri = rtrim( dirname($_SERVER["SCRIPT_NAME"]), '/' );
    $uri = '/' . trim( str_replace( $uri, '', $_SERVER['REQUEST_URI'] ), '/' );
    $uri = urldecode( $uri );
  //  var_dump($var);
    foreach ( $rules as $action => $rule ) {
        if ( preg_match( '~^'.$rule.'$~i', $uri, $params ) ) {
          $tab=explode(";",$action);
          $class= new $tab[0]();
          $class->$tab[1]($params);
        }
    }

  }



}



 ?>
