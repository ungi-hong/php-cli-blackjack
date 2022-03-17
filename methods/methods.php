<?php

// 英語のカードを数字に変換するメソッド
function convertNumber(string $cardNumber) {
  if(is_numeric($cardNumber)){
    return intval($cardNumber);
  }else if($cardNumber === 'A') {
    return 11;
  }else {
    return 10;
  }
}

function listenDraw() {

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

  return $isDraw;
}
?>