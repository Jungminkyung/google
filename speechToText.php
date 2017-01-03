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
	1.2 변환옵션	    
		PCM LINEAR 16bit 16000hz Mono   (Stereo일시 추출이 잘 안됩니다.)
		ffmpeg -i ORIGINAL -y -f s16le -acodec pcm_s16le -ar 16000 -ac 1 TARGET.raw 
		(raw로 변환시 재생해보기 힘든단점이 있는데, 추출잘되는것을 확인했습니다.)

2. GCS 업로드
	2.0 Google Cloud API 설치되어있어야하고, Google Storage 에 버킷을 만들어놓고, 버킷이름을 알고있어야 합니다.
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
	4.1 분석요청하기위해 access_token이 필요합니다.
		


