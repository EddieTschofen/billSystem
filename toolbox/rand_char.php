<?php
//generate random char string
function rand_char($length) {
  $random = '';
  for ($i = 0; $i < $length; $i++) {
    $random .= getRandomChar();
  }
  return $random;
}

function getRandomChar(){
  $charNum = mt_rand(33, 126);
  if($charNum == 34 || $charNum == 39 ||  $charNum == 92 || $charNum == 96){ // ' " \ `
    return getRandomChar();
  }
  else{
    return chr($charNum);
  }
}

function all_char() {
  for ($i = 33; $i < 126; $i++) {
    echo $i ." : ". chr($i) . "<br/>";
  }
}
