<?php // callback.php
require "vendor/autoload.php";
require_once('vendor/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');
$access_token = 'Z/vaB91Q/WsmdQLWN1UwFl5k6I+fnBwcHZSju9jIshHsZ8NpD5GiGirPc6FQ/wKKwD5qViTXHs66qDThOvCjYez41saC2XWUxmFJAjAzDWNrKWA/xFA1uELYyIFiXKuc5RxgAQxyJLc58FofJTS0GwdB04t89/1O/w1cDnyilFU=';
$channal_secret = '576c647ae353642081fe5c8fa4826f80';

// Get POST body content
$content = file_get_contents('php://input');
$some = json_decode($content,true);

$Header1 = array();
$Header1[] = "Authorization:Bearer{$access_token}";

$profile = "https://api.line.me/v2/bot/profile/".&arrJson['event'[0]['source']['userId'];
                                                          
$ch = curl_init();
curl_setopt($ch1,CURLOPT_URL,$profile);
curl_setopt($ch1,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch1,CURLOPT_HTTPHEADER,$Header1);
$result1 = curl_exec($ch1);
curl_close($ch1);

$some1 = json_decode($result1,true);
                                                          
$url = 'https://api.line.me/v2/bot/message/reply';
                                                          
$data =array();
$data['replyToken'] = $some['event'][0]['replyToken'];
$data['message'][0]['type'] = "text";
      $data['message'][0]['type'] = $some1['displayname']."สวัสดีครับ";


// Make a POST Request to Messaging API to reply to sender


echo "OK";
