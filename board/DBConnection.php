<?php
$db = new mysqli('192.168.10.190', 'sakim', 'make0103!@', 'sakim');
if($db -> connect_error){
die('데이터베이스 연결에 문제가 있습니다. 관리자에게 문의해주시기 바랍니다.');
}else{
die('DB 연결을 성공했습니다.');
}
$db -> set_charset('utf8');
?>
