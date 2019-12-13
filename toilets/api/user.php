<?
/** tran 스킬 상세 구현 영역*/
date_default_timezone_set('Asia/Seoul');

//	$client_id = "wwVjbEVHKhIwWntEI5bO"; //네이버 개발자센터에서 발급받은 CLIENT ID
//	$client_secret = "rdim77KGGn" //네이버 개발자센터에서 발급받은 client secret id
//	$url = "https://openapi.naver.com/v1/papago/n2mt";
class Search{
    private $pdo;
    function __construct($pdo){$this->pdo = $pdo;}
    function selectLocation($params){
        $temp_re["outputs"] = array(
                                array(
                                    "basicCard"=>
                                        array(
                                            "title"=> "화장실 찾기",
                                            "description"=> "아래의 버튼 중 하나를 선택해 주세요.",
                                            "thumbnail"=>
                                                array(
                                                    "imageUrl"=> ""
                                                     ),
                                    "buttons"=>
                                        array(
                                            array(
                                                "action"=>"webLink",
                                                "label"=> "현위치 주변 화장실 찾기",
                                                "webLinkUrl"=>"https://sakim.chatbotstore.ai/toilets/api/mylocation.php"
                                                 ),
                                            array(
                                                "action"=>"webLink",
                                                "label"=> "검색위치 주변 화장실 찾기",
                                                "webLinkUrl"=>"https://sakim.chatbotstore.ai/toilets/api/searchlocation.php"
                                                 )))));
        $temp_re["quickReplies"] = array(array("label" => "처음으로", "action" => "message", "messageText" => "처음으로"));
        return $temp_re;
    }
}
?>