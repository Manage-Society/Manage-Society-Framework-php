Manage-Society.com
------------------

-Mettre dans votre index.php pour initialiser le framework:

<?php
ini_set('display_errors', 1); <br>
ini_set('log_errors', 1);<br>
error_reporting(E_ALL);<br>
session_start();<br>
include_once("vendor/managesociety/framework/controller/autoloader.php");<br>
\ms\controller\autoloader::register();<br>
$app= new \ms\controller\appcontroller();<br>
$app->init();<br>

?>
<br><br>
Apres avoir initialise vous allez recevoir un message de reussite.
Vous pouvez maintenant mettre dans votre index.php le code:

<?php
ini_set('display_errors', 1); <br>
ini_set('log_errors', 1);<br>
error_reporting(E_ALL);<br>
session_start();<br>
include_once("vendor/managesociety/framework/controller/autoloader.php");<br>
\ms\controller\autoloader::register();<br>
$app= new \ms\controller\appcontroller();<br>
if(isset($_POST['controller'])){<br>
  $data=$app->recup->getPOST; //Recupere les données de la vue<br>
    $controllerxx = new $_POST["controllerrequest"]();<br>
    $controllerxx->$_POST["controller"]($data);<br>
  }else{<br>
 //On regle la route<br>
$app->route->send();<br>
}<br>
<br>
?><br>
