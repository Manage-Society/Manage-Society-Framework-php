<?php echo $app->html->form_new("commande","\app\\ecom\controller\commandectr","","oui"); ?>
<input type="text" name="add_nom" value="" placeholder="Nom">
<input type="text" name="add_telephone" value="" placeholder="Telephone">
<input type="text" name="add_adresse" value="" placeholder="Adresse">
<input type="hidden" name="add_id_produit" value="<?php echo $_GET["id_prod"]; ?>">
<input type="submit" name="" value="Commander">
<?php echo $app->html->endform(); ?>
