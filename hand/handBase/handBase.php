<?php

namespace app\hand\handBase;


// playerとdealerの動作の共通してる部分をまとめたクラス
class HandBase {
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
      if(is_numeric($card["number"])){
        $number = intval($card["number"]);
      }else if($card["number"] === 'A') {
        $number = 11;
      }else {
        $number = 10;
      }

      $score += $number;
    }

    return $score;
  }
}

?>
