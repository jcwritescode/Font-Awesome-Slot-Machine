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
    $charsObjectA1 = new RandomCharGenerator;
    $charsObjectA2 = new RandomCharGenerator;
    $charsObjectA3 = new RandomCharGenerator;
    $charsObjectB1 = new RandomCharGenerator;
    $charsObjectB2 = new RandomCharGenerator;
    $charsObjectB3 = new RandomCharGenerator;
    $charsObjectC1 = new RandomCharGenerator;
    $charsObjectC2 = new RandomCharGenerator;
    $charsObjectC3 = new RandomCharGenerator;
  ?>

    <div class="blah">
      &nbsp;[ - - - ]&nbsp;<span id="results"><a href="#">O</a></span>
      <br/>&nbsp;[<?php echo " " . $charsObjectA1->exChar . " " . $charsObjectA2->exChar . " " . $charsObjectA3->exChar . " "; ?> ]&nbsp;<span id="results"><a href="#">|</a></span>
      <span id="results"><br/>>[<?php echo $charsObjectA1->luck; ?>]</span>]<span id="results"><a href="#">]</a></span>
      <br/>&nbsp;[<?php echo " " . $charsObjectC1->exChar . " " . $charsObjectC2->exChar . " " . $charsObjectC3->exChar . " "; ?> ]
      <br/>&nbsp;[ - - - ]
    </div>
  <?php
    // $charsObject = new RandomCharGenerator;
    // echo "<p><strong>Testing Random Char Gen:</strong></p>";
    // echo $charsObject->exChar;
  ?>
  </body>

</html>
