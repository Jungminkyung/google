<? 
    //서버에서 엑세스토큰이 필요한 인증을 거칠때 마우스클릭이 필요한 OAuth2.0 이 아닌 JSON인증방식을 구현했습니다.
    //작성일 2017-01-02
    //참고사이트 https://cloud.google.com/speech/docs/getting-started .
    //console command : gcloud auth print-access-token 


    iclude_once $_SERVER['DOCUMENT_ROOT']. '/vendor/autoload.php';

     //https://console.developers.google.com -> 사용자 인증정보 -> 사용자 인증 정보 만들기 -> 서비스 계정 키 -> JSON
    putenv('GOOGLE_APPLICATION_CREDENTIALS=/xxxx/xxxxx.json');

    $client = new Google_Client();
    $client->useApplicationDefaultCredentials();
	//스코프 리스트 : https://developers.google.com/identity/protocols/googlescopes
    $client->addScope("https://www.googleapis.com/auth/cloud-platform");
	
    $token = $client->fetchAccessTokenWithAssertion();
    $access_token = $token['access_token'];
    
    echo $access_token;
?>
