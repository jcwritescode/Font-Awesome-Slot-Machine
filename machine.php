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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,500" type="text/css">
  </head>

  <body>

    <h1>Proof of concept</h1>

    <div class="credits">
    <?php
    $slotsObject = new RandomCreditGenerator;
    echo "Congrats, you have won " . $slotsObject->credits . " Credits to start with!";
    ?></div>
    <p></p>
    <div class="msg">How many Credits would you like to wager?
    <form>
      <input type="text" size="20" name="credits"><span class="credits"> Credits</span>
    </form>
  </div>
    <div class="blah">
      &nbsp;&nbsp;&nbsp;[ = = = ]&nbsp;&nbsp;<a href="#">0</a>
      <br/>&nbsp;&nbsp;&nbsp;[<?php echo " " . $randomA1 . " " . $randomB1 . " " . $randomC1 . " "; ?> ]&nbsp;&nbsp;<a href="#">|</a>
      <span id="results"><br/>> [<?php echo " " . $randomA2 . " " . $randomB2 . " " . $randomC2 . " "; ?> ]</span>&nbsp;&nbsp;<a href="#">|</a>
      <br/>&nbsp;&nbsp;&nbsp;[<?php echo " " . $randomA3 . " " . $randomB3 . " " . $randomC3 . " "; ?> ]]]<a href="#">]</a>
      <br/>&nbsp;&nbsp;&nbsp;[ = = = ]
    </div>


  </body>

</html>
