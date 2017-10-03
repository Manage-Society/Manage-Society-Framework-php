<div class="row wrapper border-bottom white-bg page-heading" style="
 margin-top: -15px;
">
             <div class="col-lg-10">
                 <h2>Tableau de bord</h2>

             </div>
             <div class="col-lg-2">

             </div>
         </div>
         <br>


<input type="hidden" name="" value="" id="nomsujet"> <input type="hidden" name="" value="" id="affsujet">
<div class="row" style="height:400px; overflow:auto" id="tab_recup">

</div>
<script type="text/javascript">
$(document).ready(function(){


function ajaxcall(lsuj){
  var nbr=lsuj+1-1;
  var dataos ="idsujet="+lsuj+"&controller=actusujet&controllerrequest=dev/app/21/controller/sujet.php";
  var ldiv="#repsujet"+nbr;


          $.ajax({
                        type: "POST",
                        url: "https://www.manage-society.com/index.php",

                        data: dataos,
                         success: function(data) {

                            $(ldiv).html(data);

                        },
                        error: function(error) {
                          alert("erreur");
  console.log(error);
                        }
                    });

}

 function chargement() {
     // traitement

$.ajax({
             type: "POST",
             url: "https://www.manage-society.com/index.php",

             data: "listesujet=" + $("#nomsujet").val() + "&controller=rechsujet&controllerrequest=dev/app/21/controller/sujet.php",
             success: function(data) {

data = data.replace(" ", "");
data = data.replace("\n", "");
                 $("#nomsujet").val(data);
             },
             error: function(error) {

             }
         });

         $.ajax({
                       type: "POST",
                       url: "https://www.manage-society.com/index.php",

                       data: "listesujet=" + $("#nomsujet").val() + "&affsujet="+ $("#affsujet").val() +"&controller=affichesujet&controllerrequest=dev/app/21/controller/sujet.php",
                       success: function(data) {

                           $("#tab_recup").append(data);

                       },
                       error: function(error) {

                       }
                   });

$("#affsujet").val($("#nomsujet").val());
 var lsujet =$("#nomsujet").val();
 var myArray = lsujet.split(',');

    // display the result in myDiv
    for(var i=0;i<myArray.length;i++){

        var lsuj=parseInt(myArray[i]);

      ajaxcall(lsuj);

    }



     setTimeout(chargement, 2000); /* rappel après 2 secondes = 2000 millisecondes */

 }

 chargement();

   $("body").delegate("#formaddblab", "submit", function() {
     event.preventDefault();

     $.ajax({
							 url: $( this ).attr("action"),
							 type: $( this ).attr("method"),
							 data: $( this ).serialize(),
							 success: function(data) {

							 }
					 });
           $(this)[0].reset();
     });

  });
</script>
<?php echo $ajaxcall->form("formaddblab","",""); ?>
