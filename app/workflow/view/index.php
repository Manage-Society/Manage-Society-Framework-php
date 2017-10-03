<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="app/core/vendor/bootstrap_v_3_3_7/css/bootstrap.css" >
    <script src="app/core/vendor/jquery/jquery.min.js"></script>
    <script src="app/core/vendor/bootstrap_v_3_3_7/js/bootstrap.js"></script>
    <script src="app/vuejs/vendor/vuejs.js"></script>
  </head>
  <body>

    <div class="">
      <button class="btn btn-primary" data-toggle="modal" data-target="#addworkflow">Ajout un dossier</button>
    </div>

    <fieldset>
      <legend>Liste des dossiers</legend>

      <?php
if(isset($data["liste_dossier"])) foreach($data["liste_dossier"] as $valdep) echo $app->getmodel("dossier")->view($valdep);
       ?>

    </fieldset>

    <div class="modal fade" id="addworkflow">
      <?php echo $app->html->form_new("add_dossier","\app\workflow\controller\dossierctr","","oui"); ?>
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              <span class="sr-only">Close</span>
            </button>
            <h4 class="modal-title">Ajout du dossier</h4>
          </div>
          <div class="modal-body">
          <input type="text" name="add_nom" value="" placeholder='Nom'>
          <textarea name="add_description" placeholder='Description' rows="8" cols="80"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
      <?php echo $app->html->endform(); ?>
    </div><!-- /.modal -->


  </body>
</html>
