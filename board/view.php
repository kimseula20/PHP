<?php
    include 'DBConnection.php';

    $number = $_GET['num'];
    session_start();
    $sql = "SELECT title, content, date, hit, id FROM board WHERE num = $number";
    $result = $db -> query($sql);
    $rows = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
    <title>seula's freeBoard</title>
</head>
<style>
    table{
        border-top: 1px solid #444444;
        border-collapse: collapse;
    }
    tr{
        border-bottom: 1px solid #444444;
        padding: 10px;
    }
    td{
        border-bottom: 1px solid #efefef;
        padding: 10px;
    }
</style>
<body>
    <table class = "view_table" align = center>
        <tr>
            <td colspan="4" class="view_title"><?php echo['title']?></td>
        </tr>
        <tr>
            <td class = "view_id">작성자</td>
            <td class = "view_id2"><?php echo $rows['id']?></td>
            <td class = "view_hit">조회수</td>
            <td class = "view_hit2"><?php echo $rows['hit']?></td>
        </tr>
        <tr>
            <td colspan = "4" class = "view_content" valign = "top"><?php echo $rows['content']?></td>
        </tr>
    </table>
    <div class = "view_btn">
        <button class = "view_btn" onclick="location.href = 'list.php'">목록</button>
        <button class = "view_btn1" onclick="location.href = 'modify.php?num=<?=$number?>&id=<?=$_SESSION['id']?>'">수정</button>
        <button class = "view_btn2" onclick="location.href = 'delete.php?num=<?=$number?>$id=<?=$_SESSION['id']?>'">삭제</button>
    </div>

</body>

