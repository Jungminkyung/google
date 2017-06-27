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



<option value="gl">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;갈리시아</option>
<option value="gu">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;구자라트</option>
<option value="el">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;그리스</option>
<option value="nl">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;네덜란드 </option>
<option value="ne">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;네팔어 </option>
<option value="no">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;노르웨이어 </option>
<option value="da">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;덴마크어 </option>
<option value="de">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;독일어 </option>
<option value="lo">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;라오어</option>
<option value="lv">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;라트비아어 </option>
<option value="la">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;라틴어 </option>
<option value="ru">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;러시아어</option>
<option value="ro">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;루마니아어</option>
<option value="lb">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;룩셈부르크어</option>
<option value="lt">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;리투아니아어</option>
<option value="mr">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;마라티어</option>
<option value="mi">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;마오리어 </option>
<option value="mk">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;마케도니아어</option>
<option value="mg">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;말라가시어</option>
<option value="ml">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;말라알람어</option>
<option value="ms">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;말레이어</option>
<option value="mt">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;몰타어 </option>
<option value="mn">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;몽골어</option>
<!--<option value="hmf">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;몽어</option>-->
<option value="my">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;미얀마어</option>
<option value="eu">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;바스크어</option>
<option value="vi">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;베트남어</option>
<option value="be">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;벨라루르어</option>
<option value="bn">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;벵골어</option>
<option value="hr-BA">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;보스니아어</option>
<option value="bg">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;불가리아어</option>
<option value="sm">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;사모아어</option>
<option value="sr">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;세르비아어</option>
<option value="ceb">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;세부아노</option>
<option value="st">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;세소토어</option>
<option value="so">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;소말리아어</option>
<option value="sn">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;쇼나어</option>
<option value="su">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;순다어 </option>
<option value="sw">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;스와힐리어</option>
<option value="sv">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;스웨덴어</option>
<!--<option value="gla">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;스코틀랜드 게일어</option>-->
<option value="gl-ES">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;스페인어</option>
<option value="sk">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;슬로바키아어</option>
<option value="sl">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;슬로베니아어</option>
<option value="sd">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;신디어</option>
<option value="si">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;신할라어</option>
<option value="ar">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;아랍어</option>
<option value="hy">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;아르메니아어</option>
<option value="is">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;아이슬란드어</option>
<option value="ht">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;아이티 크리울어</option>
<option value="ga">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;아일랜드어</option>
<option value="az">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;아제르바이잔어</option>
<option value="af">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;아프리칸스어</option>
<option value="sq">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;알바니아어</option>
<option value="am">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;암하라어</option>
<option value="et">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;에스토니아어 </option>
<option value="eo">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;에스페란토어 </option>
<option value="en">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;영어</option>
<!--<option value="">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;요루바어</option>-->
<option value="ur">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;우르두어</option>                            
<option value="uz">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;우즈베크어</option>
<option value="uk">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;우크라이나어</option>
<option value="cy">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;웨일즈어</option>
<option value="ig">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;이그보어</option>
<option value="yi">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;이디시어</option>
<option value="it">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;이탈리아어</option>
<option value="id">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;인도네시아어</option>
<option value="ja">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;일본어 </option>
<option value="jw">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;자바어</option>
<option value="ka">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;조지아어</option>
<option value="zu">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;줄루어</option>
<option value="zh-CN">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;중국어</option>
<option value="ny">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;체와어</option>
<option value="cs">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;체코어</option>
<option value="kk">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;카자흐어</option>
<option value="ca">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;카탈로니아어</option>
<option value="kn">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;칸나다어</option>
<option value="co">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;코르시카어</option>
<option value="xh">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;코사어</option>
<option value="ku">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;쿠르드어</option>
<option value="hr">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;크로아티아어</option>
<option value="km">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;크메르어</option>
<option value="ky">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;키르기스어 </option>
<option value="tl">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;타갈로그어</option>
<option value="ta">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;타밀어</option>
<option value="tg">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;타지크어</option>
<option value="th">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;태국어</option>
<option value="tr">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;터키어</option>
<option value="te">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;델루구어</option>
<option value="ps">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;파슈토어</option>
<option value="pa">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;펀자브어</option>
<option value="fa">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;페르시아어</option>
<option value="pt">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;포르투갈어</option>
<option value="pl">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;폴란드어 </option>
<option value="fr">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;프랑스어</option>
<option value="fy">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;프리지아어</option>
<option value="fi">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;핀란드어</option>                            
<option value="haw">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;하와이어</option>
<option value="ha">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;하우사어</option>
<option value="ko">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;한국어</option>
<option value="hu">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;헝가리어</option>
<option value="he">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;히브리어</option><!--다름-->
<option value="hi">&nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;  &nbsp;힌디어</option>
