<?php

//READ DRUG ALLEGRY
$line_url = 'http://110.77.146.4:3000/api/drugallergy/3670500981816';
$chl = curl_init($line_url);
curl_setopt($chl, CURLOPT_TIMEOUT, 5);
curl_setopt($chl, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($chl, CURLOPT_RETURNTRANSFER, true);
$data1 = curl_exec($chl);
curl_close($chl);
//echo $data;
$json = file_get_contents($line_url);
$obj = json_decode($json,true);

//. "<br>" .
//$obj['opd_allergy'][0]['symptom'];

// Build message to reply back
$mymessage = 'คำเตือน : '. $obj['opd_allergy'][0]['agent'].'<br>'.$obj['opd_allergy'][0]['symptom'];

$access_token = 'tMQUkt2NlMGyROq8or9Yo//dLL20vznurHf/wundj5T+PeDLqoXRvZLY+5Drmoz0NXmRQy97b/xssaSunifqxDGQnu7faRK6rMDQEwEx0yiox8RJdzGJxcKblQA3Qb7DBq85P4m7pobxDTRbJ1WKIQdB04t89/1O/w1cDnyilFU=';


// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			//$text = 'คำเตือน : '.$obj['opd_allergy'][0]['agent'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			$messages = [
				'type' => 'text',
				'text' => $mymessage
			];


			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],

			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}

}
echo "OK";
