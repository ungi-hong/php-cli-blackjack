<?php

namespace app\decks;

// デッキを作成や引くなどデッキに関するクラス
class Decks {
  private $decks = [];

  public function createDecks() {
    $marks = ['ハート','スペード','クローバー','ダイヤ'];
    $numbers = ['A','2','3','4','5','6','7','8','9','10','J','Q','K'];

    foreach($marks as $mark) {
      foreach($numbers as $number) {
        array_push($this->decks, array('mark' => $mark, 'number' => $number));
      }
    }
  }

  public function draw() {
    $rand = array_rand($this->decks);

    // TODO: 一つでまとめてみてそちらの方がわかりやすかった場合書き換えてみる。
    $drawCard = $this->decks[$rand];
    array_splice($this->decks, $rand, 1);

    return $drawCard;
  }
}

?>