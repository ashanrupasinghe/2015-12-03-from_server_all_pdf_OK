<?php
function email_helper($sender, $subject, $message, $attachment1, $attachment2)
{
//if(isset($_POST['add-device'])){		
    //Send Mail
    require 'phpMailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;

    //$mail->SMTPDebug = 3;                              // Enable verbose debug output

    $mail->isSMTP();                                     // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com'; 						 // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;

                                  // Enable SMTP authentication
    $mail->Username = 'nddcb1@gmail.com';                 // SMTP username
    $mail->Password = 'ashan!@#$%';

                     // SMTP password
    $mail->SMTPSecure = 'ssl';                           // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                   // TCP port to connect to

    $mail->From = 'nddcb1@gmail.com';
    $mail->FromName = 'National Dangerous Drug Control Board-Sri Lanka';
    $mail->addAddress($sender);     // Add a recipient
    $mail->addReplyTo('nddcb1@gmail.com', 'Support');
    //$mail->addCC('jro@ucsc.cmb.ac.lk');
    //$mail->addBCC('vsh@ucsc.cmb.ac.lk');

    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = $subject;
    $mail->Body    = $message;
    $mail->AltBody = 'ffff';
    
    if(!empty($attachment1))
    {
        $mail->addAttachment($attachment1);
    }
    
    if(!empty($attachment2))
    {
        $mail->addAttachment($attachment2);
    }

    if(!$mail->send()) {
            //echo 'Message could not be sent.';
            //echo 'Mailer Error: ' . $mail->ErrorInfo;
            return false;
    } else {
            //echo 'Message has been sent';
            return true;
    }
		
//}else{
//		$msg = "<div class='alert alert-danger' role='alert'>Error Adding Device</div>";
//}
}
?>