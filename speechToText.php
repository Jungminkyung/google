동영상에서 텍스트를 추출하는 Google Speech To Text 사용법을 정리합니다. 2017-01-03

1. 동영상을 LINEAR16 인코딩으로 변환
2. Google Cloud Storage에 업로드
3. 분석요청 json파일을 만들기
4. 업로드된 gs://주소를 이용해서 분석 요청	

1. LINEAR16 변환
	1.1 ffmpeg 최신버전을 설치합니다.
		참고사이트 http://ffmpeg.org/download.html
		https://github.com/FFmpeg/FFmpeg.git
		http://www.tortall.net/projects/yasm/releases/yasm-1.3.0.tar.gz
		http://b1ix.net/184
	1.2 변환옵션	    
		PCM LINEAR 16bit 16000hz Mono   (Stereo일시 추출이 잘 안됩니다.)
		ffmpeg -i ORIGINAL -y -f s16le -acodec pcm_s16le -ar 16000 -ac 1 TARGET.raw 
		(raw로 변환시 재생해보기 힘든단점이 있는데, 추출잘되는것을 확인했습니다.)

2. GCS 업로드
	2.0 Google Cloud API 설치되어있어야하고, Google Cloud Storage 에 버킷을 만들어놓고, 버킷이름을 알고있어야 합니다.
		( https://www.google.co.kr/aclk?sa=l&ai=DChcSEwjThN-agKXRAhWVCCoKHa5cAAoYABAA&sig=AOD64_0Cpcr1AzDzySwE_inioIJNPXF2wQ&q=&ved=0ahUKEwiPqNqagKXRAhVGGJQKHeeeBsMQ0QwIHA&adurl= )
	2.1 API 홈페이지 https://cloud.google.com/speech/
	2.2 도움받은 주소 https://github.com/GoogleCloudPlatform/google-cloud-php
	<?
		include_once $_SERVER['DOCUMENT_ROOT']. '/vendor/autoload.php';
		putenv('GOOGLE_APPLICATION_CREDENTIALS=인증json파일');
		$client = new Google_Client();
		$client->useApplicationDefaultCredentials();

		use Google\Cloud\Storage\StorageClient;
		$storage = new StorageClient([
			'projectId' => '내버킷이름'
		]);
		$bucket = $storage->bucket('내버킷이름');
		$filename = 파일이름;				      //파일 basename 이어야 합니다.
		$bucket->upload(
			fopen($dir.'/'.$filename, 'r')    //실제 파일이 있는 위치를 기입합니다.
		);  
		$object = $bucket->object($filename);
		$object->downloadToFile($filename);   //버킷이 다운로드를 하니, 사용자 입장에서는 업로드가 됩니다.
	?>
3.sync-request.json만들기
	3.1 
		<?		 
			$filename = '파일위치와이름';
			$language = '언어셋'; //https://cloud.google.com/speech/docs/languages
			$pathinfo=pathinfo($filename);
			$dir = $pathinfo['dirname'];
			$basename = $pathinfo['basename'];
			
			$array = '';
			$array['config']['encoding']= 'LINEAR16';
			$array['config']['sampleRate']= '16000';
			$array['config']['languageCode']= $language;
			$array['audio']['uri']= 'gs://내버킷이름/'.$basename;    
			
			$filedata = json_encode($array);
			$f = fopen($dir.'/sync-request.json','w');
					
			fwrite($f,$filedata);
			fclose($f);
			/*
				{
			  'config': {
				  'encoding':'LINEAR16',
				  'sampleRate': 16000,
				  'languageCode': 'ko-KR'      
						
			  },
			  'audio': {
				  'uri':'gs://버킷/1482916868.raw'
			  }
			}*/
			
			$output = $dir.'/sync-request.json';
			echo $output;
			
		?>
4.분석요청
	4.1 분석요청하기위해 access_token이 필요합니다. JSON파일을 통한 인증후에 accesstoken을 요청후 curl을 사용해 asyncrecognize 요청을합니다.
	   <?
	   include_once $_SERVER['DOCUMENT_ROOT']. '/vendor/autoload.php';
	   putenv('GOOGLE_APPLICATION_CREDENTIALS=인증json파일');
		$client = new Google_Client();
		$client->useApplicationDefaultCredentials();
		$client->addScope("https://www.googleapis.com/auth/cloud-platform");
		
		$token = $client->fetchAccessTokenWithAssertion();
		$access_token = $token['access_token'];
		
		exec('curl -s -k -H "Content-Type: application/json" -H "Authorization: Bearer '.$access_token.'" https://speech.googleapis.com/v1beta1/speech:asyncrecognize -d @인증json파일위치 ',$result);

		//결과를 array형태로 배열합니다.
		$merged = implode($result);
		$decode = json_decode($merged,true);
		if($decode['error']['message'] != ''){
			//오류		
			die();
		}  

		//성공했을경우 name 필드에 값이 셋팅되어서 오며 $decode['name']으로 받을수있을텐데, 다음에 소스를 재사용하게 되면 해보자. 
		for($i=0,$ii=count($result); $i<$ii; $i++){
			$line = $result[$i];
			if(strpos($line,'UNAUTHENTICATED') !== false){
				$json['name']='UNAUTHENTICATED';
				die();
			}
			if(strpos($line,'name') !== false){
				//성공했을경우입니다. 
				break;
			}
			else{
				continue;
			}
		}
		
		echo $json['name'];
	   ?>
	4.2 asyncrecognize요청후에 받은 name값으로 진행도를 체크합니다.프로젝트의 APIKEY 가 필요합니다.
	    계산이 대기중일때 , 계산진행중일때, 계산완료후 리턴배열이 조금씩 달라집니다. 진행중에 metadata['progressPercent'] 를 참조합니다.
		계산완료후에 transcript[x]['transcript'] 에 추출한 대사가, transcript[x]['confidence'] 에 정확도가 표시되고, 시간은 없습니다.
	<?
		$key = 'API키입니다.';
		exec('curl https://speech.googleapis.com/v1beta1/operations/'.$calcingname.'?key='.$key,$result);
		
		$merged = implode($result);
		$decode = json_decode($merged,true);
		
		$percent = $decode['percent'] | $decode['metadata']['progressPercent'];
		if($percent == 100){
			for($i=0,$ii=count($decode['response']['results']); $i<$ii; $i++){            
				 $transcript=$decode['response']['results'][$i]['alternatives'][0]['transcript'];
				 $confidence=$decode['response']['results'][$i]['alternatives'][0]['confidence'];

				 $json['transcript'][$i]['transcript'] = $transcript;
				 $json['transcript'][$i]['confidence'] = $confidence;
			}
		}
		
		print_r($json);
	?>
	

Reference
 async 문서 https://cloud.google.com/speech/reference/rest/v1beta1/RecognitionConfig
 php CURL로 작성하는방법 http://stackoverflow.com/questions/39737913/google-speech-api-sample-rate-in-request-does-not-match-flac-header
 왜 LINEAR16으로 해야하는가 https://cloud.google.com/speech/docs/encoding
 LINEAR16인코딩ffmpeg   https://trac.ffmpeg.org/wiki/audio%20types
 스트리밍 api https://cloud.google.com/speech/docs/basics
 버킷페이지 https://cloud.google.com/storage/docs/cloud-console

 bill : https://cloud.google.com/pricing/?hl=ko&_ga=1.193398829.1280065514.1482394483
