<?php
namespace core;

/**
 * Telecharge un fichier
 */
class tel {

/**
 * Permet de telecharger un fichier
 * @param  string $files     [le fichier $_FILE]
 * @param  string $idos      [le name du input file]
 * @param  string $ledossier [le dossier de sauvegarde]
 * @return string            [Reponses 0:pas charge, 1:mauvaise taile, Sinon URL]
 */
	public function tel_fich($files,$idos,$ledossier=null){

if($ledossier!=""){

	if(!file_exists($ledossier)) mkdir($ledossier, 0777);
}else{
	$ledossier="vendor/img";
	if(!file_exists("vendor/img/")) mkdir("vendor/img/", 0777);
}


		if(isset($_FILES[''.$idos.'']["size"])){

	$taille=$_FILES[''.$idos.'']["size"];


	if($taille !=0){
	$RandomNumber 	= rand(0, 9999999999);
	  $RandomNumber 	= '-'.date("Y-m-d-h-s").$RandomNumber;
	 $name = $_FILES[''.$idos.'']["name"];
	 $ext= strtolower(substr($name,-3));


	    $interdit=array("é","ç","'"," ","è");
	 if(1==1){
	     if(1==1){

	 $name=str_replace($interdit,"",$name);
			$name = substr_replace($name,$RandomNumber , 1,0);
			 move_uploaded_file( $_FILES[''.$idos.'']["tmp_name"], ''.$ledossier.'/'.$name);
		 }else{
			 $name = '0';
		 }
	 }
	}else{
	$name=1;
	}

	if(($name !="0")&($name !="1")){
		 return $ledossier.'/'.$name;
	}else{
	return $name;
	}

		 }
	}


}

?>
