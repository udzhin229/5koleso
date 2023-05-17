<?php
ini_set( 'display_errors', 1);
error_reporting( E_ALL );
$from = "info.nexonstudio@nexon-studio.com";
$to = "mijek200311@gmail.com";
$subject = "Checking PHP mail";
$message = "PHP mail works";
$headers = "From" . $from;
mail($to,$subject,$message,$headers);
echo "The email mess was sent";
?>