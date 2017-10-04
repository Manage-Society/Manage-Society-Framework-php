Manage-Society.com
------------------

-Mettre dans votre index.php:

ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);
session_start();
include_once("vendor/managesociety/framework/controller/autoloader.php");
\ms\controller\autoloader::register();
$app= new \ms\controller\appcontroller();

-Vous devez initialise l'architecture du framework:
$app->init();
