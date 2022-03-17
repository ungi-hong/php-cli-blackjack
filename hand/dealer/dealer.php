<?php

require_once(dirname( __FILE__ , 2).'/handBase.php');

class Dealer extends handBase{
  public $player = 'ディーラー';


  public function secretCardSetDecks(array $card) {
    echo 'ディーラーの2枚目のカードは分かりません。';
    echo "\n";

    array_push($this->hand, $card);
  }

  public function getSecretCard() {
    echo 'ディーラーの2枚目のカードは'.$this->hand[1]["mark"].'の'.$this->hand[1]["number"].'でした。';
    echo "\n";
    sleep(1);
  }

}

?>
