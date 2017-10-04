<?php
namespace ms\view;

/**
 * Traite les informations de la vue au controller
 */
class recupval extends \ms\view\html{

  public $server;
  public $getGET;
  public $getPOST;

  public function __construct(){
    $this->server=$_SERVER;
    $this->recup();
  }

  /**
   * Recupere les variables POST et GET envoye
   * @return [type] [description]
   */
  public function recup(){
    $htmlo= new \ms\view\html();
    $l_donnee=array();
    foreach ($_POST as $nomchamp => $valeurchamp){
        $$nomchamp = $htmlo->verif_val($valeurchamp,'text');
          $l_rep=$htmlo->verif_val($valeurchamp,'text');
      $l_donnee=array_merge($l_donnee,array($nomchamp=>$l_rep));
    }
    $this->getPOST=$l_donnee;

    $l_donnee=array();
    foreach ($_GET as $nomchamp => $valeurchamp){
        $$nomchamp = $htmlo->verif_val($valeurchamp,'text');
          $l_rep=$htmlo->verif_val($valeurchamp,'text');
      $l_donnee=array_merge($l_donnee,array($nomchamp=>$l_rep));
    }
    $this->getGET=$l_donnee;
  }

	public static function mod($POST,$valspec=null){
		if($valspec=="") $valspec="mod_";
		$taille=strlen($valspec);

		$leretour="";
		$lareq=$laval="";
		$htmlgo= new \ms\view\html();
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

$htmlgo= new \ms\view\html();

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
		$htmlgo= new \ms\view\html();
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
    if($lareq=="") $lareq=" (1=1) ";
	return $lareq;
	}



	public static function rech_like($POST,$valspec=null){
		if($valspec=="") $valspec="rech_";
		$taille=strlen($valspec);
		$leretour="";
		$lareq="";
		$htmlgo= new \ms\view\html();
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
		$htmlgo= new \ms\view\html();
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
