<?php

$app = new Game();

$app->execute();

class Game {


  //アプリの実行のメソッド
  public function execute(){
    echo <<<EOM
    ★☆★☆★☆★☆★☆★☆★☆★☆ブラックジャックへようこそ!★☆★☆★☆★☆★☆★☆★☆★☆
    ゲームを開始します。
    \n
    EOM;

    $decks = new Decks;

    $decks->createDecks();

    $player = new Player;
    $Dealer = new Dealer;

    $player->setDecks($decks->draw());
    $player->setDecks($decks->draw());

    $Dealer->setDecks($decks->draw());
    $Dealer->secretCardSetDecks($decks->draw());



  }


}

class Decks {
  private $decks = [];

  public function createDecks() {
    $marks = ['ハート','スペード','クローバー','ダイヤ'];
    $numbers = ['A','2','3','4','5','6','7','8','9','10','J','Q','K'];

    $decks = [];

    foreach($marks as $mark) {
      foreach($numbers as $number) {
        array_push($decks,array('mark' => $mark, 'number' => $number));
      }
    }

    $this->decks = $decks;
  }

  public function draw() {
    $rand = array_rand($this->decks);
    $drawCard = $this->decks[$rand];

    array_splice($this->decks, $rand, 1);

    return $drawCard;
  }
}

class Player {
  public $decks = [];

  public function setDecks($card) {
    echo 'あなたの引いたカードは'.$card["mark"].'の'.$card["number"].'です。';
    echo "\n";
    array_push($this->decks, $card);
  }

  public function getDecks() {
    return $this->decks;
  }
}

class Dealer {
  public $decks = [];

  public function setDecks($card) {
    echo 'ディーラーの引いたカードは'.$card["mark"].'の'.$card["number"].'です。';
    echo "\n";
    array_push($this->decks, $card);
  }

  public function secretCardSetDecks($card) {
    echo 'ディーラーの2枚目のカードは分かりません。';
    echo "\n";
    array_push($this->decks, $card);
  }

  public function getDecks() {
    return $this->decks;
  }
}


// 流れ

// まず52枚のうち一枚を引いてプレイヤーの手札に移動
// 先程の一枚を抜いたものからもう一枚抜いてディーラーに渡す
// もう一枚引いてプレイヤーの手札に移動
// その後もう一枚抜いてディーラーに渡す。（このカードは表示されないでデータとして持つだけ）
// プレイヤーはもう一度手札を引いて21を目指す。
// 21を超えてしまった場合は負け、21ぴったりの場合はディーラーの番になる。
// それ以外はプレイヤーのタイミングで終わる
// ディーラーは16を超えるまで引き続ける。
// ディーラーが21を超えてしまった場合はプレイヤーの勝利。
// 16~21の場合は手札を交換し、プレイヤーと比較して勝敗を決める。

?>