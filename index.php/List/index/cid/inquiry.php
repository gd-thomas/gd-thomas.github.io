<?php 

header("content-type:text/html;charset=utf-8"); 

//ini_set("magic_quotes_runtime",0); 
require_once 'Lib/PHPMailer/PHPMailerAutoload.php';

try {

  $sendto = 'team-smtp@gd-thomas.jp'; // "thomas.jp@gardnerdenver.com";
  
  $mail = new PHPMailer(true); 
  $mail->IsSMTP(); // use this if hmailserver. Comment this if postfix.
//  $mail->IsSendmail(); // use this if postfix. Comment this if there is no sendmail. Without this, $mail->Send() always fails.
  $mail->CharSet='UTF-8'; //设置邮件的字符编码，这很重要，不然中文乱码
  $mail->SMTPAuth = true; //开启认证
  $mail->SMTPSecure = 'ssl';
  $mail->Port = 465; 
  $mail->Host = 'smtp.exmail.qq.com'; // // 'smtp.exmail.qq.com';
  $mail->Username = 'team-smtp@gd-thomas.jp'; // // 'team-smtp@gd-thomas.jp'; 
  $mail->Password = 'WX4denver'; // // 'WX4denver';
  $mail->AddReplyTo($_REQUEST['email'], $_REQUEST['customerName']);//回复地址
  $mail->From = $_REQUEST['email'];
  $mail->FromName = $_REQUEST['customerName']; 
  $mail->AddAddress($sendto); 
  $mail->Subject = "Customer Inquiry";
  $mail->WordWrap = 80; //设置每行字符串的长度
  $mail->IsHTML(true); 
  $mail->Body = '<table border="1">'.
    '<tr><td>Product: </td><td>'.$_REQUEST['product'].'</td></tr>'.
    '<tr><td>Request: </td><td>'.$_REQUEST['request'].'</td></tr>'.
    '<tr><td>Company: </td><td>'.$_REQUEST['company'].'</td></tr>'.
    '<tr><td>Department: </td><td>'.$_REQUEST['department'].'</td></tr>'.
    '<tr><td>Job Title: </td><td>'.$_REQUEST['jobtitle'].'</td></tr>'.
    '<tr><td>Name: </td><td>'.$_REQUEST['customerName'].'</td></tr>'.
    '<tr><td>Postal Code: </td><td>'.$_REQUEST['postalCode'].'</td></tr>'.
    '<tr><td>Prefecture: </td><td>'.$_REQUEST['prefecture'].'</td></tr>'.
    '<tr><td>Address: </td><td>'.$_REQUEST['address'].'</td></tr>'.
    '<tr><td>Phone: </td><td>'.$_REQUEST['phone'].'</td></tr>'.
    '<tr><td>Email: </td><td>'.$_REQUEST['email'].'</td></tr>'.
    '<tr><td>Message: </td><td>'.$_REQUEST['message'].'</td></tr>'.
    '</table>'; 
  $mail->AltBody = 'Product:'.$_REQUEST['product'].'\n'.
    'Request: '.$_REQUEST['request'].'\n'.
    'Company: '.$_REQUEST['company'].'\n'.
    'Department: '.$_REQUEST['department'].'\n'.
    'Job Title: '.$_REQUEST['jobtitle'].'\n'.
    'Name: '.$_REQUEST['customerName'].'\n'.
    'Postal Code: '.$_REQUEST['postalCode'].'\n'.
    'Prefecture: '.$_REQUEST['prefecture'].'\n'.
    'Address: '.$_REQUEST['address'].'\n'.
    'Phone: '.$_REQUEST['phone'].'\n'.
    'Email: '.$_REQUEST['email'].'\n'.
    'Message: '.$_REQUEST['message'];
    $status = $mail->Send();
    if ($status){
    echo "<script>alert('Message sent successfully.');history.go(-1);</script>";
  }else{
    echo "<script>alert('Message failed to send. Please try again later.');history.go(-1);</script>";
  }
} catch (phpmailerException $e) { 
  echo "<script>alert('Exception happened while sending message. Please try again later.');   history.go(-1);</script>"; 
} 

?> 