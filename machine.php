<?php
require('slots.inc.php');
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

  <?php

  // Hmm, so if I instantiate here, it is available anywhere after? So I should just have it at the top of the doc? -->
    $charsObject = new RandomCharGenerator;

    if ($charsObject->outcome == "YOU WIN!") {
      echo '<div class="win">';
    } else {
      echo '<div class="lost">';
    }

    echo $charsObject->outcome . " # Credits";
  ?>
    </div>
    <p></p>

  <div class="msg">How many Credits would you like to wager?
    <form>
      <input type="text" size="20" name="credits"><span class="credits"> Credits</span>
    </form>
  </div>
  <!-- Thinking to use Font Awesome animated icons before random chars load -->

    <div class="blah">
      &nbsp;[ - - - ]&nbsp;<span class="handle"><a href="/slots/machine.php">O</a></span>
      <br/>&nbsp;[<?php echo " " . $charsObject->randomizer() . " " . $charsObject->randomizer() . " " . $charsObject->randomizer() . " "; ?> ]&nbsp;<span class="handle"><a href="/slots/machine.php">|</a></span>
      <br/>><span id="results">[<?php echo $charsObject->luck; ?>]</span>]<span class="handle"><a href="/slots/machine.php">]</a></span>
      <br/>&nbsp;[<?php echo " " . $charsObject->randomizer() . " " . $charsObject->randomizer() . " " . $charsObject->randomizer() . " "; ?> ]
      <br/>&nbsp;[ - - - ]
    </div>

  </body>

</html>
