<?php
$subject = 'Dit is de titel van het test bericht';
$email = 'Dit is de inhoud van het test bericht';
$to = 'mark.kors@gmail.com';
$from = 'mark@markkors.nl';
$headers   = array();
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-type: text/plain; charset=iso-8859-1";
$headers[] = "From: Mark Kors <{$from}>";
$headers[] = "Reply-To: Mark Kors <{$from}>";
$headers[] = "Subject: {$subject}";
$headers[] = "X-Mailer: PHP/".phpversion();
mail($to, $subject, $email, implode("\r\n", $headers), "-f".$from );

?>