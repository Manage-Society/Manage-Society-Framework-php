<?php
$plus=" 1=1 ";

$class_produit=$app->getmodel("produit");
if(isset($_GET["cat"])) $plus=" id_categorie='".$_GET["cat"]."' ";
if(isset($_GET["prod"])) $plus .=" and nom like '%".$_GET["prod"]."%'";
$list_prod=$class_produit->rech(array(
        "condition"=>" $plus ",));
    if(!empty($list_prod)) foreach ($list_prod as $valdep) echo $class_produit->affiche($valdep);
 ?>
