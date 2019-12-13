<?php
/*
 * 파일복사
 */
    $file = 'file.txt';
    $newfile = 'copyfile.txt.bak';

    if(copy($file, $newfile)){
        echo "success to copy $file !!!\n";
    }
    else{
        echo "failed to copy $file ...\n";
    }
?>
<?php
/*
 * 파일삭제
 */
    unlink('deleteme.txt');
?>