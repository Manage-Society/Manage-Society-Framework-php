<?php
namespace ms\view;

/**
 * Gere toutes les informations de la vue
 */
class html {

public $mysqli;
/**
 * Constructeur
 */
   public function __construct(){

   }

/**
 * Verifie les variable et le nettoie
 * @param  string $data [donne]
 * @param  string $type [type de donnée: text,int,]
 * @return string       [variable nettoye]
 */
   public function verif_val($data,$type){
     return $this->GetSqlValue($data,$type);
   }

/**
 * Nettoyage de la valeur
 * @param string $data [la donne]
 * @param string $type [le type de la variable]
 */
   public function GetSqlValue($data,$type){
  $ip_bd="127.0.0.1";
  $bd_username="";
  $bd_psswd="";

  if(isset($_SESSION["ip_bd"]))$ip_bd=$_SESSION["ip_bd"];
  if(isset($_SESSION["bd_username"]))$bd_username=$_SESSION["bd_username"];
  if(isset($_SESSION["bd_psswd"]))$bd_psswd=$_SESSION["bd_psswd"];

     if(isset($_SESSION["ip_bd"])){

       if (PHP_VERSION < 6) {
         $data = get_magic_quotes_gpc() ? stripslashes($data) : $data;
       }
       if($this->mysqli==""){
            $this->mysqli=$mysqli = new \mysqli($ip_bd,$bd_username, $bd_psswd);
       }else{
         $mysqli=$this->mysqli;
       }
       $theNotDefinedValue="";
       $data = $mysqli->real_escape_string($data);

       switch ($type) {
         case "text":
           $data = ($data != "") ? "'" . $data . "'" : "";
           break;
         case "long":
         case "int":
           $data = ($data != "") ? intval($data) : "";
           break;
         case "double":
           $data = ($data != "") ? doubleval($data) : "";
           break;
         case "date":
           $data = ($data != "") ? "'" . $data . "'" : "";
           break;
         case "defined":
           $data = ($data != "") ? $theDefinedValue : $theNotDefinedValue;
           break;
       }

      if($data!=''){
         $data  = substr($data, 0, -1);
         $data  = substr($data,1);
       }

          }
       return $data;
   }

/**
 * Gere les alertes
 * @param  string $type    [Type d'alerte]
 * @param  string $message [le message]
 * @param string $publie [verfie si on doit le mettre dans une session]
 * @return string          [le message]
 */
   public function afalert($type,$message,$publie=null){
		 $nom="infoerror";
		 $cle="Huxi";
		 $description='<div class="alert alert-'.$type.'" style="padding:5px 5px 5px 5px">'.$message.'</div>';
		$session = new \ms\view\session();
  if($publie=="")  $session->session("infoerror","",$description);
		return $description;
	}

  /**
   * Gere les alertes
   * @param  string $type    [Type d'alerte]
   * @param  string $message [le message]
   * @return string          [le message]
   */
  public static function _afalert($type,$message){
    $nom="infoerror";
    $cle="Huxi";
    $description='<div class="alert alert-'.$type.'" style="padding:5px 5px 5px 5px">'.$message.'</div>';
   $session = new \ms\view\session();
   $session->session("infoerror","",$description);
   return $description;
 }

/**
 * Genere un formulaire
 * @param  string $controller        [action qui sera lance dans le controller]
 * @param  string $controllerrequest [la classe dans le controller ou le fichier]
 * @param  string $validator         [si il y a une operation de validation]
 * @param  string $classaction       [si il doit appel une class]
 * @return string                    [interface]
 */
	 public static function form_new($controller,$controllerrequest,$validator=null,$classaction=null){
		$reponse ='<form action="index.php" id="form_'.$controller.'" name="form_'.$controller.'" method="post"  enctype="multipart/form-data">
<input type="hidden" name="controller" value="'.$controller.'">
<input type="hidden" name="controllerrequest" value="'.$controllerrequest.'">';
if($validator!="") $reponse .='<input type="hidden" name="validator" value="'.$validator.'">';
if($classaction!="") $reponse .='<input type="hidden" name="classaction" value="'.$classaction.'">';
return $reponse;

	 }

/**
 * Ferme un formulaire
 * @return string [</form>]
 */
	 public function endform(){
		return  '</form>';
	}



  /**
   * Execute une requete en ajax
   * @param  string $nomformulaire [nom du formulaire ]
   * @param  string $repav         [Avant execution]
   * @param  string $repap         [Apres execution]
   * @return [string]                []
   */
  	public function ajax_form($nomformulaire,$repav=null,$repap=null){

  		$valrep ='<script>';

  $valrep .='$(document).ready(function(){';

  	$valrep .=" $('form#form_$nomformulaire').ajaxForm({
                 beforeSubmit: function() {
  				$repav
  				   },
                 success: function(data) {
  $repap
},error: function(e) {
                   console.log(e);
                }
         });

  	  });";
   $valrep .='</script>	';
   return $valrep;
  	}

/**
 * Execute un formulaire en ajax
 * @param  string $nomformulaire [nom du formulaire]
 * @param  string $retour        [Commande de retour]
 * @return string                [la requete]
 */
    public function exec_form_ajax($nomformulaire,$retour){

      $valrep ='<script>';

    $valrep .='$(document).ready(function(){';

    $valrep .=' var $this = $("form#form_'.$nomformulaire.'");
    $.ajax({
                 url: $this.attr("action"),
                 type: $this.attr("method"),
                 data: $this.serialize(),
                 success: function(data) {
                    '.$retour.'
                 }
             });

             });
                  ';
    $valrep .='</script>	';
    return $valrep;
    }


 }


 ?>
