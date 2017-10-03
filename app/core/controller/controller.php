<?php
namespace app\core\controller;

/**
 * Le controller
 */
class controller
{

  /**
   * APP du systeme
   * @var [type]
   */
  public $app;

  /**
   * Le modele
   * @var [type]
   */
  public $l_model;

  function __construct($model=null)
  {
    $this->app=$GLOBALS["app"];
    if($model!=""){
      $this->l_model=new $model();
    }
  }
}

 ?>
