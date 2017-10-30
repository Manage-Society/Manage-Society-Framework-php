<?php
namespace ms\controller;

/**
 * Charge une classe
 */
class autoloader{

    /**
     * Enregistre notre autoloader
     */
    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Inclue le fichier correspondant à notre classe
     * @param string $class Le nom de la classe à charger
     */
    static function autoload($class){

$class = ''.str_replace('\\', '/', $class);


if(is_file('' . $class . '.php')){

   require '' . $class . '.php';

}else {

  if(is_file('../' . $class . '.php')){
    require '../' . $class . '.php';
  } else{
    $class=str_replace("ms","",$class);
    $class="vendor/managesociety/framework".$class;
  if(is_file('' . $class . '.php'))  require '' . $class . '.php';
  }

}


    }

} ?>
