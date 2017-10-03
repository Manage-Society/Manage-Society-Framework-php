<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="app/core/vendor/bootstrap_v_3_3_7/css/bootstrap.css" >
    <script src="app/core/vendor/jquery/jquery.min.js"></script>
    <script src="app/core/vendor/bootstrap_v_3_3_7/js/bootstrap.js"></script>
    <script src="app/vuejs/vendor/vuejs.js"></script>
  </head>
  <body>
    <?php include("app/".$app->root."/view/".$_GET["url"].".php"); ?>
  </body>
</html>
