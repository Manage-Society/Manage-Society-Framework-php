<?php
namespace app\datauser\controller;

class sessionuserctr extends \app\datauser\model\session_user{

  public $bd="datauser";
  public $nom_js="";

  public function __construct(){
    $this->nom_js="datauser_".$this->bd."_".md5($this->bd).".js";
    parent::__construct();
  }

public function create_js($data){

if(is_file("vendor/datauser/".$this->nom_js))
  unlink("vendor/datauser/".$this->nom_js);
$class_user= new \app\datauser\model\user();
  $liste_user=$class_user->list_champ_table();

   $class_session= new \app\datauser\model\session_user();
      $liste_session_user=$class_session->list_champ_table();

    ob_start();
  require("app/datauser/view/ex_js.php");
  $content = ob_get_clean();

    $monfichier = fopen("vendor/datauser/".$this->nom_js, 'a+');
    fputs($monfichier, $content);
    fclose($monfichier);



}

public function stat($data){
  $class_user= new \app\datauser\model\user();
   $class_session= new \app\datauser\model\session_user();
   $dossier_final =$dossier_user=$dossier_session="";

  $requete_session= $requete_user="";
   $champ_user=$data["champ_user"];
   foreach(explode(",",$champ_user) as $valos){
     if(isset($data["select_user_".$valos.""])) if($data["select_user_".$valos.""]!=""){

       if($data["select_user_".$valos.""]=="like"){
         $requete_user.="and $valos LIKE '%".$data["reponse_user_".$valos.""]."%'";
       }else if($data["select_user_".$valos.""]=="="){
         $requete_user.="and $valos".$data["select_user_".$valos.""]."'".$data["reponse_user_".$valos.""]."'";
       }

     }
   }
 $requete_user=" 1=1 ".$requete_user;
 $rep_user=$class_user->rech(array(
 "condition"=>" $requete_user ",));
 if(!empty($rep_user)) foreach ($rep_user as $valdep) {
   if($dossier_user==""){
     $dossier_user=$valdep["id"];
   }else{
     $dossier_user .=','.$valdep["id"];
   }
 }

//---->
$champ_session=$data["champ_session"];
foreach(explode(",",$champ_session) as $valos){
  if(isset($data["select_session_".$valos.""])) if($data["select_session_".$valos.""]!=""){

    if($data["select_session_".$valos.""]=="like"){
      $requete_user.="and $valos LIKE '%".$data["reponse_session_".$valos.""]."%'";
    }else if($data["select_session_".$valos.""]=="="){
      $requete_user.="and $valos".$data["select_session_".$valos.""]."'".$data["reponse_session_".$valos.""]."'";
    }

  }
}
$requete_session=" 1=1 ".$requete_session;
if($requete_session!=" 1=1 "){
$rep_session=$class_session->rech(array(
"condition"=>" $requete_session ",));
if(!empty($rep_session)) foreach ($rep_session as $valdep) {
if($dossier_session==""){
  $dossier_session=$valdep["id_user"];
}else{
if(!in_array($valdep["id_user"],explode(",",$dossier_user))){
   $dossier_session .=','.$valdep["id_user"];

}
}
}
}

if($dossier_session!=""){
  $dossier_final = array_intersect(explode(",",$dossier_user), explode(",",$dossier_session));
}else{
  $dossier_final=explode(",",$dossier_user);
}

foreach($dossier_final as $kokos){
$rep_user=$class_user->info($kokos,"id");
 echo'<div class="thumbnail">
 '.$rep_user["name"].'<br>

 </div>';
}

  //var_dump($data);
}

public function add_variable($data){
  $class_user= new \app\datauser\model\user();
  $migration = new \app\core\model\migration($class_user);
$migration->add($data["parametre"]," text NULL ");
echo "Done";
}

public function init($data){
  $recupval= new \app\core\recupval();
  $class_user= new \app\datauser\model\user();
   $class_session= new \app\datauser\model\session_user();


  $id_user=$data["id_user"];

  if($data["modd_id_user_client"]==""){

    if($id_user==""){
      $id_user=  $class_user->ajout(array(
        "cas"=>" create_at ",
        "valeur"=>" now() ",
        ));
    }

  }else{

    if($id_user==""){
      $id_user=  $class_user->ajout(array(
        "cas"=>" create_at ",
        "valeur"=>" now() ",
        ));
    }else{
      $rep_user=$class_user->info($data["modd_id_user_client"],"id_user_client");
      if(isset($rep_user["id"])){
        $id_user=$rep_user["id"];
      }else{
        $id_user=  $class_user->ajout(array(
          "cas"=>" create_at ",
          "valeur"=>" now() ",
          ));
      }
    }

  }




$datos=date("d-m-Y");
$heuros=date("H:i");

$reponse= $recupval->add($data,"add_");
$lavalfinal=explode("!!!!!!",$reponse);
$leschamps=$lavalfinal[0];
$lesvariables=$lavalfinal[1];
$lastid=$class_session->ajout(array(
"cas"=>" $leschamps,id_user,datos,heuros ",
"valeur"=>" $lesvariables,'$id_user','$datos','$heuros' ",
));


$reponse= $recupval->mod($data,"modd_");
$lavalfinal=explode("!!!!!!",$reponse);
$leschamps=$lavalfinal[0];
$class_user->miseajour(array(
"valeur"=>" $leschamps,datos='$datos',heuros='$heuros' ",
"cas"=>" id='$id_user'",
));


echo $id_user;
}

}

 ?>
