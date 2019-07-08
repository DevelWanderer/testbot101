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
        $arrayPostData['messages'][0]['type'] = "imagemap";
        $arrayPostData['messages'][0]['baseUrl'] = "http://wealththai.org/testbot101-master/image/38409924996_befaf1f33b_o.png/1040";
        $arrayPostData['messages'][0]['altText'] = "This is an imagemap";
        $arrayPostData['messages'][0]['BaseSize'][0]['wridth'] = "1040";
        $arrayPostData['messages'][0]['BaseSize'][1]['height'] = "1040";
        $arrayPostData['messages'][0]['actions'][0]['type'] ="uri";
        $arrayPostData['messages'][0]['actions'][1]['linkUri'] ="https://google.com";
        $arrayPostData['messages'][0]['actions'][2]['area'][0]['x'] ="0";
        $arrayPostData['messages'][0]['actions'][3]['area'][1]['y'] ="586";
        $arrayPostData['messages'][0]['actions'][4]['area'][2]['width'] ="520";
        $arrayPostData['messages'][0]['actions'][5]['area'][3]['height'] ="454";

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
