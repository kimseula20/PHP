<?php
include 'dbcon.php';

$getNum = (int)$_POST['num'];
var_dump($_POST['num']);
try{
    $query = "SELECT num, toilettype,tname,newaddr,addr,phone,opentime,lat,lng,
              FROM toilet
              WHERE num = $getNum";

    $result = mysqli_query($conn, $query);
    $return_array = array();

    while($data = mysqli_fetch_array($result)){
        $row_array['num'] = $data['num'];
        $row_array['toilettype'] = $data['toilettype'];
        $row_array['tname'] = $data['tname'];
        $row_array['newaddr'] = $data['newaddr'];
        $row_array['addr'] = $data['addr'];
        $row_array['phone'] = $data['phone'];
        $row_array['opentime'] = $data['opentime'];
        $row_array['lat'] = $data['lat'];
        $row_array['lng'] = $data['lng'];

        array_push($return_array, $row_array);
    }
    echo json_encode($return_array);
}catch(Exception $e){
    $str = "오류!!!!!!!!!!!!!!!!!!!!!!!!!!!!!";
    echo $str;
}

?>