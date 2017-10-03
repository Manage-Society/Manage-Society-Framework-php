<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Admin</title>
    <script src="app\core\vendor\bootstrap_v_3_3_7\js\jquery.min.js"></script>
  <script src="app\core\vendor\bootstrap_v_3_3_7\js\bootstrap.js"></script>
    <script src="vendor\js\jquery.form.js"></script>
   <link rel="stylesheet" href="app\core\vendor\bootstrap_v_3_3_7\css\bootstrap.css">
  </head>
  <body>
    <h3>Bienvenue sur la page ADMIN</h3>
    <button class="btn btn-primary" data-toggle="modal" data-target="#addvariable">Creer une variable</button>
    <?php echo $html->form_new("create_js","\app\datauser\controller\sessionuserctr","","oui"); ?>
    <input type="submit" name="" value="Creer un fichier JS ">
    <?php echo $html->endform(); ?>
<div class="row container">

  <div class="col-md-6">
    <?php echo $html->form_new("stat","\app\datauser\controller\sessionuserctr","","oui"); ?>
<fieldset>
  <legend>Utilisateur</legend>
  <?php
  $champ_user="";
  $interdit_user=array("id","","last_seen","update_at","id_user_client");
   $class_user= new \app\datauser\model\user();
  $liste_user=$class_user->list_champ_table();
  foreach(explode(",",$liste_user) as $valdep){
    if(!in_array($valdep,$interdit_user)){
      $champ_user.=','.$valdep;
   ?>
   <div>

     <table class="table" border="1">

       <tbody>
         <tr>
           <td><?php echo $valdep ?></td>
           <td> <select class="" name="select_user_<?php echo $valdep ?>" az="<?php echo $valdep ?>">
             <option value="" selected=""></option>
             <option value="=">Egal</option>
             <option value="like">Comme</option>
             <option value=">">Superieur</option>
             <option value="<">Inferieur</option>
           </select> </td>
           <td><input type="text" name="reponse_user_<?php echo $valdep ?>" value=""></td>
         </tr>
       </tbody>
     </table>
   </div>

   <?php }} ?>
</fieldset><br><br>
<input type="hidden" name="champ_user" value="<?php echo $champ_user ?>">
<fieldset>
  <legend>AND</legend>
  <?php
  $champ_session="";
  $interdit_session_user=array("id","","id_user","update_at","created_at");
   $class_session_user= new \app\datauser\model\session_user();
  $liste_session_user=$class_session_user->list_champ_table();
  foreach(explode(",",$liste_session_user) as $valdep){
    if(!in_array($valdep,$interdit_session_user)){
      $champ_session.=",".$valdep;
   ?>
   <div>

     <table class="table" border="1">

       <tbody>
         <tr>
           <td><?php echo $valdep ?></td>
           <td> <select class="" name="select_session_<?php echo $valdep ?>" az="<?php echo $valdep ?>">
             <option value="" selected=""></option>
             <option value="=">Egal</option>
             <option value="like">Comme</option>
             <option value=">">Superieur</option>
             <option value="<">Inferieur</option>
           </select> </td>
           <td><input type="text" name="reponse_session_<?php echo $valdep ?>" value=""></td>
         </tr>
       </tbody>
     </table>
   </div>

   <?php }} ?>
</fieldset>
<input type="hidden" name="champ_session" value="<?php echo $champ_session ?>">
<input type="submit" name="" value="Recherche">
<?php echo $html->endform(); ?>
  </div>

  <div class="col-md-6" id="reponse_req">

  </div>

</div>
<?php
echo $html->ajax_form("stat","",' $("#reponse_req").html(data); ');
 ?>

<div class="modal fade" id="addvariable">
  <?php echo $html->form_new("add_variable","\app\datauser\controller\sessionuserctr","","oui") ?>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title">Ajoute une variable</h4>
      </div>
      <div class="modal-body">
      <input type="text" name="parametre" value="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
  <?php echo $html->endform(); ?>
</div><!-- /.modal -->
  </body>
</html>
