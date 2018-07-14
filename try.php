<?php
function mail_it($to, $subject, $body)
{
       require_once "Mail.php";
        $headers = array ('From' => "ec.smtp.test2@gmail.com",
          'To' => $to,
          'Subject' => $subject);
        $smtp = Mail::factory('smtp',
          array ('host' => "smtp.gmail.com",
            'port' => "587",
            'auth' => true,
            'username' => "ec.smtp.test2@gmail.com",
            'password' => "anandgupta"));
        $mail = $smtp->send($to, $headers, $body);
        if (PEAR::isError($mail)) {
          echo("<p>" . $mail->getMessage() . "</p>");
         } else {
          echo("<p>Message successfully sent!</p>");
       }}
mail_it("aloya.effcon@gmail.com", "visvas kar lo...", "bla bla!!");
?>
