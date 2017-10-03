$(document).ready(function() {

    var api_datauser = "<?php echo $this->bd; ?>";

    var id_datauser=$.cookie('id_datauser');
if (id_datauser == undefined) {
    id_datauser = "";
}

    <?php
    $rep_user="";
    $interdit=array("last_seen","","created_at","update_at","id");
    foreach(explode(",",$liste_user) as $valdep){
if(!in_array($valdep,$interdit)){
  $los=$valdep.'_datauser';
      ?>
      var <?php echo $valdep.'_datauser' ?>=$.cookie('<?php echo $valdep.'_datauser' ?>');
      if (<?php echo $los ?> == undefined) {
          <?php echo $los ?> = "";
      }
      <?php
      if($rep_user==''){
          $rep_user='modd_'.$valdep.'="+'.$los.'+"';
      }else{
            $rep_user .='&modd_'.$valdep.'="+'.$los.'+"';
      }

    }} ?>

    <?php
    $rep_session_user="";
    $interdit=array("id","id_user","","created_at","update_at","url","heuros","datos");
    foreach(explode(",",$liste_session_user) as $valdep){
if(!in_array($valdep,$interdit)){
  $los=$valdep.'_datauser';
      ?>
      var <?php echo $valdep.'_datauser' ?>=$.cookie('<?php echo $valdep.'_datauser' ?>');
      if (<?php echo $los ?> == undefined) {
          <?php echo $los ?> = "";
      }
      <?php
      if($rep_session_user==''){
          $rep_session_user='add_'.$valdep.'="+'.$los.'+"';
      }else{
            $rep_session_user .='&add_'.$valdep.'="+'.$los.'+"';
      }

    }} ?>


    $.ajax({
        type: "POST",
        url: "index.php",
        crossDomain: true,
        data: "app_id=" + api_datauser + "&id_user=" + id_datauser + "&<?php echo $rep_user; ?>&<?php echo $rep_session_user; ?>&controller=init&controllerrequest=\\\app\\\datauser\\\controller\\\sessionuserctr&classaction=oui&add_url="+location+"",
        success: function(data) {
          console.log(data);
          $.cookie('id_datauser', data);
        },
        error: function(error) {
            console.log(error);
        }
    });

});
