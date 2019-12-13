<?
//dev_pjw개발용 config입니다. 실 서버에서 작동되는 config와 내용이 다릅니다.
define ( "__DEV_IP__" ,array("1.230.226.247","175.126.38.117","1.230.226.126")); //1.230.226.247 개발PC , 175.126.38.117 챗봇서버
define ( "__DEV_MODE__" ,in_array($_SERVER["REMOTE_ADDR"],__DEV_IP__ ));

$_c = array();
//패키지명
$_c["package"]["id"] = "toilets";

// DB 접속정보
$_c["db_service"]["host"]   = "175.125.95.174";
$_c["db_service"]["dbname"] = "sakim";
$_c["db_service"]["id"]     = "sakim";
$_c["db_service"]["pw"]     = "make0103!@";

// DB 접속정보(공통 서비스)
$_c["db_common"]["host"]   = "1.234.70.102";
$_c["db_common"]["dbname"] = "api_common";
$_c["db_common"]["id"]     = "makebotdev";
$_c["db_common"]["pw"]     = "make0103!@";


// 디렉터리 정의
$_c["dir"]["common"] = "/home/dev_khs/www/".$_c["package"]["id"] ."/common/";
$_c["dir"]["api"]    = "/home/dev_khs/www/".$_c["package"]["id"] ."/api/";
$_c["dir"]["page"]   = "/home/dev_khs/www/".$_c["package"]["id"] ."/api/page/";
$_c["dir"]["vars"]   = "/home/dev_khs/www/".$_c["package"]["id"] ."/vars/";

// 관리자 디렉터리 정의
$_c["uri"]["admin"] = "/makeHS/admin/"; // 도메인 이하 경로
$_c["dir"]["admin"] =  array();

$_c["dir"]["admin"]["idx"]         = "/home/dev_khs/www/".$_c["package"]["id"] ."/admin/";
$_c["dir"]["admin"]["action"]      = $_c["dir"]["admin"]["idx"]."action/";
$_c["dir"]["admin"]["content"]     = $_c["dir"]["admin"]["idx"]."content/";
$_c["dir"]["admin"]["upload"]      = $_c["dir"]["admin"]["idx"]."file/upload/"; 
$_c["dir"]["admin"]["download"]    = $_c["dir"]["admin"]["idx"]."file/download/"; 
$_c["dir"]["admin"]["upload_ad"]   = "/file/upload/"; 
$_c["dir"]["admin"]["download_ad"] = "/file/download/";


//이미지 파일 출력 경로
$_c["dir"]["admin"]["img"]   = $_c["uri"]["admin"]."file/upload/";

//기본 이미지 경로
$_c["dir"]["admin"]["img_default"]   = $_c["uri"]["admin"]."file/default/temp_no_img.PNG";

//이벤트 이미지 없을 경우 기본 이미지 정보
$_c["dir"]["admin"]["event_img_default"]   = $_c["uri"]["admin"]."file/default/temp_event_img.PNG";

//api>user.php 에서 사용되는 이미지URL , 웹링크 URL
$_c["api"]["img_url"] = "http://khs.chatbotstore.ai";
$_c["api"]["web_link_url"] = "https://khs.chatbotstore.ai/makeHS/api/page/reservation.php";

//룸서비스 새창 URL
$_c["dir"]["roomservice"]["page"] = "http://khs.chatbotstore.ai/makeHS/api/page/roomservice/service.php";

//룸서비스 새창 URL
$_c["dir"]["checkin_fb"]["page"] = "http://khs.chatbotstore.ai/makeHS/api/page/checkin_fb/checkin_fb.php";

//음성파일 새창 URL
$_c["dir"]["file"]["play"] = "http://khs.chatbotstore.ai/makeHS/api/";

//엑셀 파일 다운로드 전용
$_c["dir"]["download"]   = "/home/dev_khs/www/".$_c["package"]["id"] ."/admin/file/download/";

// 라이브러리 클래스 파일
//$_c["lib"]["excel"] = "/home/api/www/lib/PHPExcel-1.8/Classes/PHPExcel.php";
$_c["lib"]["excel"] = "/home/dev_khs/www/lib/PHPExcel-1.8/Classes/PHPExcel.php";


// 구글 API key ( 0:우정수 1:김지웅 이사님)
//$_temp = array("AIzaSyCzO_Vtlru8tAMHqPukbV7bavfOYTUJOjk","AIzaSyALr9rWM-rHEHjdOIpmNL9gVpa411KLZlQ"); 
//$_c["googleapis"]["key"] = $_temp[rand(0,count($_temp)-1)];
//unset($_temp);

// PDO 객체
$pdo = new PDO('mysql:dbname='.$_c["db_service"]["dbname"].';host='.$_c["db_service"]["host"], $_c["db_service"]["id"], $_c["db_service"]["pw"]);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>

