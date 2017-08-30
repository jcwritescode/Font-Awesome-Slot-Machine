<?php
  require('slots.inc.php');
  $charsObject = new RandomCharGenerator;
  $pull = 1;

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
             // Even though nothing the user types the DB, still escaping here for practice/future expansion
             $databaseObject = new Db;
             $wager = $databaseObject->quote($_POST['wager']);

             // Connect to DB and get users current credit amount
             $result = $databaseObject->select("SELECT `credits` FROM `slotsdb` WHERE `userNum` = $user");
             $credits = $result["credits"];

         // Need to move this logic out of here and into a class
         if (strtolower($wager) == "cheat" && $credits <= 10000):
           $newCredits = $credits + 1000;
           $databaseObject->query("UPDATE `slotsdb` SET `credits`=$newCredits WHERE `userNum`=$user");
           $pull = 0;
           echo '<div class="win">1000 Credits added (Max 10k Credits). You now have ' . $newCredits . " Credits.</div>";
         elseif ($wager <= 0):
           $pull = 0;
           echo '<div class="lost">LOL you cant wager less than 1 credit. Input a wager</div>';
         elseif ($wager > $credits):
           $pull = 0;
           echo '<div class="lost">Sorry, you do not have enough credits. You currently have ' . $credits . " credits</div>";
         else:
               if ($charsObject->outcome == 4):
                 $newCredits = $credits + 500;
                 $databaseObject->query("UPDATE `slotsdb` SET `credits`=$newCredits WHERE `userNum`=$user");
                 echo '<div class="win">YOU WON THE JACKPOT! You won 500 Credits and now have ' . $newCredits . " Credits. Congrats!</div>";
              elseif ($charsObject->outcome == 3):
                  $newCredits = $credits + $wager;
                  $databaseObject->query("UPDATE `slotsdb` SET `credits`=$newCredits WHERE `userNum`=$user");
                  echo '<div class="win">You won ' . $wager . ' credits and now have ' . $newCredits . " Credits. Congrats!</div>";
              elseif ($charsObject->outcome == 2):
                  $newCredits = $credits + ($wager * 2);
                  $databaseObject->query("UPDATE `slotsdb` SET `credits`=$newCredits WHERE `userNum`=$user");
                  echo '<div class="win">You won
                   ' . $wager * 2 . ' credits and now have ' . $newCredits . " Credits. Congrats!</div>";
              elseif ($charsObject->outcome == 1):
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

// "load" results - css fade? - https://www.google.com/search?rlz=1C1CHBF_enUS746US746&q=css+change+image+after+time&oq=css+change+image+after+time&gs_l=psy-ab.3..0i22i30k1.1870.3981.0.4125.11.11.0.0.0.0.96.767.11.11.0....0...1.1.64.psy-ab..0.11.766...0j33i22i29i30k1j0i13i30k1j33i21k1.gAtyLAsS-Zw

      ?>
      <p></p>

      <div class="slotmachine">
        &nbsp;[<i class="fa fa-align-justify fa-fw"></i><i class="fa fa-align-justify fa-fw"></i><i class="fa fa-align-justify fa-fw"></i>]&nbsp;<span class="handle"><a href="javascript: submitform()">O</a></span>
        <br/>&nbsp;[<?php echo $charsObject->randomizer() . $charsObject->randomizer() . $charsObject->randomizer(); ?>]&nbsp;<span class="handle"><a href="javascript: submitform()">|</a></span>
        <br/>><span id="results">[<?php echo ($pull == 0) ? $charsObject->noPull : $charsObject->luck; ?>]</span>]<span class="handle"><a href="javascript: submitform()">]</a></span>
        <br/>&nbsp;[<?php echo $charsObject->randomizer() . $charsObject->randomizer() . $charsObject->randomizer(); ?>]
        <br/>&nbsp;[<i class="fa fa-align-justify fa-fw"></i><i class="fa fa-align-justify fa-fw"></i><i class="fa fa-align-justify fa-fw"></i>]
      </div>

      <form id="wager" action="machine.php" method="post">
        <div class="msg">What's your wager?&nbsp; <input type="text" size="24" name="wager" autofocus="autofocus"><span class="credits"> Credits</span>
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
        <i class="fa fa-money fa-fw"></i><i class="fa fa-money fa-fw"></i><i class="fa fa-money fa-fw"></i>= Double Your Wager<br/>
        <i class="fa fa-diamond fa-fw"></i><i class="fa fa-diamond fa-fw"></i><i class="fa fa-diamond fa-fw"></i>= Win Your Wager<br/>
        <i class="fa fa-thumbs-o-up fa-fw"></i><i class="fa fa-thumbs-o-up fa-fw"></i><i class="fa fa-thumbs-o-up fa-fw"></i>= Win 1 Credit
      </div>

</div>
 </div>

   <p></p>

 </body>
</html>
