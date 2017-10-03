<?php
echo $app->html->form_new("add_data","\app\workflow\controller\histoctr","","oui");
 ?>
<input type="hidden" name="id_dossier" value="<?php echo $data["info_dossier"]["id"] ?>">

 <div class="">
   <label for="">Nom du dossier:</label>
<?php echo $data["info_dossier"]["nom"] ?>
 </div>

 <div class="">
   <label for="">Description:</label>
  <?php echo $data["info_dossier"]["description"] ?>
 </div>
<br><br>
<table class="table" border="1" style="width:80%">
  <thead>
    <tr>
      <th>Description</th>
      <th>Type</th>
    </tr>
  </thead>
  <tbody>
<input type="hidden" name="nbr_transac" value="<?php echo $data["nbr_transac"] ?>">

    <?php
    $i=1;
    foreach($data["info_transac"] as $valdep){
       ?>
      <tr>
        <td>
          <input type="hidden" name="addtransac_<?php echo $i; ?>_id_transac" value="<?php echo $valdep["id"] ?>">
            <input type="hidden" name="addtransac_<?php echo $i; ?>_id_dossier" value="<?php echo $data["info_dossier"]["id"] ?>">
          <?php echo $valdep["nom"] ?>
        </td>
        <td>
          <input type="text" name="addtransac_<?php echo $i; ?>_val" value="">
        </td>
      </tr>
    <?php $i++;} ?>

  </tbody>
</table>

<input type="submit" name="" value="Modifier">

 <?php
echo $app->html->endform();
  ?>
