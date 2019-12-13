
<?php
///** file_get_contents : 텍스트로 이루어진 파일을 읽어서 문자열을 리턴한다 */
//$file = 'file.txt';
//    echo file_get_contents($file);
//?>


<?php
/** file_put_contents : 문자열을 파일에 저장한다 */
    if(is_writable('writeme.txt')){
        $file = 'writeme.txt';
        file_put_contents($file, 'coding everybody');
        echo "success write to $file !!!\n";

    }else{
        echo "failed write to $file ...\n";
    }

?>


<?php
///** 네트워크를 통해 데이터 읽어오기 */
//    $homepage = file_get_contents('http://docs.php.net/manual/en/function.fopen.php');
//    echo $homepage;
//?>