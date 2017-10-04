<?php if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }
//   $mysqli = new mysqli($_SESSION["ip_bd"], $_SESSION["bd_username"], $_SESSION["bd_psswd"]);
// //$wordbud = mysqli_connect($_SESSION["ip_bd"],$_SESSION["bd_username"],$_SESSION["bd_psswd"],"");
// //  $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($wordbud,$theValue) : mysqli_escape_string($wordbud,$theValue);
//   $theValue = $mysqli->real_escape_string(  $theValue);
//   //$theValue= str_replace("'", "\'", $theValue);
// 
//   switch ($theType) {
//     case "text":
//       $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
//       break;
//     case "long":
//     case "int":
//       $theValue = ($theValue != "") ? intval($theValue) : "NULL";
//       break;
//     case "double":
//       $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
//       break;
//     case "date":
//       $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
//       break;
//     case "defined":
//       $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
//       break;
//   }
  return $theValue;
}

}
?>
