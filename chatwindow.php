<?php
session_start();

if(isset($_GET['logout'])){
$fp1 = fopen("/Library/WebServer/Documents/Coen276/".$_GET['sender']."/".$_GET['receiver'].".html", 'a');
fwrite($fp1, "<div class='msgln'><i>User ". $_GET['sender'] ." has left the chat session.</i><br></div>");
fclose($fp1);
$fp2=fopen("/Library/WebServer/Documents/Coen276/".$_GET['receiver']."/".$_GET['sender'].".html", 'a');
fwrite($fp2, "<div class='msgln'><i>User ". $_GET['sender'] ." has left the chat session.</i><br></div>");
fclose($fp2);

echo  "<script type='text/javascript'>";
echo "window.close();";
echo "</script>";
//session_destroy();

}
?>


<!DOCTYPE html>
<html>
<head>
<title>chat</title>
<link type="text/css" rel="stylesheet" href="style.css" />
</head>

<body>


<div id="wrapper">
<div id="menu">
<p class="welcome">Welcome, <b><?php echo $_GET['sender']; ?></b>You are chatting with,<b><?php echo $_GET['receiver']; ?></b> </p>
<p class="logout"><a id="exit" href="#">Exit Chat</a></p>
<div style="clear:both"></div>
</div>

<div id="chatbox"></div>
<?php

echo $_GET['sender'];
echo $_GET['receiver'];
if(!is_dir('/Library/WebServer/Documents/Coen276/'.$_GET['sender']))
{
	mkdir("/Library/WebServer/Documents/Coen276/".$_GET['sender'], 0755);
}
$fp = fopen("/Library/WebServer/Documents/Coen276/".$_GET['sender']."/".$_GET['receiver'].".html", 'a');

if(!is_dir('/Library/WebServer/Documents/Coen276/'.$_GET['receiver']))
{
	mkdir("/Library/WebServer/Documents/Coen276/".$_GET['receiver'], 0755);
}
$fp = fopen("/Library/WebServer/Documents/Coen276/".$_GET['receiver']."/".$_GET['sender'].".html", 'a');


?>

<form name="message" action="">
<input name="usermsg" type="text" id="usermsg" size="63" />
<input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
</form>
</div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js">
</script>

<script type="text/javascript">

$(document).ready(function(){
  
   $("#exit").click(function(){
       var exit = confirm("Are you sure you want to end the session?");
       if(exit==true){window.location = 'chatwindow.php?logout=true&sender=<?php echo $_GET['sender'] ?>&receiver=<?php echo $_GET['receiver'] ?>';}
       //if(exit==true){window.location = 'index.php?logout=true';}
   });


   $("#submitmsg").click(function(){
      var clientmsg = $("#usermsg").val();
      var userend="<?php echo $_GET['sender']?>";
      var receiverend="<?php echo $_GET['receiver'] ?>";
      $.post("postinfiles.php", {text: clientmsg, sender: userend, receiver: receiverend});
      $("#usermsg").attr("value", "");
      return false;
   });
   
   setInterval (loadLog, 2500);
                              


function loadLog(){
    var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20;

    $.ajax({ url:"<?php echo $_GET['receiver'] ?>"+"/"+"<?php echo $_GET['sender']?>"+".html",
             cache: false,
             success: function(html){
                $("#chatbox").html(html);
                var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20;
                if(newscrollHeight > oldscrollHeight){
                    $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); 
                }
             },
    });
}
});
</script>




</body>
</html>