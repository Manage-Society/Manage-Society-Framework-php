<?php

class utilisateur
{
  public $nom;
  public $xa;
  public $ya;

  function __construct($nom,$xa,$ya){
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
  $ab=0;
  if ($xa>$xb) {
    $xc=$xa-$xb;
  }else {
  $xc= $xb-$xa;
  }
  if ($ya<$yb) {
    $yc=$yb-$ya;
  }else {
    $yc=$ya-$yb;
  }
  $ab=sqrt($xc*$xc+$yc*$yc);

  return $ab;

  }
}

class information{
  public $titre;
  public $xa;
  public $ya;
  public $info;
  public $nomperso;

  function __construct($titre,$info,$xa,$ya,$nomperso){
    $this->titre=$titre;
    $this->xa=$xa;
    $this->ya=$ya;
    $this->info=$info;
    $this->nomperso=$nomperso;
  }

  function publication(){
    return "  <h3>".$this->nomperso.":".$this->titre."</h3>
      <h6>".$this->info."</h6><hr>";
}
}

$geometrie= new geometrie();

$utilisateur= new utilisateur("cyriaque",2,15);
$info1= new information("Urgent","L'armée congolaise a neutralisé 22 ninjas à SOUMOUNA aux alentours
  de 3h, les populations n'ont déploré  aucune victime.",2,5,"SONGEUR1");
  $info2= new information("SPORT","CONGO-RDC les diables rouges s'incline 3-1
  BIFOUMA buteur et sorti pour blessure ,
coup dur pour SEBASTIEN MIGNE",1,13,"SONGEUR2");
$info3= new information("TELECOMMUNICATION","internet pertubé pour peut etre deux a sept semmaines
a cause d'un cable rompu au large de POINTE-NOIRE",1,13,"SONGEUR3");


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
    <div class="color">
      <div class="row">
        <div class="col-md-6">
          <h1>SONGI-SONGI.COM</h1>
        </div>

        <div class="col-md-6" >
 <?php echo $utilisateur->nom; ?>
        </div>
      </div>

    </div>

    <br>
    <div class="containers">
      <?php if($geometrie->distance($utilisateur,$info1)<=10) echo $info1->publication(); ?>
      <?php if($geometrie->distance($utilisateur,$info2)<=10) echo $info2->publication(); ?>
      <?php if ($geometrie->distance($utilisateur,$info3)<=10) echo $info3->publication(); ?>
</html>
