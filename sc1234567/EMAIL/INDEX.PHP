<?php
 require_once "Mail.php";
 
 $from = "<valmiki81@gmail.com>";
 $to = "<valmiki.2505@gmail.com>";
 $subject = "Hi!";
 $body = "Hi,\n\nHow are you?";
 
 $host = "ssl://smtp.gmail.com";
 $port = "465";
 $username = "valmiki81@gmail.com";
 $password = "sujata@1981";
 
 $headers = array ('From' => $from,
   'To' => $to,
   'Subject' => $subject);
   $sm = new Mail(); 
 $smtp = $sm->factory('smtp',
   array ('host' => $host,
     'port' => $port,
     'auth' => true,
     'username' => $username,
     'password' => $password));
 
 $mail = $smtp->send($to, $headers, $body);
 $pr = new PEAR();
 if ($pr->isError($mail)) {
   echo("<p>" . $mail->getMessage() . "</p>");
  } else {
   echo("<p>Message successfully sent!</p>");
  }
  /*require_once "Mail.php";
 
 $from = "Sandra Sender <valmiki81@gmail.com>";
 $to = "Ramona Recipient <valmiki.2505@gmail.com>";
 $subject = "Hi!";
 $body = "Hi,\n\nHow are you?";
 
 $host = "smtp.gmail.com";
 $username = "valmiki81@gmail.com";
 $password = "sujata@1981";
 $ms = new Mail();
 $headers = array ('From' => $from,
   'To' => $to,
   'Subject' => $subject);
 $smtp = $ms->factory('smtp',
   array ('host' => $host,
     'auth' => true,
     'username' => $username,
     'password' => $password));
 
 $mail = $smtp->send($to, $headers, $body);
 $pr = new PEAR();
 if ($pr->isError($mail)) {
   echo("<p>" . $mail->getMessage() . "</p>");
  } else {
   echo("<p>Message successfully sent!</p>");
  }*/
 ?>