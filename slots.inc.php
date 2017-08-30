<?php

// HTML Head
class Header {
  public $htmlHead = '<!DOCTYPE html>
  <html>
  <head>
    <meta charset="UTF-8">
    <title>Font Awesome Slot Machine</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Mono:400,500|Roboto:400,500" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

       <script type="text/javascript">
            function submitform() {
            document.forms["wager"].submit();
            }
        </script>

     </head>';
}


// Class to give user random credits on first start
class RandomCreditGenerator {
// Best practice - get /set
  public $credits;

    public function __construct() {
      // random_int() does not work, so had to use rand() - maybe not using PHP 7?
      $this->credits = rand(2500, 5500);
        /*
        Damn, this is a cool trick - this guarantees that credits will be an increment of 50
        People on the internet say this is faster than doing a while loop
        Creating logic here to create a random number as an increment of 50
        */
        if ($this->credits % 50 != 0) {
            $this->credits += 50 - ($this->credits % 50);
          }
      }

}

class RandomCharGenerator {

  public $chars = array('<i class="fa fa-usd faa-flash animated fa-fw"></i>', '<i class="fa fa-diamond faa-flash animated  fa-fw"></i>', '<i class="fa fa-thumbs-o-up faa-flash animated fa-fw"></i>', '<i class="fa fa-money faa-flash animated fa-fw"></i>', '<i class="fa fa-times faa-fade1 animated fa-fw"></i>', '<i class="fa fa-usd faa-fade1 animated fa-fw"></i>', '<i class="fa fa-bath faa-fade1 animated fa-fw"></i>', '<i class="fa fa-car faa-fade2 animated fa-fw"></i>', '<i class="fa fa-thumbs-o-up faa-fade3 animated fa-fw"></i>', '<i class="fa fa-umbrella faa-fade1 animated fa-fw"></i>', '<i class="fa fa-paper-plane faa-fade2 animated fa-fw"></i>', '<i class="fa fa-anchor faa-fade3 animated fa-fw"></i>', '<i class="fa fa-star faa-fade1 animated fa-fw"></i>', '<i class="fa fa-cubes faa-fade2 animated fa-fw"></i>', '<i class="fa fa-glass faa-fade3 animated fa-fw"></i>', '<i class="fa fa-gamepad faa-fade1 animated fa-fw"></i>', '<i class="fa fa-diamond faa-fade2 animated fa-fw"></i>', '<i class="fa fa-fighter-jet faa-fade3 animated fa-fw"></i>');
  public $luck;
  public $noPull = '<i class="fa fa-times  fa-fw"></i><i class="fa fa-times  fa-fw"></i><i class="fa fa-times  fa-fw"></i>';
  public $outcome = 0;

  public function __construct(){
    $this->luck = rand(0,99);
      if ($this->luck < 1):
        $this->luck = $this->chars[0] . $this->chars[0] . $this->chars[0];
        $this->outcome = 4;
      elseif ($this->luck > 1 && $this->luck < 21):
        $this->luck = $this->chars[3] . $this->chars[3] . $this->chars[3];
        $this->outcome = 2;
      elseif ($this->luck > 21 && $this->luck < 40):
        $this->luck = $this->chars[1] . $this->chars[1] . $this->chars[1];
        $this->outcome = 3;
      elseif ($this->luck > 40 && $this->luck < 48):
        $this->luck = $this->chars[2] . $this->chars[2] . $this->chars[2];
        $this->outcome = 1;
      else:
        // This looks wrong - is this ok?
        $this->luck = $this->randomizer() . $this->randomizer() . $this->randomizer();
      endif;
  }

    public function randomizer(){
      $randChar = $this->chars[mt_rand(5, count($this->chars) - 1)];
      return $randChar;
    }

}

class Db {
  // Database connection
  protected static $connection;

  // === Connecting to the DB ===
  public function connect() {
    // Trying to connect to the db
      if (!isset(self::$connection)){
        // Load config as an array
        $config = parse_ini_file("config.ini");
        self::$connection = new mysqli("localhost", $config["username"], $config["password"], $config["dbname"]);
      }
      // If connection to db was not successful
      if (self::$connection === false) {
        echo "DB Connection Error"; // Need to change this before this goes live
        return false;
      }
      return self::$connection;
  }

  // === Query the DB ===
  public function query($query){
    // Connecting to DB
    $connection = $this->connect();

    // Query the DB
    $result = $connection->query($query);

    return $result;
  }

  // === Fetch rows from the DB (SELECT query) ===
  public function select($query){
    $result = $this->query($query);

    if ($result === false) {
      return false;
    }
    while ($row = $result->fetch_assoc()) {
      $rows = $row;
    }
    return $rows;
  }

  // === Fetch last error from DB ===
  public function error() {
    $connection = $this->connect();
    return $connection->error;
  }

  // === Quote and escape value for use in a DB query ===
  public function quote($value) {
      $connection = $this->connect();
      return $connection->real_escape_string($value);
  }

}


?>
