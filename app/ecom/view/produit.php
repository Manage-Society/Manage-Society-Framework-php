<?php
$l_prod=$app->getmodel("produit")->info($data["id_prod"],"id");
if(isset($l_prod["id"])){
 ?>

<hr>
<div class="row">
  <div class="col-md-6">
    <img src="<?php echo $l_prod["image"] ?>" alt="">
  </div>

  <div class="col-md-6">
    <h3><?php echo $l_prod["nom"] ?></h3>
    <p><?php echo $l_prod["description"] ?></p>
    <p>Prix: <?php echo $l_prod["prix"] ?></p>
    <a href="index.php?pg=cmd&id_prod=<?php echo $l_prod["id"] ?>">Commander</a>
  </div>

</div>

<?php } ?>
