<?php
function get_members(){
    // 배열은 아래의 두가지 방법으로 사용할 수 있음
    $class = Array("hi","hello","nice");
    $class1=["hi","hello","nice"];

    return ["kim", "seula", "a", "yoon", "ji", "sung"];
}
$members = get_members();
for($i=0; $i<count($members); $i++){
    echo ucfirst($members[$i]).'<br>';
    // ucfirst : 배열에서 가져오는 문자값들의 맨 앞자리를 대문자로 가져오는 함수
}
?>
