<?php
/*
 * 배열
 * shift : 배열의 앞쪽의 값을 빼기
 * unshift : 배열의 앞쪽에 값을 넣기
 * push : 배열의 뒷쪽에 값을 넣기
 * pop : 배열의 뒷쪽의 값을 빼기
 */


$li = ['a', 'b', 'c', 'd', 'e'];
echo "기존 배열 : ".var_dump($li).'<br>';
array_push($li, 'f');
echo "뒷쪽에 값을 추가한 배열 : ".$li.'<br>';

?>