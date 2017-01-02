<?

//작성일 2017-01-02
//Google Translate API 사용법을 설명합니다.
//Google Cloud SDK가 먼저 설치되어야 합니다.

require __DIR__ . '/vendor/autoload.php';

extract($_REQUEST);

putenv('GOOGLE_APPLICATION_CREDENTIALS=인증파일.json');
$client = new Google_Client();
$client->useApplicationDefaultCredentials();

use Google\Cloud\Translate\TranslateClient;

$projectId = '프로젝트 아이디';

# 프로젝트 아이디는 콘솔에 가서 확인 ( http://console.developers.google.com ) 
$translate = new TranslateClient([
    'projectId' => $projectId    
]);

# The text to translate
$text = $subject;
# The target language ( https://cloud.google.com/translate/docs/premium )
$target = $target ; 

# 일반번역은 model 값이 없어야 동작합니다.. 프리미엄 번역을 신청후 승인받았을때 , 모델 nmt를 사용할수 있게 되고, 에러가 나지 않습니다.
$translation = $translate->translate($text, [
    'target' => $target,
    'model'=>'nmt'
]);

print_r(json_encode($translation));

/*
[source] => ko [input] => 나는 좋은사람 [text] => I am a good person [model] =>
*/
?>