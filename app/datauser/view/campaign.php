<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="app\core\vendor\bootstrap_v_3_3_7\js\jquery.min.js"></script>
  <script src="app\core\vendor\bootstrap_v_3_3_7\js\bootstrap.js"></script>
    <script src="vendor\js\jquery.form.js"></script>
   <link rel="stylesheet" href="app\core\vendor\bootstrap_v_3_3_7\css\bootstrap.css">
  </head>
  <body class="container">
      <?php echo $html->form_new("execute","\app\datauser\controller\campaignctr","","oui") ?>
      <input type="submit" name="" value="Execute ">
      <?php echo $html->endform(); ?>
  <button class="btn btn-primary" data-toggle="modal" data-target="#add_condition">Ajout une étape de condition</button>
  <div class="" id="liste_etape">
    <?php  $transac= new \app\datauser\model\transaction();
    $req=$transac->rech(array(
    "condition"=>" 	id_campaign='1' ORDER by stape DESC ",));
    if(!empty($req)) foreach($req as $valdep){
?>
<table class="table" border="1">

  <tbody>
    <tr>
      <td>Etape <?php echo $valdep["stape"] ?></td>
      <td><?php echo $valdep["description"] ?></td>
      <td>Entree:</td>
      <td>Echec:</td>
      <td>Reussi:</td>
    </tr>
  </tbody>
</table>
    <?php  } ?>

  </div>

<div class="modal fade" id="add_condition">
  <?php echo $html->form_new("condition_stape","\app\datauser\controller\campaignctr","","oui") ?>
  <input type="hidden" name="id_campaign" value="1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title">Ajout d'une condition</h4>
      </div>
      <div class="modal-body">
        <?php

        $champ_user="";
        $interdit_user=array("id","","last_seen","update_at","id_user_client");
         $class_user= new \app\datauser\model\user();
        $liste_user=$class_user->list_champ_table();
        $champ_session="";
        $interdit_session_user=array("id","","id_user","update_at","created_at");
         $class_session_user= new \app\datauser\model\session_user();
        $liste_session_user=$class_session_user->list_champ_table();

         ?>
      <table class="table" border="1">
        <tbody>
          <tr>
            <td> <select class="" name="le_champ">
<?php foreach(explode(",",$liste_user) as $valdep)
  if(!in_array($valdep,$interdit_user)){ ?>
<option value="<?php echo $valdep; ?>"><?php echo $valdep; ?></option>
<?php } ?>
<?php   foreach(explode(",",$liste_session_user) as $valdep)
    if(!in_array($valdep,$interdit_session_user)){ ?>
<option value="<?php echo $valdep; ?>">Nombre(<?php echo $valdep; ?>)</option>
<?php } ?>
            </select></td>
            <td><select class="" name="la_condition" >
              <option value="" selected=""></option>
              <option value="=">Egal</option>
              <option value="like">Comme</option>
              <option value=">">Superieur</option>
              <option value="<">Inferieur</option>
            </select></td>
            <td><input type="text" name="reponse_req" value=""></td>
          </tr>
        </tbody>
      </table>
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
