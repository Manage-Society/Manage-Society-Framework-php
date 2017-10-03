<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="http://localhost/framework/app/core/vendor/bootstrap_v_3_3_7/css/bootstrap.css" >
    <script src="http://localhost/framework/app/core/vendor/jquery/jquery.min.js"></script>
    <script src="http://localhost/framework/app/core/vendor/bootstrap_v_3_3_7/js/bootstrap.js"></script>
    <script src="http://localhost/framework/app/vuejs/vendor/vuejs.js"></script>
  </head>
  <body class="container">

    <div id="header">
      <div class="row">
        <div class="col-md-6">
          ECOM
        </div>
        <div class="col-md-6">
          <form class="" action="index.php" method="get">

              <input type="text" name="prod" value="<?php if(isset($_GET["prod"])) echo $_GET["prod"]; ?>" placeholder="recherche">
          </form>

        </div>

      </div>
      <div class="">
        <ul class="list-inline">
            <li><a href="http://localhost/framework/">Accueil</a></li>
          <?php
          $list_cate=$app->getmodel("categorie")->rech(array("condition"=>" 1=1 ",));
          if(!empty($list_cate)) foreach ($list_cate as $valdep) {
          ?>
          <li><a href="cat/<?php echo $valdep["id"]; ?>"><?php echo $valdep["nom"]; ?></a></li>
          <?php } ?>
        </ul>

      </div>
    </div>

    <div class="body">

      <?php
      if(isset($data["pg"])){
        include("app/".$app->root."/view/cmd.php");
      }else if(isset($data["id_prod"])){
        include("app/".$app->root."/view/produit.php");
      }else{
        include("app/".$app->root."/view/ac.php");
      }
      ?>

    </div>

    <div class="footer">
        ECOM
    </div>

  </body>
</html>
