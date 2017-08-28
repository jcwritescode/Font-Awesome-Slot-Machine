<?php
  require('slots.inc.php');
  $charsObject = new RandomCharGenerator;

  // HTML doc head
  $headObject = new Header;
  echo $headObject->htmlHead;
?>

<body>
  <div class="timeline-small">
    <div class="inner">
      <h1>Font Awesome Slot Machine</h1>

      <?php

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

         // Need to move this logic out of here and into a class
         if ($wager == "CHEAT"):
           $newCredits = $credits + 1000;
           $databaseObject->query("UPDATE `slotsdb` SET `credits`=$newCredits WHERE `userNum`=$user");
           echo '<div class="win">1000 Credits have been added. You now have ' . $newCredits . " Credits.</div>";
         elseif ($wager <= 0):
           echo '<div class="lost">LOL you cant wager less than 1 credit. Input a wager</div>';
         elseif ($wager > $credits):
           echo '<div class="lost">Sorry, you do not have enough credits. You currently have ' . $credits . " credits</div>";
         else:
               if ($charsObject->outcome == "win"):
                 $newCredits = $credits + 500;
                 $databaseObject->query("UPDATE `slotsdb` SET `credits`=$newCredits WHERE `userNum`=$user");
                 echo '<div class="win">YOU WON THE JACKPOT! You won 500 Credits and now have ' . $newCredits . " Credits. Congrats!</div>";
              elseif ($charsObject->outcome == "wager"):
                  $newCredits = $credits + $wager;
                  $databaseObject->query("UPDATE `slotsdb` SET `credits`=$newCredits WHERE `userNum`=$user");
                  echo '<div class="win">You won ' . $wager . ' credits and now have ' . $newCredits . " Credits. Congrats!</div>";
              elseif ($charsObject->outcome == "one"):
                  $newCredits = $credits + 1;
                  $databaseObject->query("UPDATE `slotsdb` SET `credits`=$newCredits WHERE `userNum`=$user");
                  echo '<div class="win">You won 1 credit and now have ' . $newCredits . " Credits.</div>";
              else:
                 $newCredits = $credits - $wager;
                 $databaseObject->query("UPDATE `slotsdb` SET `credits`=$newCredits WHERE `userNum`=$user");
                 echo '<div class="lost">You Lost ' . $wager . " Credits. You now have " . $newCredits . " Credits</div>";
              endif;
          endif;
               }
         }
      ?>
      <p></p>

      <div class="slotmachine">
        &nbsp;[<i class="fa fa-align-justify fa-fw"></i><i class="fa fa-align-justify fa-fw"></i><i class="fa fa-align-justify fa-fw"></i>]&nbsp;<span class="handle"><a href="javascript: submitform()">O</a></span>
        <br/>&nbsp;[<?php echo $charsObject->randomizer() . $charsObject->randomizer() . $charsObject->randomizer(); ?>]&nbsp;<span class="handle"><a href="javascript: submitform()">|</a></span>
        <br/>><span id="results">[<?php echo $charsObject->luck; ?>]</span>]<span class="handle"><a href="javascript: submitform()">]</a></span>
        <br/>&nbsp;[<?php echo $charsObject->randomizer() . $charsObject->randomizer() . $charsObject->randomizer(); ?>]
        <br/>&nbsp;[<i class="fa fa-align-justify fa-fw"></i><i class="fa fa-align-justify fa-fw"></i><i class="fa fa-align-justify fa-fw"></i>]
      </div>

      <form id="wager" action="machine.php" method="post">
        <div class="msg">What's your wager?&nbsp; <input type="text" size="24" name="wager"><span class="credits"> Credits</span>
        </div>
      </form>
      <p></p>

      <h1></h1>
      <div class="instructions">
        <div class="important">How To Play:</div><br/>
        Enter the amount of credits you would like to wager, then pull the blue handle (click) to try your luck.
      <p></p>
        <div class="important">Payouts:</div><br/>
        <i class="fa fa-usd fa-fw"></i><i class="fa fa-usd fa-fw"></i><i class="fa fa-usd fa-fw"></i>= 500 Credit Jackpot<br/>
        <i class="fa fa-diamond fa-fw"></i><i class="fa fa-diamond fa-fw"></i><i class="fa fa-diamond fa-fw"></i>= Win Your Wager<br/>
        <i class="fa fa-thumbs-o-up fa-fw"></i><i class="fa fa-thumbs-o-up fa-fw"></i><i class="fa fa-thumbs-o-up fa-fw"></i>= Win 1 Credit
      </div>

</div>
 </div>

   <p></p>

 </body>
</html>
