<?php
namespace ms\model;

//INFO: SGBD signifie Gestionnaire de base de donnée

/**
 * [Gestion des requetes SQL avec la bd]
 */
 class sql{
   /**
    * @var string $hostname [Adresse Ip]
    * @example 127.0.0.1
    */
	 public $hostname;

   /**
    * @var string $username [nom utilisateur phpmyadmin]
    * @example Pour phpmyadmin, c'est root
    */
	 public $username;

   /**
    * @var string $password [Mot de passe phpmyadmin]
    */
	 public $password;

   /**
    * @var  $dbcon [connecteur à la bd]
    */
  public $dbcon;
  /**
   * @var string $table [la table]
   */
	public $table;

  /**
   * @var string $datatable [la base de donné]
   */
	public $datatable;


/**
 * [Constructeur]
 * @param string $hostname  [Adresse IP serveur]
 * @param string $username  [nom utilisateur de la SGBD]
 * @param string $password  [Mot de passe de la SGBD]
 * @param string $datatable [Base de donné sur le SGBD]
 * @param string $table     [table sur le SGBD]
 */
    public function __construct($hostname=null,$username=null,$password=null,$datatable=null,$table=null){

		$this->hostname=$hostname;
    $this->username=$username;
		$this->password= $password;
		$this->table=$table;
		$this->datatable=$datatable;


	}


  public function list_champ_table($table=null,$bd=null){
    if($table=='') $table=$this->table;
    if($bd=="") $bd=$this->datatable;

    $rep="";

    $xxx=$this->requete(" SELECT *
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA='$bd' AND TABLE_NAME='$table' ");
  $exval="";
  $tableau="";
  $data=mysqli_fetch_assoc($xxx);


  foreach($xxx as $zoko){
  foreach($zoko as $k=>$v){

   if($exval==$table){

   $tableau .=$v.",";
   }

  $exval=$v;
  }

  }
    return $tableau;

  }

/**
 * [Creer le connecteur à la base de donné]
 * @param  string $datatable [nom de la base de donne]
 * @return string            [creer le connecteur à la base de donnée]
 */
  public function con($datatable=null){
    if($datatable!="") $this->datatable=$datatable;


    $this->dbcon= mysqli_connect(	$this->hostname,$this->username,$this->password,$this->datatable) or die(mysqli_connect_error());
      @mysqli_select_db($this->datatable);
      return $this->dbcon;
  }

/**
 * [Charge une ligne en static]
 * @example info_static("1","id","users","cycy"); //Recupere la ligne dans id=1 dans la table users du la BD: cycy
 * @param  array $data      [description]
 * @param  string $cas       [description]
 * @param  string $table     [description]
 * @param  string $datatable [description]
 * @return array            [Ligne sur la BD]
 */
	public static function info_static($data,$cas=null,$table,$datatable){

    if($datatable==""){
    $datatable	= $_SESSION["datatable"];
    }

  if(!isset($cas)) $cas='id';


  $wordbud = mysqli_connect($_SESSION["ip_bd"],$_SESSION["bd_username"],$_SESSION["bd_psswd"],$datatable) or die(mysqli_connect_error());
  @mysqli_select_db($datatable);


$sql = "SELECT * FROM $table WHERE ".$cas."='$data' ";


$req = mysqli_query( $wordbud,$sql) or die(mysqli_error($wordbud));

$data = mysqli_fetch_assoc($req);

$totalRows_data = mysqli_num_rows($req);
mysqli_close($wordbud);
if($totalRows_data == 0){
	return false;
}else{
/*foreach($data as $k=>$v){
$this->$k=$v;
}*/
if(!is_null($class)){
  $varios= new $class("",$data);
  $data= $varios->info;
}
return $data;
}


	}

/**
 * [Charge une ligne dans la table]
 * @example info("1","id"); //Recupere la ligne id=1 dans la table et BD de la table
 * @param  array $data      [description]
 * @param  [type] $cas       [description]
 * @param  [type] $table     [description]
 * @param  [type] $datatable [description]
 * @param string $action [appel une action de la class]
 * @return array            [la ligne]
 */
  public function info($data,$cas=null,$table=null,$datatable=null,$action=null){

    if($table=="") $table=$this->table;
    if($datatable=="") $datatable=$this->datatable;

    $wordbud=$this->con();

	/*mysql_select_db($datatable, $wordbud);*/
$sql = "SELECT * FROM $table WHERE ".$cas."='$data' ";


$req = mysqli_query( $wordbud,$sql) or die(mysqli_error($wordbud));

$data = mysqli_fetch_assoc($req);
$totalRows_data = mysqli_num_rows($req);
mysqli_close($wordbud);
if($totalRows_data == 0){
	return false;
}else{

//->Format les données
$class=get_class($this);
$class= new $class();
if(method_exists($class,'format')) $data=$class->format($data);
//-->

//-->Excute une action par defaut
if($action!=""){
 $class=get_class($this);
 $class= new $class();
  $data=$class->$action($data);
}
//-->
return $data;
}


	}


/**
 * [Recherche dans une table]
 * @example rech_static(array("condition"=>" id='1' ",),$table,""); //Recherche dans la table la ligne id='1'
 * @param  array  $data      [les donnees]
 * @param  string $table     [la table]
 * @param  string $datatable [la base de donne]
 * @return array            [La chaine qui correspond à la demande]
 */
	public function rech(array $data,$table=null,$datatable=null){
    if($table=="") $table=$this->table;
    if($datatable=="") $datatable=$this->datatable;
		$condition ="1=1";
		$cas ="*";
		$limit ="";
		$order ="";
		$tablo ="";

      $wordbud=$this->con();



	if (isset($data["condition"])){ $condition=$data["condition"];}
	if (isset($data["cas"])){ $cas=$data["cas"];}
	if (isset($data["limit"])){ $limit="LIMIT ".$data["limit"];}
	if (isset($data["order"])){ $order="ORDER BY ".$data["order"];}
	if (isset($data["tablo"])){ $tablo="ORDER BY ".$data["tablo"];}
  $l_data_user=$data;
 $sql = "SELECT $cas FROM $table WHERE $condition $order $limit";

	 $req = mysqli_query( $wordbud,$sql) or die(mysqli_error($wordbud));
     $totalRows_data = mysqli_num_rows($req);
	 $d= array();
	 if ($totalRows_data == 0) {
	 $d="";
     }else{

		 while($data = mysqli_fetch_assoc($req)){
			$d[]= $data;

		 }
		 }

mysqli_close($wordbud);
     if(isset($l_data_user["action"])) if($l_data_user["action"]!=""){

       $reponse=array();
       if(!empty($d)) foreach ($d as $valos) {
         $vacoz= $this->$l_data_user["action"]("",$valos);
         array_push($reponse,$vacoz);  # code...
       }
       $d=$reponse;
     }

     if(isset($l_data_user["class"])) if($l_data_user["class"]!=""){

       $reponse=array();
       if(!empty($d)) foreach ($d as $valos) {
         $vacoz= new $l_data_user["class"]("",$valos);
         array_push($reponse,$vacoz->info);  # code...
       }
       $d=$reponse;
     }
      return  $d;

	}

/**
 * [Fais la mise à jour static]
 * @param  array  $data      [description]
 * @param string $table      [description]
 * @param string $datatable [description]
 * @return mixed       [Aucun retour]
 */
	public static function miseajour_static($data=array(),$table,$datatable){
	if($datatable==""){
		$datatable	=$_SESSION["datatable"];
		}
	    $hostname_wordbud = $_SESSION["ip_bd"];

$username_wordbud = $_SESSION["bd_username"];
$password_wordbud = $_SESSION["bd_psswd"];

$wordbud = mysqli_connect($hostname_wordbud, $username_wordbud, $password_wordbud,$datatable)  or die(mysqli_connect_error());
@mysqli_select_db($datatable);

/*mysql_select_db($datatable, $wordbud);*/

		$cas ="";
		$valeur ="";

	if (isset($data["cas"])){ $cas=$data["cas"];}
	if (isset($data["valeur"])){ $valeur=$data["valeur"];}

  //  $mysqli = new mysqli($hostname_wordbud, $username_wordbud, $password_wordbud,$datatable);
  //  $cas = $mysqli->real_escape_string($cas);

	if(($cas== "") || ($valeur== "")){
		}else{
  $query_cat = sprintf("UPDATE $table
    SET $valeur WHERE $cas ");
	 $cat = mysqli_query($wordbud,$query_cat) or die(mysqli_error($wordbud));
		}
mysqli_close($wordbud);
	}

  /**
   * [Fais la mise à jour]
   * @param  array  $data      [description]
   * @param string $table      [description]
   * @param string $datatable [description]
   * @return mixed       [Aucun retour]
   */
	public function miseajour($data=array(),$table=null,$datatable=null){
    $lastid="";
    if($table=="") $table=$this->table;
    if($datatable=="") $datatable=$this->datatable;
    $wordbud=$this->con();

		$cas = $valeur ="";

	if (isset($data["cas"])){ $cas=$data["cas"];}
	if (isset($data["valeur"])){ $valeur=$data["valeur"];}

	if(($cas== "") || ($valeur== "")){
		}else{
   $query_cat = sprintf("UPDATE $table SET $valeur WHERE $cas ");
	 $cat = mysqli_query($wordbud,$query_cat) or die(mysqli_error($wordbud));
		}
    mysqli_close($wordbud);
	}

/**
 * Supprime une ligne
 * @example supprimer(array("valeur"=>" id='$id_val'  ",),$table,$datatables);
 * @param  array  $data [donne]
 * @param string $table [la table]
 * @param string $datatable [la BD]
 * @return []       []
 */
  public function supprimer($data=array(),$table=null,$datatable=null){


		if($table=="") {
			$table=$this->table;
		}


$wordbud=$this->con();

/*mysql_select_db($datatable, $wordbud);*/

		$valeur ="";
	if (isset($data["valeur"])){ $valeur=$data["valeur"];}

	if(($valeur== "")){
		}else{
$query_cat = sprintf("DELETE FROM ".$table." WHERE  $valeur");
$cat = mysqli_query( $wordbud,$query_cat) or die(mysqli_error($wordbud));
		}
mysqli_close($wordbud);
  }

/**
 * Supprimer une variable
 * @param  array  $data [donne de la requete]
 * @param string $table [table ]
 * @param string $datatable [base de donné]
 * @return [type]       [description]
 */
	public static function supprimer_static($data=array(),$table,$datatable){
		if($datatable==""){
		$datatable	=$_SESSION["datatable"];
		}


	    $hostname_wordbud = $_SESSION["ip_bd"];

$username_wordbud = $_SESSION["bd_username"];
$password_wordbud = $_SESSION["bd_psswd"];
$wordbud = mysqli_connect($hostname_wordbud, $username_wordbud, $password_wordbud,$datatable) or die(mysqli_connect_error());
@mysqli_select_db($datatable);

		$valeur ="";
	if (isset($data["valeur"])){ $valeur=$data["valeur"];}

	if(($valeur== "")){
		}else{
$query_cat = sprintf("DELETE FROM ".$table." WHERE  $valeur");
$cat = mysqli_query( $wordbud,$query_cat) or die(mysqli_error($wordbud));
		}
    mysqli_close($wordbud);
	}

/**
 * [Requete static]
 * @param  string $requete   [une requete]
 * @param  [string] $datatable [nom de la base de donné]
 * @return []            []
 */
	public static function requete_static($requete,$datatable){
		if($datatable==""){
		$datatable	=$_SESSION["datatable"];
		}
		 $hostname_wordbud = $_SESSION["ip_bd"];

$username_wordbud = $_SESSION["bd_username"];
$password_wordbud = $_SESSION["bd_psswd"];
$wordbud = mysqli_connect($hostname_wordbud, $username_wordbud, $password_wordbud,$datatable) or die(mysqli_connect_error());
@mysqli_select_db($datatable);


$query_cat = sprintf("".$requete."");
$cat = mysqli_query( $wordbud,$query_cat) or die(mysqli_error($wordbud));
mysqli_close($wordbud);
		return $cat;
	}

/**
 * Requete sepcial
 * @param  string $requete   [une requete]
 * @param  string $datatable [la base de donnée]
 * @return []            [description]
 */
	public function requete($requete,$datatable=null){

			 $hostname_wordbud = $this->hostname;

$username_wordbud = $this->username;
$password_wordbud = $this->password;
if($datatable=="") {
$datatable =$this->datatable;
}else{
$datatable =$datatable;
}

$wordbud = mysqli_connect($hostname_wordbud, $username_wordbud, $password_wordbud,$datatable) or trigger_error(mysqli_error($wordbud),E_USER_ERROR);

/*mysql_select_db($datatable, $wordbud);*/



$query_cat = sprintf("".$requete."");
$cat = mysqli_query($wordbud,$query_cat) or die(mysqli_error($wordbud));
mysqli_close($wordbud);
/*$data = mysql_fetch_array($cat);*/
		return $cat;
	}

	public static function ajout_static($data=array(),$table,$datatable=null,$plus=null){

		 $lastid ="";

if($datatable==""){
		$datatable	=$_SESSION["datatable"];
		}

	    $hostname_wordbud = $_SESSION["ip_bd"];

$username_wordbud = $_SESSION["bd_username"];
$password_wordbud = $_SESSION["bd_psswd"];

$wordbud = mysqli_connect($hostname_wordbud, $username_wordbud, $password_wordbud,$datatable) or die(mysqli_connect_error());
@mysqli_select_db($datatable);


		$cas ="";
		$valeur ="";

	if (isset($data["cas"])){ $cas=$data["cas"];}
	if (isset($data["valeur"])){ $valeur=$data["valeur"];}





		 $query_cat = "INSERT INTO ".$table." ($cas) VALUES ($valeur)" ;

	$cat = mysqli_query( $wordbud,$query_cat) or die(mysqli_connect_error());

	 $lastid = mysqli_insert_id($wordbud);
mysqli_close($wordbud);
		return $lastid;

	}

/**
 * Ajout à une table
 * @example example ajout(array("cas"=>" nom ","valeur"=>" 'cyriaque' ",));
 * @param  array  $data [donne]
 * @param string $table [la table]
 * @param string $datatable [la base de donne]
 * @return int       [Le dernier id]
 */
	public function ajout($data=array(),$table=null,$datatable=null){
    $lastid="";
    if($table=="") $table=$this->table;
    if($datatable=="") $datatable=$this->datatable;

      $wordbud=$this->con();

		$cas = $valeur ="";

	if (isset($data["cas"])){ $cas=$data["cas"];}
	if (isset($data["valeur"])){ $valeur=$data["valeur"];}

		 $query_cat = "INSERT INTO ".$table." ($cas) VALUES ($valeur)" ;

	$cat = mysqli_query( $wordbud,$query_cat) or die(mysqli_error($wordbud));
	 $lastid = mysqli_insert_id($wordbud);
mysqli_close($wordbud);
		return $lastid;
	}


}








?>
