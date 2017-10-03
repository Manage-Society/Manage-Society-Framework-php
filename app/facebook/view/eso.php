<?php

class utilisateur
{
public $nom;
public $xa;
public $ya;
  function __construct($nom,$xa,$ya)
  {
  $this->nom=$nom;
  $this->xa=$xa;
  $this->ya=$ya;
  }
}
class geometrie
{

  function distance($utilisateur,$info)
  {
    $xa=$utilisateur->xa;
    $ya=$utilisateur->ya;
    $xb=$info->xa;
    $yb=$info->ya;
    $xc=0;
    $yc=0;
    $d=0;
    if ($xa>$xb) {
      $xc=$xa-$xb;
    }else {
      $xc=$xb-$xa;
    }
    if ($ya>$yb) {
      $yc=$ya-$yb;
    }else {
      $yc=$yb-$ya;
    }
    $d=sqrt($xc*$xc+$yc*$yc);
    return $d;
  }
}

class information
{
  public $titre;
  public $xa;
  public $ya;
  public $info;
  public $monperso;

  function __construct($titre,$info,$xa,$ya,$monperso)
  {
  $this->titre=$titre;
  $this->xa=$xa;
  $this->ya=$ya;
  $this->info=$info;
  $this->monperso=$monperso;
  }
function publication(){
  return "<h3>".$this->monperso.":".$this->titre."</h3>
  <h6>".$this->info."</h6><hr>";
}
}
$geometrie= new geometrie();
$utilisateur= new utilisateur("svety",2,3);
$info1= new information ("URGENT","L'armée congolaise a neutralisé 22 ninjas à SOUMOUNA aux alentours
  de 3h, les populations n'ont déploré  aucune victime.",2,1,"songeur242");
  $info2= new information ("SPORT","CONGO-RDC les diables rouges s'incline 3-1
  BIFOUMA buteur et sorti pour blessure ,
coup dur pour SEBASTIEN MIGNE",1,4,"songeur243");


 ?>



<!DOCTYPE html>
<html>
  <head>
<link rel="stylesheet" href="app/core/vendor/bootstrap_v_3_3_7/css/bootstrap.css">
 <link rel="stylesheet" href="app/facebook/vendor/css/svety.css">
    <meta charset="utf-8">
    <title>SONGI-SONGI.COM</title>
  </head>
  <body class="container">
    <div >
    <div class="color">
      <div class="row">
        <div class="col-md-6 rouge">
          <h1>SONGUI-SONGUI.COM</h1>

        </div>
<div class="col-md-6">
  <?php echo $utilisateur->nom; ?>

</div>
      </div>

    </div>
    <br>
<div class="container">
  <?php if($geometrie->distance($utilisateur,$info1)<=10) echo $info1->publication(); ?>
  <?php if($geometrie->distance($utilisateur,$info2)<=10) echo $info2->publication(); ?>
</div>
    </div>

  </body>

</html>
