<?php
include 'DBConnection.php';

$id = $_GET[name];                      //Writer
//$pw = $_GET[pw];                        //Password
$title = $_GET[title];                  //Title
$content = $_GET[content];              //Content
$date = date('Y-m-d H:i:s');            //Date

$URL = 'list.php';                   //return URL


$query = "insert into board (num, title, content, integrated_date, hit, id) 
                        values(null,'$title', '$content', '$date',0, '$id')";


$result = $db->query($query);
if($result){
    ?>                  <script>
        alert("<?php echo "글이 등록되었습니다."?>");
        location.replace("<?php echo $URL?>");
    </script>
    <?php
}
else{
    echo "FAIL";
}

mysqli_close($db);
?>