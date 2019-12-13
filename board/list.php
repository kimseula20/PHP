<!DOCTYPE>
<?php
include 'DBConnection.php';
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
    table .even{
        background: #efefef;
    }
    .text{
        text-align:center;
        padding-top:20px;
        color:#000000
    }
    .text:hover{
        text-decoration: underline;
    }
    a:link {color : #57A0EE; text-decoration:none;}
    a:hover { text-decoration : underline;}
    #btn{
        border: 1px dashed #57A0EE;
        background-color: white;
    }
    #btn2 {
        border: 1px dashed #57A0EE;
        background-color: white;
    }
    .btn_group {
        postion:absolute;
        text-align: right;
    }

</style>

<body>
    <article class = "board">
        <h3 align = center>seula's 자유게시판</h3>
        <?php
            session_start();
            if(isset($_SESSION['id'])) {
                echo $_SESSION['id']; ?>님 안녕하세요.<
                <br/>
                <?php
            }
            else{
                ?>
                <div class="btn_group">
                <button id="btn" onclick="location.href='login.php'">로그인</button>
                <button id="btn2" onclick="location.href='signup.php'">회원가입</button>
                </div>
        <?php    }
        ?>
        <table align = center>
            <thead align = "center">
            <tr>
                <th width = "50" align = "center">번호</th>
                <th width = "300" align = "center">제목</th>
                <th width = "100" align = "center">작성자</th>
                <th width = "100" align = "center">작성날짜</th>
                <th width = "50" align = "center">조회수</th>

            </tr>
            </thead>
            <tbody>
            <?php
            $sql = 'SELECT * FROM board ORDER BY num DESC';
            $result = $db->query($sql);
            $total = mysqli_num_rows($result);
            while ($rows = mysqli_fetch_assoc($result)) { //DB에 저장된 데이터 수 (열 기준)
                if ($total % 2 == 0) {
                    ?>                      <tr class="even">
                <?php } else {
                    ?>                      <tr>
                <?php } ?>
                <td width="50" align="center"><?php echo $total ?></td>
                <td width="500" align="center">
                    <a href="view.php?number=<?php echo $rows['num'] ?>">
                    <?php echo $rows['title'] ?></td>
                <td width="100" align="center"><?php echo $rows['id'] ?></td>
                <td width="200" align="center"><?php echo $rows['integrated_date'] ?></td>
                <td width="50" align="center"><?php echo $rows['hit'] ?></td>
                </tr>
                <?php
                $total--;
            }
            ?>
            </tr></tbody>
        </table>

        <div class = text>
            <font style="cursor: hand"onClick="location.href='write.php'">글쓰기</font>
        </div>
    </article>
</body>
</html>
