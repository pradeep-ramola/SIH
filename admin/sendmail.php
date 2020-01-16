<?php
  use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

 require 'vendor/autoload.php';

 $finalLink = "";
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["attachment"]["name"]);
$uploadOk = 1;

 
 if ($_FILES["attachment"]["size"] == 0) {
    echo "Sorry, your file is surprisingly unnecessarily small.";
    $uploadOk = 0;
}
 if ($_FILES["attachment"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
 if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
 } else {
    if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["attachment"]["name"]). " has been uploaded.";
        $finalLink = $target_file; 
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

 $emailList = explode(";", $_POST['email']);
$emailCount = count($emailList);
//cc
$ccEmailList = explode(";", $_POST['cc']);
$ccEmailCount = count($ccEmailList);
//subject
$subject = $_POST['subject'];
//body
// $result = $_POST['body'];
// $body = nl2br(str_replace(' ', '&nbsp;', $result));

$body =$_POST['body'];




$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'aditya119sharma@gmail.com';                 // SMTP username
    $mail->Password = 'rtauouydzcsgilgc';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

     $mail->setFrom('aditya119sharma-@gmial.com', 'Aditya');
     
    for ($i=0; $i < $emailCount; $i++) { 
    	$mail->addAddress($emailList[$i]);
    }

    if(!empty($_POST['cc'])){
     for ($i=0; $i < $ccEmailCount; $i++) { 
    	$mail->addCC($ccEmailList[$i]);
    }
}

     if($uploadOk == 1 and !empty($_FILES['attachment'])){
        $mail->addAttachment($finalLink);
    }

    $mail->addReplyTo('akhil.infinite@live.in', 'Akhil');

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}


 header("location:mail.php");
?>
