Manage-Society.com
------------------

-Mettre dans votre index.php pour initialiser le framework:
<br>
<?php <br>
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
Vous pouvez maintenant mettre dans votre index.php le code:<br>
<br>
<?php <br>
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

Pour utiliser la base de donnée et la connexion a Manage-Society, vous devez change les paramètre de
votre base de donnee dans le fichier: app/home/asset/config.php <br>
Specialement db_hostname, db_username,db_mdp ,db_datatable,serveur_ms "qui est le nm serveur du client", api_ms "le code de api que vous utilise" . <br>
Vous devez creer la base de donné db_datatable qui par defaut est managesociety à travers votre SGBD
