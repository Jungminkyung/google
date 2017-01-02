<? 
	//작성일 2017-01-02

	include_once $_SERVER['DOCUMENT_ROOT']. '/vendor/autoload.php';

	//https://console.developers.google.com -> 사용자 인증정보 -> 사용자 인증 정보 만들기 -> 서비스 계정 키 -> JSON
    putenv('GOOGLE_APPLICATION_CREDENTIALS=/data/selfin/www/SpeakSam-fbe8233b833b.json');

    $client = new Google_Client();
    $client->useApplicationDefaultCredentials();
	//스코프 리스트 : https://developers.google.com/identity/protocols/googlescopes
    $client->addScope("https://www.googleapis.com/auth/cloud-platform");
	
    $token = $client->fetchAccessTokenWithAssertion();
    $access_token = $token['access_token'];
    
    echo $access_token;
        
    result('1','success'); 


?>