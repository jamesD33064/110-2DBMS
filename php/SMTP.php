<?php

if (!isset($_POST["submit"]))
  {
  ?>
  <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
  From: <input type="text" name="from"><br>
  Subject: <input type="text" name="subject"><br>
  Message: <textarea rows="10" cols="40" name="message"></textarea><br>
  <input type="submit" name="submit" value="Click To send mail">
  </form>
  <?php
  }

else

  {

  if (isset($_POST["from"]))
    {
    $from = $_POST["from"]; // sender
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    $message = wordwrap($message, 70);

    mail("james0120160379@gmail.com",$subject,$message,"From: $from\n");
    echo "Thank you for sending an email";
    }
  }
?>