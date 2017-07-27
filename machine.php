<?php
require('slots.inc.php');

// OOP PHP Slots
// TESTING
$randomA1 = "%";
$randomA2 = "$";
$randomA3 = "*";
$randomB1 = "#";
$randomB2 = "$";
$randomB3 = "~";
$randomC1 = "*";
$randomC2 = "$";
$randomC3 = "&";

?>

<!DOCTYPE html>
<html>

  <head>
    <meta charset="UTF-8">
    <title>ASCII Slot Machine - OOP PHP Project</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Mono:400,500|Roboto:400,500" rel="stylesheet">
  </head>

  <body>

    <h1>Proof of concept</h1>

    <div class="creditsmsg">
  <?php
    $slotsObject = new RandomCreditGenerator;
    echo "Congrats, you have won " . $slotsObject->credits . " Credits to start with!";
    ?></div>
    <p></p>

<div class="instructions"><div class="important">Instructions:</div><br/>The ASCII Slot machine works like a regular slot machine - Enter below the amount of credits you would like to wager, then pull the handle on the machine (click) to try your luck. If you get three "$" in a row, you win the jackpot!</div>
    <div class="msg">How many Credits would you like to wager?
    <form>
      <input type="text" size="20" name="credits"><span class="credits"> Credits</span>
    </form>
  </div>
  <!-- Thinking to use Font Awesome animated icons before random chars load -->

  <!-- Hmm, so if I instantiate here, it is available anywhere after? So I should just have it at the top of the doc? -->
  <?php
    $charsObject = new RandomCharGenerator;
  ?>

    <div class="blah">
      &nbsp;[ - - - ]&nbsp;<span class="handle"><a href="/slots/machine.php">O</a></span>
      <br/>&nbsp;[<?php echo " " . $charsObject->randomizer() . " " . $charsObject->randomizer() . " " . $charsObject->randomizer() . " "; ?> ]&nbsp;<span class="handle"><a href="/slots/machine.php">|</a></span>
      <br/>><span id="results">[<?php echo $charsObject->luck; ?>]</span>]<span class="handle"><a href="/slots/machine.php">]</a></span>
      <br/>&nbsp;[<?php echo " " . $charsObject->randomizer() . " " . $charsObject->randomizer() . " " . $charsObject->randomizer() . " "; ?> ]
      <br/>&nbsp;[ - - - ]
      <br/>&nbsp;&nbsp;<div class="important"><?php echo $charsObject->outcome ?></div>
    </div>

  </body>

</html>
