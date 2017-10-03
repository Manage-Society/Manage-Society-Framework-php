<?php

if($requete=='addblab'){
  \app\model\sql\generaltables::ajout_static(array(
  "cas"=>" blab,id_sujet,datos ",
  "valeur"=>" '$blab','$sujet',now() ",
  ),"blab_21");
}
if($requete=='actusujet'){
$rep="";
$_sujet=\app\model\sql\generaltables::rech_static(array(
"condition"=>" 	id_sujet='$idsujet' ORDER BY id DESC",),"blab_21");

if(!empty($_sujet)){
foreach ($_sujet as $valdep) {
$nom='Call Center';
$plus='';
if($valdep["id_client"]!="" & $valdep["id_client"]!="0"){
   $id_session=\app\model\sql\generaltables::info_static($valdep["id_client"],"id","client_21");
  $nom=$id_session["nom"];
   $rep .='<div class="right-helpdesk">';
}else{
  $rep .='<div class="left-helpdesk">';
     $plus='active-helpdesk';
}
$rep .='
    <div class="author-name-helpdesk">
        '.$nom.'
        <small class="chat-date-helpdesk">
             '.$valdep["datos"].'
         </small>
    </div>
    <div class="chat-message-helpdesk '.$plus.'">
        '.$valdep["blab"].'
    </div>
</div>';
}
echo $rep;
}
}

if($requete=='rechsujet'){
$tabfinal="";
$l_sujet=\app\model\sql\generaltables::rech_static(array(
"condition"=>"  options!='1' ",),"sujet_21");
if(!empty($l_sujet)) foreach ($l_sujet as $valdep) {

 if($tabfinal=="") {
   $tabfinal=$valdep["id"];
 }else{
   $tabfinal .=','.$valdep["id"];
 }

# code...
}

echo $tabfinal;

}

if($requete=='affichesujet'){
$tabfinal= array_diff(explode(",",$listesujet), explode(",",$affsujet));

foreach($tabfinal as $valdepos){

echo '<div style="height:380px;background-color:white; " class="col-md-3 thumbnail">
<div id="repsujet'.$valdepos.'" style="height:300px; overflow:auto">

</div>';
echo $design->form_new("addblab","sujet.php");
echo '<input type="hidden" name="sujet" value="'.$valdepos.'"><input type="text" name="blab" value="" class="form-control">
<button type="submit" name="button" class="btn btn-primary">Envoyez</button>';
echo $html->endform();
echo'  </div>';
}

}

?>
