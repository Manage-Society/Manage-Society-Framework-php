<?php
namespace core\model;

/**
 * Crypte une variable
 */
class crypte{

/**
 * Crypte une information
 * @param  [type] $maCleDeCryptage  [description]
 * @param  [type] $maChaineACrypter [description]
 * @return [type]                   [description]
 */
  public function cryptos($maCleDeCryptage=null, $maChaineACrypter){

  if(isset($GLOBALS['PHPSESSID'])) if($maCleDeCryptage==""){
  $maCleDeCryptage=$GLOBALS['PHPSESSID'];
  }

  $maCleDeCryptage = md5($maCleDeCryptage);

  $letter = -1;
  $newstr = '';
  $strlen = strlen($maChaineACrypter);
  for($i = 0; $i < $strlen; $i++ ){
  $letter++;
  if ( $letter > 31 ){
  $letter = 0;
  }
  $neword = ord($maChaineACrypter{$i}) + ord($maCleDeCryptage{$letter});
  if ( $neword > 255 ){
  $neword -= 256;
  }
  $newstr .= chr($neword);
  }
  return base64_encode($newstr);
  }

  public function decryptos($maCleDeCryptage="", $maChaineCrypter){
  if($maCleDeCryptage==""){
  $maCleDeCryptage=$GLOBALS['PHPSESSID'];
  }
  $maCleDeCryptage = md5($maCleDeCryptage);
  $letter = -1;
  $newstr = '';
  $maChaineCrypter = base64_decode($maChaineCrypter);
  $strlen = strlen($maChaineCrypter);
  for ( $i = 0; $i < $strlen; $i++ ){
  $letter++;
  if ( $letter > 31 ){
  $letter = 0;
  }
  $neword = ord($maChaineCrypter{$i}) - ord($maCleDeCryptage{$letter});
  if ( $neword < 1 ){
  $neword += 256;
  }
  $newstr .= chr($neword);
  }
  return $newstr;
  }

  public function cryptevariable($maCleDeCryptage,$maChaineACrypter){

    return $this->cryptos($maCleDeCryptage,$maChaineACrypter);
  }
  public function decryptervariable($maCleDeCryptage,$machaineCrypter){
  return $this->decryptos($maCleDeCryptage,$machaineCrypter);
  }

}


 ?>
