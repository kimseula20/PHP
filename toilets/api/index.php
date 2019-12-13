<?
/** HOTEL INDEX
* @ URL : http://pjw.chatbotstore.ai/stay/api/index.php
* 리턴 타입이 $re 일 경우 카카오 리턴 타입으로 만들어진 내용
*/
include("../config.php");
date_default_timezone_set("Asia/Seoul");

// 카카오 빌더 json 전송
//header
$header   = getallheaders();
//사용되는 변수들
$json_str; $req; $params; $user_key;

//header 처리
if($header["Req-Route"]=="openBuilderMkb"&&$header["Req-Type"]=="toilets"){
	//오픈빌더 - json
    $json_str = file_get_contents('php://input');
	$req      = json_decode($json_str,true);
	$params   = $req["action"]["detailParams"];
    $user_key = $req["userRequest"]["user"]["properties"]["plusfriendUserKey"];
	$api      = $params["api"]["value"];
	$result   = array("version"=>"2.0","template"=>array());
	$template = array(array("simpleText"=>array("text"=>"잘못된 접근입니다.처음으로 돌아가세요.")));
}
else{
	//POST - 오픈빌더가 아니라 일반 POST 방식으로 데이터가 들어왔을 때
	$api  = $_REQUEST["api"];
	$req  = $_POST;
}

$template["outputs"] =array(array("simpleText"=>array("text"=>"잘못된 접근입니다.처음으로 돌아가세요.")));

//로직
include "./user.php";
$search = new Search($pdo);
$template["outputs"] =array(array("simpleText"=>array("text"=>"잘못된 접근입니다.처음으로 돌아가세요.")));
$string = "non";

// 호출 가능한 API 리스트 ( get 조회, set 생성, mod 수정, del 삭제, page 페이지, ajax 페이지통신 )
switch($api){

	case "toilet" :
        $re = $search->selectLocation($params);
        $template = $re;
        break;

	default :
		$template["outputs"] =array(array("simpleText"=>array("text"=>"디폴트라능")));
		break;
}

if($header["Req-Type"]=="toilets"){

	$result["template"] = $template;

	if($context){
		$result["context"] = $context;
	}

}
echo json_encode($result);

# log파일 생성
//$template		= array();
$log_content    =  date('Y-m-d H:i:s',$_SERVER["REQUEST_TIME"])." | ".$_SERVER["REMOTE_ADDR"]."\r\n".
   				   "| header Data \r\n".json_encode($header,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)."\r\n".
                   "| Result Data \r\n".json_encode($result,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)."\r\n".
				   "| Params Data \r\n".json_encode($params,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)."\r\n".
				   "| Request Data \r\n".json_encode($req,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE)."\r\n".
				   "test : ".$string;
$log_dir        = "../log/";										 // log파일 경로
$log_file_name  = date('YmdHis')."_".substr(microtime(),0,6)."_test_index.log";                    // 파일명
$log_file       = fopen($log_dir.$log_file_name, "w"); 
fwrite($log_file, $log_content."\r\n"); 
fclose($log_file);
exit;

?>