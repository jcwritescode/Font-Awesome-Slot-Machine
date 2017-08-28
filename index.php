<?php
  // Require classes
  require('slots.inc.php');

  $visit = 0;
  // If user has hit "Generate Credits", they are a new user - Assign them a cookie called "user"
  if (isset($_POST['submit'])) {
    $userNum = rand(1,9000) + rand(1,9000);
    setcookie("user", $userNum, time() + (10 * 365 * 24 * 60 * 60));
    $visit = 1;
  }

// HTML doc head
$headObject = new Header;
echo $headObject->htmlHead;
?>

<body>
  <div class="timeline-small">
    <div class="inner">
      <h1>Font Awesome Slot Machine</h1>

<?php
  // If user has hit "Generate Credits", generate random credits and add to DB
  if (isset($_POST['submit'])) {
    $slotsObject = new RandomCreditGenerator;
    echo '<div class="win"> Congrats, you won ' . $slotsObject->credits . " Credits to start with!</div><p></p>";
    // Log to DB
    $databaseObject = new Db;
    $databaseObject->query("INSERT INTO `slotsdb` (`credits`, `userNum`) VALUES ($slotsObject->credits,$userNum)");
  }

  // If user has not hit "Generate Credits" & they dont have a cookie - they are a new user
  if (!isset($_POST['submit']) && !isset($_COOKIE["user"])) {
?>

        <p>Welcome, you'll need some credits to start with. Click the button to randomly generate your starting credits:<br/>
          <form action="#" method="post">
            <input type="submit" name="submit" value="Generate Credits">
          </form>
        </p>
<?php
  }
?>

        <div class="slotmachine">
            &nbsp;[<i class="fa fa-align-justify fa-fw"></i><i class="fa fa-align-justify fa-fw"></i><i class="fa fa-align-justify fa-fw"></i>]&nbsp;<span class="handle"><a href="javascript: submitform()">O</a></span><br/>
            &nbsp;[<i class="fa fa-usd fa-fw"></i><i class="fa fa-umbrella fa-fw"></i><i class="fa fa-anchor fa-fw"></i>]<span class="handle"><a href="javascript: submitform()">&nbsp;|</a></span><br/>
            ><span id="results">[<i class="fa fa-usd faa-flash animated fa-fw"></i><i class="fa fa-usd faa-flash animated fa-fw"></i><i class="fa fa-usd faa-flash animated fa-fw"></i>]</span>]<span class="handle"><a href="javascript: submitform()">]</a></span><br/>
            &nbsp;[<i class="fa fa-cubes fa-fw"></i><i class="fa fa-paper-plane fa-fw"></i><i class="fa fa-thumbs-o-up fa-fw"></i>]<br/>
            &nbsp;[<i class="fa fa-align-justify fa-fw"></i><i class="fa fa-align-justify fa-fw"></i><i class="fa fa-align-justify fa-fw"></i>]
        </div>

<?php
  // If user has previously played
  if ($visit == 1 || isset($_COOKIE["user"])) {
?>

        <form id="wager" action="machine.php" method="post">
          <div class="msg">What's your wager?&nbsp; <input type="text" size="24" name="wager"><span class="credits"> Credits</span>
          </div>
        </form>
        <p></p>

<?php
  }
?>
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

</body>
</html>
