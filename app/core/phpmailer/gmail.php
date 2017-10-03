<?php
namespace app\core\phpmailer;

/**
 * Gere la connection à un email
 */
class gmail {

  /**
   * @var string $host [host]
   */
  private $host='smtp.gmail.com';

  /**
   * @var string $SMTPSecure [smtp secure]
   */
  private $SMTPSecure='tls';

  /**
   * @var string $port [le port]
   */
   private $port='587';

   /**
    * @var string $WordWrap [taille de mot]
    */
   private $WordWrap='50';

   /**
    * @var string $email [email]
    */
   public $email;

   /**
    * @var string $mdp [mot de passe]
    */
   public $mdp;

   /**
    * @var string $username [mot de passe]
    */
   public $username;



/**
 * Construceur
 * @param string $email [email gmail: ok@gmail.com]
 * @param string $mdp   [mdp: mot de passe]
 * @param string $username   [mdp: nom d'utilisateur]
 */
   public function __construct($email,$mdp,$username){
     if($this->email=="") $this->email=$email;
     if($this->mdp=="") $this->mdp=$mdp;
   if($this->username=="")   $this->username=$username;
     
   }

/**
 * Envoie de l'email
 * @param  array $data [les données: array("to"=>"cyri@gmail.com,cyr ok ; viny@yahoo.fr,viny ok","subject"=>"Bonjour","body"=>"Alors" )]
 * @example array("to"=>"cyri@gmail.com,cyr ok ; viny@yahoo.fr,viny ok","reply"=>"" )
 * @return [type]       [description]
 */
  public function sendemail($data){

	   $mail = new \app\core\phpmailer\phpmailer;

	   $mail->isSMTP();
    // Set mailer to use SMTP
$mail->Host = $this->host;                       // Specify main and backup server
$mail->SMTPAuth = true;                               // Enable SMTP authentication

$mail->Username = $this->email;                   // SMTP username
$mail->Password = $this->mdp;               // SMTP password
$mail->SMTPSecure = $this->SMTPSecure;                            // Enable encryption, 'ssl' also accepted
$mail->Port = $this->port;                                    //Set the SMTP port number - 587 for authenticated TLS

$mail->setFrom($this->email, $this->username);     //Set who the message is to be sent from
foreach(explode(";",$data["to"]) as $valdep){

   $pttab=explode(",",$valdep);
	if(isset($pttab[1])){
		$mail->addAddress($pttab[0],$pttab[1]);
	}else{
		$mail->addAddress($pttab[0]);
	}
}

if(1==2){
if(isset($data["reply"])) if($data["reply"]!=""){
$lreply=explode(",",$data["reply"]);

$mail->addReplyTo($lreply[0], $lreply[1]);  //Set an alternative reply-to address
}

if($addCC!="") $mail->addCC($addCC);
if($addBCC!="") $mail->addBCC($addBCC);

if($WordWrap==""){
	$mail->WordWrap = $this->WordWrap;
}else{
$mail->WordWrap = 50;
}
// Set word wrap to 50 characters
if($doc!=""){

	foreach(explode(";",$doc) as $valdep){
	$pte=explode(",",$valdep);
	if(isset($pte[1])){
		$mail->addAttachment($pte[0], $pte[1]);
	}else{
		$mail->addAttachment($pte[0]);
	}

	}


}
}
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $data["subject"];
$mail->Body    = $data["body"];
$mail->AltBody = '';
$mail->send();

if(!$mail->send()) {
  return $mail->ErrorInfo;

}else{

  return '1';
}



	}


}



?>
