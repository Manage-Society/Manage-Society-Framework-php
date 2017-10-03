<?php

class helpdesk{

public function design($id_sujet,$serveur,$id_session){
$rep="";
   $_sujet=\app\model\sql\generaltables::rech_static(array(
   "condition"=>" 	id_sujet='$id_sujet' ORDER BY id DESC",),"blab_21",$serveur);
   $id_session=\app\model\sql\generaltables::info_static($id_session,"id","client_21",$serveur);
   foreach ($_sujet as $valdep) {
     $nom='Call Center';
     $plus='';
     if($valdep["id_client"]!="" & $valdep["id_client"]!="0"){
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
return $rep;

}

public function blab_user_api(array $params){
$id_client_helpdesk= $params["id_session"];
$l_sujet=\app\model\sql\generaltables::rech_static(array(
 "condition"=>" id_client='$id_client_helpdesk' and options!='1' LIMIT 1",),"sujet_21",$params["serveur"]);
if(empty($l_sujet)){
$id_sujet=\app\model\sql\generaltables::ajout_static(array(
"cas"=>" sujet,id_client ",
"valeur"=>" 'information','$id_client_helpdesk' ",
),"sujet_21",$params["serveur"]);

\app\model\sql\generaltables::ajout_static(array(
"cas"=>" blab,id_sujet,datos ",
"valeur"=>" 'Votre besoin?','$id_sujet',now() ",
),"blab_21",$params["serveur"]);

return  $this->design($id_sujet,$params["serveur"],$params["id_session"]);
} else{
  foreach ($l_sujet as $valdep) $id_sujet=$valdep["id"];
  if(isset($params["blab"])) if($params["blab"]!=""){
$blab=$params["blab"];
$id_session=$params["id_session"];
    \app\model\sql\generaltables::ajout_static(array(
  "cas"=>" blab,id_sujet,datos,id_client ",
  "valeur"=>" '$blab','$id_sujet',now(),'$id_session' ",
  ),"blab_21",$params["serveur"]);
  }

foreach ($l_sujet as $valdep) return  $this->design($valdep["id"],$params["serveur"],$params["id_session"]);
}

}

public function new_user_api(array $params){
$nom=$params["nom"];
$email=$params["email"];
$telephone=$params["telephone"];
$rech_user=\app\model\sql\generaltables::rech_static(array(
   "condition"=>" email='$email' or telephone='$telephone' LIMIT 1",),"client_21",$params["serveur"]);

if(!empty($rech_user)){
foreach ($rech_user as $valdep) {
$id_client=$valdep["id"];
\app\model\sql\generaltables::miseajour_static(array(
"valeur"=>" email='$email',telephone='$telephone' ",
"cas"=>" id='  $id_client'",
),"client_21",$params["serveur"]);
# code...
}
}else{

$id_client=\app\model\sql\generaltables::ajout_static(array(
"cas"=>" nom,email,telephone ",
"valeur"=>" '$nom','$email','$telephone' ",
),"client_21",$params["serveur"]);
}
return $id_client;


}

public function new_help_desk_api(array $params ){


$casdivchat=$nom=$email=$telephone="";
$begintalk=0;
$hide_form_tchat=$hide_tchat=$hide_form_new=  $reponse =$id_client_helpdesk="";
if($params["id_session"]!="" ){
$nom=$email=$telephone="";
$l_user=\app\model\sql\generaltables::info_static( $params["id_session"],"id","client_21",$params["serveur"]);
if(isset($l_user["id"])) {
$nom=$l_user["nom"];
$email=$l_user["email"];
$telephone=$l_user["telephone"];
$id_client_helpdesk=$l_user["id"];
  }
}
if($id_client_helpdesk==""){
$hide_tchat="hide";$hide_form_tchat="hide";
}else{
$begintalk=1;
$hide_form_new="hide";
$casdivchat='active';
}

$l_callcenter=\app\model\sql\generaltables::info_static("1","id","callcenter_21",$params["serveur"]);



$reponse .= '  <div class="small-chat-box-helpdesk fadeInRight-helpdesk animated-helpdesk '.$casdivchat.'">
<input type="hidden" name="begintalk" id="begintalkhelpdesk" value="'.$begintalk.'">
<input type="hidden" id="idsessionhelpdesk" value="'.$params["id_session"].'">

<div class="heading-helpdesk" draggable="true" >
 <small class="chat-date-helpdesk pull-right-helpdesk small-helpdesk">
               '.date("d-m-Y").'                      </small> '.$l_callcenter["nom"].'
</div>

<div class="content-helpdesk">';

$reponse .='<div id="loading_help_desk" class="hide"> Chargement... </div>';
$reponse .='<div id="form_new_user_help_desk" class="'.$hide_form_new.'"><form id="new_request_helpdesk" >
<input type="text" name="nomprenomhelpdesk" id="nomprenomhelpdesk" value="'.$nom.'" placeholder="Nom et Prenom" class="form-control2-helpdesk"><br>
<input type="email" name="emailhelpdesk" id="emailhelpdesk" value="'.$email.'" placeholder="Email" class="form-control2-helpdesk" required><br>
<input type="text" name="telephonehelpdesk" id="telephonehelpdesk" value="'.$telephone.'" placeholder="telephone" class="form-control2-helpdesk" required><br>
<div class="" align="center">
<button type="submit" name="button" class="btn btn-primary-helpdesk">Ecrire</button>
</div>
</form></div>';
$reponse .='<div id="tchat_help_desk" class="'.$hide_tchat.'" style="height: 243px;  overflow: auto;  margin: -10px -10px;"> </div>';

$reponse .='    </div>
<div class="form-chat-helpdesk '.$hide_form_tchat.' " id="div_form_chat_helpdesk">
<form id="add_blab_helpdesk" >
 <div class="input-group-helpdesk input-group-sm">
     <input type="text" class="form-control-helpdesk" id="rep_helpdesk">
     <span class="input-group-btn-helpdesk"> <button
                     class="btn btn-primary-helpdesk button-helpdesk"  type="submit">Envoyez</button> </span></div>
</div>
</form>
</div>
<div id="small-chat-helpdesk">


<a class="open-small-chat-helpdesk">
 <i class="fa fa-comments"></i> '.$l_callcenter["telephone"].'
</a>
</div>
';
return $reponse;
}


}

?>
