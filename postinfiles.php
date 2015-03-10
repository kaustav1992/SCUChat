<?php
session_start();

echo $_POST['text'];
echo $_POST['sender'];
echo $_POST['receiver'];

$text=$_POST['text'];
$sender=$_POST['sender'];

$fp1 = fopen("/Library/WebServer/Documents/Coen276/".$_POST['sender']."/".$_POST['receiver'].".html", 'a');
fwrite($fp1,"<div class='msgln'>(".date("g:i A").") <b>".$_POST['sender']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");

$fp2=fopen("/Library/WebServer/Documents/Coen276/".$_POST['receiver']."/".$_POST['sender'].".html", 'a');

fwrite($fp2,"<div class='msgln'>(".date("g:i A").") <b>".$_POST['sender']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");

fclose($fp1);
fclose($fp2);







?>