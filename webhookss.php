<?php // callback.php
require "vendor/autoload.php";
require_once('vendor/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');
$access_token = 'YmOTeNtLzS70P55TfovHyurPZc0jBcUGR4GSFlEqzJQmCbtsoAOurD6SFUbRG8MvHaAQV3gF/1Fj29KWMkHEpIQuUS1Wn4p18JW2Mjx4ky0XxqUgTVJ/x1qR9CR7UwuQ854y0cJhethnu3CPfPT9XQdB04t89/1O/w1cDnyilFU=';


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
  #ตัวอย่าง Message Type "Text + Sticker"
  if($message == "สวัสดี"){
     $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
     $arrayPostData['messages'][0]['type'] = "text";
     $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา".$id;
     $arrayPostData['messages'][1]['type'] = "sticker";
     $arrayPostData['messages'][1]['packageId'] = "2";
     $arrayPostData['messages'][1]['stickerId'] = "34";
     replyMsg($arrayHeader,$arrayPostData);
  }
  else if($message == "รูป"){
        //$image_url = "https://imgur.com/wRqLW4x";
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0] =
array
(
  'type' => 'imagemap',
  'baseUrl' => 'https://150.95.82.132:8443/smb/file-manager/show?currentDir=%2Fhttpdocs%2Ftestbot101-master%2Fimage&file=38409924996_befaf1f33b_o/1040',
  'altText' => 'This is an imagemap',
  'baseSize' =>
  array (
    'width' => 1040,
    'height' => 1040,
  ),
  'actions' =>array(
  array (

      'type' => 'uri',
      'area' =>
      array (
        'x' => 16,
        'y' => 25,
        'width' => 497,
        'height' => 995,
      ),
      'linkUri' => 'https://google.com',
    ),
  ),
  );
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

/*function pushMsg($arrayHeader,$arrayPostData){
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
}*/
  exit;
?>
