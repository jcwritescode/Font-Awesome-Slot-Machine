<?php
  require('slots.inc.php');
    $visit = 0;
  if (isset($_POST['submit'])){
  // Decently random user number and setting a cookie
  $userNum = rand(1,9000) + rand(1,9000);
  setcookie("user", $userNum, time() + (10 * 365 * 24 * 60 * 60));
    $visit = 1;
}
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

<?php
  if ($visit == 1 || isset($_COOKIE["user"])) {
?>
    <h1>Font Awesome Slot Machine</h1>


<?php
  if (isset($_POST['submit'])) {
    echo '<div class="win">';
    $slotsObject = new RandomCreditGenerator;
    echo "Congrats, you have won " . $slotsObject->credits . " Credits to start with!";
    $databaseObject = new Db;
    // Log to DB
    $databaseObject->query("INSERT INTO `slotsdb` (`credits`, `userNum`) VALUES ($slotsObject->credits,$userNum)");
}
?>

  </div>
    <p></p>

  <div class="instructions"><div class="important">Instructions:</div><br/>Enter below the amount of credits you would like to wager, then pull the handle on the machine (click) to try your luck. If you get three "$" in a row, you win the jackpot!</div>
      <div class="msg">How many Credits would you like to wager?
        <form id="wager" action="machine.php" method="post">
          <input type="text" size="20" name="wager"><span class="credits"> Credits</span>

  <div class="blah">
      &nbsp;[<i class="fa fa-align-justify fa-fw"></i><i class="fa fa-align-justify fa-fw"></i><i class="fa fa-align-justify fa-fw"></i>]&nbsp;<span class="handle"><a href="javascript: submitform()">O</a> <-Pull Handle</span>
      <br/>&nbsp;[<i class="fa fa-usd fa-fw"></i><i class="fa fa-umbrella fa-fw"></i><i class="fa fa-anchor fa-fw"></i>]<span class="handle"><a href="javascript: submitform()">&nbsp;|</a></span>
      <br/>><span id="results">[<i class="fa fa-usd faa-flash animated fa-fw"></i><i class="fa fa-usd faa-flash animated fa-fw"></i><i class="fa fa-usd faa-flash animated fa-fw"></i>]</span>]<span class="handle"><a href="javascript: submitform()">]</a></span>
      <br/>&nbsp;[<i class="fa fa-cubes fa-fw"></i><i class="fa fa-paper-plane fa-fw"></i><i class="fa fa-thumbs-o-up fa-fw"></i>]
      <br/>&nbsp;[<i class="fa fa-align-justify fa-fw"></i><i class="fa fa-align-justify fa-fw"></i><i class="fa fa-align-justify fa-fw"></i>]
    </div>

     </form>
    </div>

<?php } else { ?>

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
