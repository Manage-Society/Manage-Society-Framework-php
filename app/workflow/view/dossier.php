<?php
echo $app->html->form_new("create_dossier","\app\workflow\controller\dossierctr","","oui");
 ?>
<input type="hidden" name="id_dossier" value="<?php echo $data["info_dossier"]["id"] ?>">

 <div class="">
   <label for="">Nom du dossier</label>
   <input type="text" name="moddossier_nom" value="<?php echo $data["info_dossier"]["nom"] ?>">
 </div>

 <div class="">
   <label for="">Description</label>
   <input type="text" name="moddossier_description" value="<?php echo $data["info_dossier"]["description"] ?>">
 </div>
<br><br>
<table class="table" border="1" style="width:80%">
  <thead>
    <tr>
      <th>Description</th>
      <th></th>
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
          <input type="hidden" name="idtransac_<?php echo $i; ?>" value="<?php echo $valdep["id"] ?>">
          <input type="text" name="modtransac_<?php echo $i; ?>_nom" value="<?php echo $valdep["nom"] ?>">
        </td>
        <td>
          <select class="" name="modtransac_<?php echo $i; ?>_typos">
            <option value="" ></option>
            <option value="1"  <?php if($valdep["typos"]=="1") echo "selected"; ?>>Date</option>
            <option value="2"  <?php if($valdep["typos"]=="2") echo "selected"; ?>>Texte</option>
            <option value="3"  <?php if($valdep["typos"]=="3") echo "selected"; ?>>Zone de texte</option>
            <option value="4"  <?php if($valdep["typos"]=="4") echo "selected"; ?>>Fichier</option>
          </select>
        </td>
      </tr>
    <?php $i++;} ?>

    <?php $i=1; while($i<15){ ?>
      <tr>
        <td>
          <input type="text" name="addtransac_<?php echo $i; ?>_nom" value="">
        </td>
        <td>
          <select class="" name="addtransac_<?php echo $i; ?>_typos">
            <option value=""></option>
            <option value="1">Date</option>
            <option value="2">Texte</option>
            <option value="3">Zone de texte</option>
            <option value="4">Fichier</option>
          </select>
        </td>
      </tr>
    <?php $i++;} ?>
  </tbody>
</table>

<input type="submit" name="" value="Modifier">

 <?php
echo $app->html->endform();
  ?>
