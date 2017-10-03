<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title></title>



    <!-- Animation CSS -->



</head>

<body>
    <h1>Hello, world!</h1>
<?php
setcookie('info_user', "amoursd", time() + (86400 * 30*30*12));

var_dump($_SERVER);



 ?>


<div class="" id="reponse_header">

</div>
    <link rel="stylesheet" href="help-desk.css">
     <script src="help-desk.max.js" charset="utf-8"></script>
     <script src="ok.js" charset="utf-8"></script>

     <script >
       $(document).ready(function() {
// alert(location);



        var socas = $.cookie("info_user");
     alert(socas);

       });

     </script>

    <div id="help-desk-123456" nomserveur="ms.tech2i">
    </div>

</body>

</html>
