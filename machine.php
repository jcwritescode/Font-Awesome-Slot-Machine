<?php
require('slots.inc.php');
$charsObject = new RandomCharGenerator;
?>

<!DOCTYPE html>
<html>

 <head>
    <meta charset="UTF-8">
    <title>Font Awesome Slot Machine - OOP PHP Project</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Mono:400,500|Roboto:400,500" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <script type="text/javascript">
         function submitform() {
         document.forms["wager"].submit();
         }
    </script>
  </head>

 <body>

   <h1>Font Awesome Slot Machine</h1>

    <div class="msg">How many Credits would you like to wager?
      <form id="wager" action="#" method="post">
        <input type="text" size="20" name="wager"><span class="credits"> Credits</span>

  <!-- Thinking to use Font Awesome animated icons before random chars load -->

   <div class="blah">
      &nbsp;[<i class="fa fa-align-justify fa-fw"></i><i class="fa fa-align-justify fa-fw"></i><i class="fa fa-align-justify fa-fw"></i>]&nbsp;<span class="handle"><a href="javascript: submitform()">O</a></span>
      <br/>&nbsp;[<?php echo $charsObject->randomizer() . $charsObject->randomizer() . $charsObject->randomizer(); ?>]&nbsp;<span class="handle"><a href="javascript: submitform()">|</a></span>
      <br/>><span id="results">[<?php echo $charsObject->luck; ?>]</span>]<span class="handle"><a href="javascript: submitform()">]</a></span>
      <br/>&nbsp;[<?php echo $charsObject->randomizer() . $charsObject->randomizer() . $charsObject->randomizer(); ?>]
      <br/>&nbsp;[<i class="fa fa-align-justify fa-fw"></i><i class="fa fa-align-justify fa-fw"></i><i class="fa fa-align-justify fa-fw"></i>]
    </div>

  </form>
</div>

<?php
 // What is the best way to get stuff from DB and use as string?
 // Want just credits - best way to get it back?

   // Get user # from cookie
   if (isset($_COOKIE['user'])) {
     $user = $_COOKIE['user'];
     // Get users wager amount
     if (isset($_POST['wager'])) {
       $wager = $_POST['wager'];
       // Connect to DB and get users current credit amount
       $databaseObject = new Db;

       $result = $databaseObject->select("SELECT `credits` FROM `slotsdb` WHERE `userNum` = $user");
       $credits = $result["credits"];

       if ($wager > $credits):
         echo '<div class="lost">Sorry, you do not have enough credits. You currently have ' . $credits . " credits";
       elseif ($wager == 0):
         echo '<div class="lost">LOL, you cant wager 0 credits - Input a wager';
       else:
         if ($charsObject->outcome == "YOU WIN!") {
           $newCredits = $credits + $wager;
           $databaseObject->query("UPDATE `slotsdb` SET `credits`=$newCredits WHERE `userNum`=$user");
           echo '<div class="win">YOU WON ' . $wager . " Credits! You now have " . $newCredits . " Credits. Congrats!";
         } else {
           $newCredits = $credits - $wager;
           $databaseObject->query("UPDATE `slotsdb` SET `credits`=$newCredits WHERE `userNum`=$user");
           echo '<div class="lost">You Lost ' . $wager . " Credits. You now have " . $newCredits . " Credits";
         }
         endif;
     }
   }

 ?>
   </div>
   <p></p>

 </body>

</html>
