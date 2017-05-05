<?php
$access_token = 'tMQUkt2NlMGyROq8or9Yo//dLL20vznurHf/wundj5T+PeDLqoXRvZLY+5Drmoz0NXmRQy97b/xssaSunifqxDGQnu7faRK6rMDQEwEx0yiox8RJdzGJxcKblQA3Qb7DBq85P4m7pobxDTRbJ1WKIQdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
