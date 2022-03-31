<?php

namespace app\Game;

// game実行の流れ
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

    $Player = new Player;
    $Dealer = new Dealer;

    $Player->setDecks($decks->draw());
    $Player->setDecks($decks->draw());

    $playerScore = $Player->getScore();

    if($playerScore === 21) {
      echo 'ブラックジャック! おめでとうございます。あなたの勝利です。';
      return;
    }

    $Dealer->setDecks($decks->draw());
    $Dealer->secretCardSetDecks($decks->draw());

    echo 'あなたの現在の得点は'.$playerScore.'です。';

    $isPlayerTurnContinue = true;
    while($isPlayerTurnContinue) {

      echo "カードを引きますか？引く場合はYを、引かない場合はNを入力してください。?\ny or n: ";
      $input = trim(fgets(STDIN));

      $isDraw = false;
      $isRepeat = true;

      while($isRepeat){
        if($input === 'y') {
          $isDraw = true;
          $isRepeat = false;
        } else if($input === 'n') {
          $isDraw = false;
          $isRepeat = false;
        } else {
          echo 'yかnで答えてください。';
          echo "\n";
          echo "カードを引きますか？引く場合はYを、引かない場合はNを入力してください。?\ny or n: ";
          $input = trim(fgets(STDIN));
        }
      }

      if($isDraw) {
        $Player->setDecks($decks->draw());

        $playerScore = $Player->getScore();

        if($playerScore === 21) {
          echo '合計数字が21になったのであなたの番を終了します。';
          $isPlayerTurnContinue = false;

        } else if($playerScore > 21) {
          echo '21を超えたのであなたの負けです。';
          $isPlayerTurnContinue = false;

        } else {
          echo 'あなたの現在の得点は'.$playerScore.'です。';
          $isPlayerTurnContinue = true;
        }
      } else {
        $isPlayerTurnContinue = false;
      }
    }

    if($playerScore > 21) {
      return;
    }

    // ディーラーのターン
    $Dealer->getSecretCard();

    $dealerScore = $Dealer->getScore();

    echo "ディーラーの現在の得点は".$dealerScore."です。\n";

    $isDealerTurnContinue = true;
    while($isDealerTurnContinue){

      if($playerScore < $dealerScore && $dealerScore > 16 ){
        echo 'ディーラーの得点があなたの得点を超えました。あなたの負けです。';
        $isDealerTurnContinue = false;

      } else {
        $Dealer->setDecks($decks->draw());
        $dealerScore = $Dealer->getScore();

        if($dealerScore > 21) {
          // 21を超えた場合
          echo 'ディーラーの得点が21を超えたのであなたの勝ちです。';
          $isDealerTurnContinue = false;

        }else if($dealerScore >= 17 && $dealerScore <= 21) {
          // 17以上21以下の場合
          echo "ディーラーの現在の得点は".$dealerScore."です。\n";
          $isDealerTurnContinue = false;

        } else {
          // 16以下の場合
          $isDealerTurnContinue = true;
          echo "ディーラーの現在の得点は".$dealerScore."です。\n";
        }
      }
    }
  }
}
?>