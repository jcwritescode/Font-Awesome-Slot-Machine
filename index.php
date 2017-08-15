<?php
  require('slots.inc.php');
    $previousVisit = 0;
  if (isset($_COOKIE['user'])){
    $previousVisit = 1;
  } else {
  // Trying to create a decently random user number and setting a cookie
  $userNum = rand(1,9000) + rand(1,9000);
  setcookie("user", $userNum, time() + (10 * 365 * 24 * 60 * 60));
}

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

<?php
if ($previousVisit == 1) {
?>
    <h1>Proof of concept</h1>

    <div class="win">

<?php
  $slotsObject = new RandomCreditGenerator;
  echo "Congrats, you have won " . $slotsObject->credits . " Credits to start with!";
?>

    </div>
    <p></p>

    <div class="instructions"><div class="important">Instructions:</div><br/>Enter below the amount of credits you would like to wager, then pull the handle on the machine (click) to try your luck. If you get three "$" in a row, you win the jackpot!</div>
      <div class="msg">How many Credits would you like to wager?
      <form>
        <input type="text" size="20" name="credits"><span class="credits"> Credits</span>
      </form>
    </div>

    <div class="blah">
      &nbsp;[ - - - ]&nbsp;<span class="handle"><a href="/slots/machine.php">O</a></span>
      <br/>&nbsp;[&nbsp;$&nbsp;#&nbsp;@&nbsp;]<span class="handle"><a href="/slots/machine.php">&nbsp;|</a></span>
      <br/>><span id="results">[&nbsp;*&nbsp;+&nbsp;$&nbsp;]</span>]<span class="handle"><a href="/slots/machine.php">]</a></span>
      <br/>&nbsp;[&nbsp;@&nbsp;*&nbsp;+&nbsp;]
      <br/>&nbsp;[ - - - ]
    </div>

<?php } if (!isset($_POST['submit'])) { ?>

    <h1>Welcome</h1>
    <p>Click the button for your starting credits:
    <br/>
    <form action="#" method="post">
    <input type="submit" name="submit" value="Generate Credits">
    </form>
    </p>
<?php
    }
?>

  </body>

</html>
