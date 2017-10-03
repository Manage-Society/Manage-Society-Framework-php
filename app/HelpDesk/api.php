<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);

define('DATA_PATH', realpath(dirname(__FILE__).''));
include_once("../app/model/config.php");
$req= new \app\model\sql\generaltables;
try {
  if(!isset($_POST["type"])) $enc_request = $_REQUEST['enc_request'];



    $app_id = substr($_REQUEST['app_id'], -2);
    $mdp_id=$_REQUEST['mdp_id'];

	 $verifapi= \app\model\sql\generaltables::rech_static(array(
		"condition"=>" id_app='$app_id' and mdp='$mdp_id' ",

		),"api_app",'clientsociete');

		if(empty($verifapi)){
			throw new Exception('Application existe pas!');
		}

	if(!isset($_POST["type"]))	$params = json_decode(trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $mdp_id, base64_decode($enc_request), MCRYPT_MODE_ECB)));
if(isset($_POST["type"])) $params=json_decode($_REQUEST['params']);

		 if( $params == false || isset($params->controller) == false || isset($params->action) == false ) {
        throw new Exception('Requete non valide');
    }

	 $params = (array) $params;



	    $controller = strtolower($params['controller']);

    $action = strtolower($params['action']).'_api';


    if( file_exists("../dev/app/".$app_id."/model/".$controller.".php") ) {
        include_once "../dev/app/".$app_id."/model/".$controller.".php";
    } else {
        throw new Exception('Controller est invalide.');
    }


 $controller = new $controller($params);


    if( method_exists($controller, $action) === false ) {
        throw new Exception('Action est invalide.');
    }


    $result['data'] = $controller->$action($params);
    $result['success'] = true;





} catch( Exception $e ) {

    $result = array();
    $result['success'] = false;
    $result['errormsg'] = $e->getMessage();
}



echo preg_replace("/\\\\u([a-f0-9]{4})/e", "iconv('UCS-4LE','UTF-8',pack('V', hexdec('U$1')))", json_encode($result));
exit();


?>
