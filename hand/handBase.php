<?php

require_once(dirname( __FILE__ , 2).'/methods/methods.php');

class handBase {
  public $hand = [];

  public $player = '';

  public function setDecks(array $card) {
    echo $this->player."の引いたカードは".$card['mark'].'の'.$card['number']."です。\n";
    sleep(1);

    array_push($this->hand, $card);
  }

  public function getDecks() {
    return $this->hand;
  }

  public function getScore() {
    $score = 0;

    foreach($this->hand as $card){
      $number = convertNumber($card["number"]);
      $score += $number;
    }

    return $score;
  }
}

?>
