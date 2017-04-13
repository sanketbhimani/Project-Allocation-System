<?php
require_once('class.phpmailer.php');
//$to = $_GET['to'];
//$subject = $_GET['subject'];
//$massage = $_GET['massage'];
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug = 1;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Host = "smtp.gmail.com";
$mail->Port = 587;
$mail->IsHTML(true);
$mail->Username = "snk.bhimani.jnd@gmail.com";
$mail->Password = "SNK.bhimani3";
//$mail->SetFrom($to);
//$mail->Subject = $subject;
//$mail->Body = $message;
//$mail->AddAddress($to);
//if($mail->Send()){
//	echo "Mail has successfully sent";
// }
// else{
// echo "mail error: ".$mail->ErrorInfo;
// }

?>
