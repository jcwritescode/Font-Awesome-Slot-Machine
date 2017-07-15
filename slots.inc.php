<?php

// Class to give user random credits on first start
class RandomCreditGenerator {
// Best practice - get /set
  public $credits;

    public function __construct() {
      // random_int() does not work, so had to use rand() - maybe not using PHP 7?
      $this->credits = rand(200, 2500);
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

?>
