<?php // callback.php
require "vendor/autoload.php";
require_once('vendor/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');
$access_token = 'Z/vaB91Q/WsmdQLWN1UwFl5k6I+fnBwcHZSju9jIshHsZ8NpD5GiGirPc6FQ/wKKwD5qViTXHs66qDThOvCjYez41saC2XWUxmFJAjAzDWNrKWA/xFA1uELYyIFiXKuc5RxgAQxyJLc58FofJTS0GwdB04t89/1O/w1cDnyilFU=';
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('Z/vaB91Q/WsmdQLWN1UwFl5k6I+fnBwcHZSju9jIshHsZ8NpD5GiGirPc6FQ/wKKwD5qViTXHs66qDThOvCjYez41saC2XWUxmFJAjAzDWNrKWA/xFA1uELYyIFiXKuc5RxgAQxyJLc58FofJTS0GwdB04t89/1O/w1cDnyilFU=');
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '576c647ae353642081fe5c8fa4826f80']);

// Get POST body content
$content = file_get_contents('php://input');

  $arrayJson = json_decode($content, true);
  $arrayHeader = array();
  $arrayHeader[] = "Content-Type: application/json";
  $arrayHeader[] = "Authorization: Bearer {$access_token}";
 
  
  
  //รับข้อความจากผู้ใช้
  $message = $arrayJson['events'][0]['message']['text'];
  //รับ id ของผู้ใช้
  $id = $arrayJson['events'][0]['source']['userId'];
  //$response = $bot->getProfile($id);

     if($message == "สวัสดี"){
     $arrayPostData['to'] = $id;
     $arrayPostData['messages'][0]['type'] = "text";
     $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา".$profile['displayName'];
     $arrayPostData['messages'][1]['type'] = "text";
     $arrayPostData['messages'][1]['text'] = "เราชื่อดอร่านะ";
     $arrayPostData['messages'][2]['type'] = "sticker";
     $arrayPostData['messages'][2]['packageId'] = "2";
     $arrayPostData['messages'][2]['stickerId'] = "34";
     pushMsg($arrayHeader,$arrayPostData);
  }
  function pushMsg($arrayHeader,$arrayPostData){
     $strUrl = "https://api.line.me/v2/bot/message/push";
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL,$strUrl);
     curl_setopt($ch, CURLOPT_HEADER, false);
     curl_setopt($ch, CURLOPT_POST, true);
     curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayPostData));
     curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
     $result = curl_exec($ch);
     curl_close ($ch);
      

  }
  exit;
?>
