<?php
namespace app\core;

/**
 * Traite les informations de la vue au controller
 */
class recupval extends \app\core\model\html{
  public $app;

  public function __construct(){

  }

/**
 * Ajout automatique dinformation de type add
 * @param [type] $model     [description]
 * @param [type] $condition [description]
 */
  public function add_sql($model,$condition=null,$cas=null,$valeur=null){
    $this->app=$GLOBALS["app"];
  if($condition=="") $condition="add_";
  $caso=$cas;
  $valeuro=$valeur;
  if($cas!="")  $caso =",".$cas;
    if($valeur!="")  $valeuro =','.$valeur;

    $reponse= $this->app->recup->add($_POST,$condition);
    $lavalfinal=explode("!!!!!!",$reponse);
    $leschamps=$lavalfinal[0];
    $lesvariables=$lavalfinal[1];
    $lastid= $this->app->getmodel($model)->ajout(array(
    "cas"=>" $leschamps $caso ",
    "valeur"=>" $lesvariables $valeuro ",
    ));
    return $lastid;
  }

  public function update_sql($model,$requete,$condition=null,$cas=null){
    $this->app=$GLOBALS["app"];
    if($condition=="") $condition="mod_";
    $caso=$cas;
    if($cas!="") $caso .=",".$cas;
    $reponse= $this->app->recup->mod($_POST,$condition);
    $lavalfinal=explode("!!!!!!",$reponse);
    $leschamps=$lavalfinal[0];
    $this->app->getmodel($model)->miseajour(array(
    "valeur"=>" $leschamps $caso ",
    "cas"=>" $requete ",
    ));
  }

	public static function mod($POST,$valspec=null){
		if($valspec=="") $valspec="mod_";
		$taille=strlen($valspec);

		$leretour="";
		$lareq=$laval="";
		$htmlgo= new \app\core\model\html();
		foreach ($POST as $nomchamp => $valeurchamp){

	 $$nomchamp = $htmlgo->verif_val($valeurchamp,'text');

	 if(substr($nomchamp,0,$taille)==$valspec){

	if($lareq==""){
	$lareq="".substr($nomchamp,$taille)."='".$valeurchamp."'";
    }else{
		 $lareq .=",".substr($nomchamp,$taille)."='".$valeurchamp."'";
	}

	if($nomchamp==$valspec."_id"){
	$laval=" id='".$valeurchamp."' ";
	}


	 }

	}


	return $lareq."!!!!!!".$laval;



	}
	public static function add($POST,$valspec=null){

	if($valspec=="") $valspec="add_";
		$taille=strlen($valspec);

		$leretour="";
		$lareq=$laval="";

$htmlgo= new \app\core\model\html();

		foreach ($POST as $nomchamp => $valeurchamp){

	 $$nomchamp = $htmlgo->verif_val($valeurchamp,'text');

	 if(substr($nomchamp,0,$taille)==$valspec){

	if($lareq==""){

$lareq="".substr($nomchamp,$taille)."";
$laval="'".$valeurchamp."'";

	}else{


		 $lareq .=",".substr($nomchamp,$taille)."";
		 $laval .=",'".$valeurchamp."' ";

	}




	}



		}
	return $lareq."!!!!!!".$laval;
	}

  public function verif_val($data,$type){

  	 include_once(''.$_SERVER['DOCUMENT_ROOT'].'/vendor/call/verif.php');
  if($data==''){return '';}else{
  	 $rep = GetSQLValueString($data, ''.$type.'');
  	 $rep  = substr($rep, 0, -1);
  	 $rep  = substr($rep,1);
  	return $rep;
  }
  }


	public static function rech($POST,$valspec=null){
		if($valspec=="") $valspec="rech_";
		$taille=strlen($valspec);
		$leretour="";
		$lareq="";
		$htmlgo= new \app\core\model\html();
		foreach ($POST as $nomchamp => $valeurchamp){

	 $$nomchamp = $htmlgo->verif_val($valeurchamp,'text');
if($valeurchamp!=""){
	 if(substr($nomchamp,0,$taille)==$valspec){

	if($lareq==""){
$lareq=" ".substr($nomchamp,$taille)."='".$valeurchamp."'  ";
	}else{
		 $lareq .=" and ".substr($nomchamp,$taille)."='".$valeurchamp."'  ";
	}


	 }





 }

		}
	return $lareq;
	}



	public static function rech_like($POST,$valspec=null){
		if($valspec=="") $valspec="rech_";
		$taille=strlen($valspec);
		$leretour="";
		$lareq="";
		$htmlgo= new \app\core\model\html();
		foreach ($POST as $nomchamp => $valeurchamp){

	 $$nomchamp = $htmlgo->verif_val($valeurchamp,'text');

if($valeurchamp!=""){
	 if(substr($nomchamp,0,$taille)==$valspec){

	if($lareq==""){
$lareq=" ".substr($nomchamp,$taille)." LIKE '%$valeurchamp%'  ";
	}else{
		 $lareq .=" and ".substr($nomchamp,$taille)." LIKE '%$valeurchamp%'  ";
	}


	 } }

	}
	if($lareq=="") $lareq=' 1=1 ';
	 return $lareq;
	}


	public static function list_rech($POST){
		$leretour="";
		$lareq="";
		$htmlgo= new \app\core\model\html();
		foreach ($POST as $nomchamp => $valeurchamp){

	 $$nomchamp = $htmlgo->verif_val($valeurchamp,'text');

	 if(substr($nomchamp,0,5)=="rech_"){

	if($lareq==""){
$lareq=" ".substr($nomchamp,5)."";
	}else{
		 $lareq .=",".substr($nomchamp,5)."";
	}


	 }





 }


	return $lareq;
	}





}


?>
