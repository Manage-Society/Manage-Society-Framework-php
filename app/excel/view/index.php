<?php
ob_start();
 ?>
<table class="table" border="1">
  <thead>
    <tr>
      <th>Code ménage</th>
        <th>Nom et prénom</th>
        <th>Adresse</th>
        <th>Taille</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>i LOVE TOI</td>
      <td>fsdfsdq</td>
        <td>fsdfsdqfsq</td>
        <td>fsdfsdqfsq</td>
    </tr>
    <tr>
      <td>ljhkj</td>
      <td>fCSDCSDsdfsdq</td>
        <td>fsdfsdqfsq</td>
        <td>fsdfsdqfsq</td>
    </tr>
    <tr>
      <td>ljhkj</td>
      <td>fsdfsdq</td>
        <td>fsdfsdqfsq</td>
        <td>COOOL</td>
    </tr>
    <tr>
      <td>ljhkj</td>
      <td>fsdfsdq</td>
        <td>fsdfsdqfsq</td>
        <td>fsdfsdqfsq</td>
    </tr>
  </tbody>
</table>
<?php
$table_excel=ob_get_clean();
$_SESSION["doc_imprimer_excel"]=$table_excel;
 ?>

<?php
echo $app->html->form_new("imprimer_action","\app\\excel\controller\imprimectr","","oui");
?>
<input type="submit" name="" value="IMPRIME">

<?php echo $app->html->endform(); ?>
