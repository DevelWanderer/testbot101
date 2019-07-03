<?php // callback.php
require "vendor/autoload.php";
require_once('vendor/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');
$access_token = 'Z/vaB91Q/WsmdQLWN1UwFl5k6I+fnBwcHZSju9jIshHsZ8NpD5GiGirPc6FQ/wKKwD5qViTXHs66qDThOvCjYez41saC2XWUxmFJAjAzDWNrKWA/xFA1uELYyIFiXKuc5RxgAQxyJLc58FofJTS0GwdB04t89/1O/w1cDnyilFU=';



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
  $queryfromdb1 = 'U247e07dbd7112244b44c934915d5aceb';
  $name1 = 'เอิร์ท';
  $name2 = 'ต๊อบ';
  $queryfromdb2 = 'Udad3f0cf4081ddcc795152f3acbe244f';
  $arrayConfirm = array();

  if($id==$queryfromdb1)
  {
    if($message == "สวัสดี"){
    $arrayPostData['to'] = $id;
    $arrayPostData['messages'][0]['type'] = "text";
    $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา".$name1;
    $arrayConfirm['messages'][1]['type'] = "template";
    $arrayConfirm['messages'][1]['altText'] = "this is a confirm template";
    $arrayConfirm['messages'][1]['template'][1]['type'] = "confirm";
    $arrayConfirm['messages'][1]['template'][1]['text'] = "Are you sure?";
    $arrayConfirm['messages'][1]['template'][2]['actions'][0]['type'] = "message";
    $arrayConfirm['messages'][1]['template'][2]['actions'][0]['label'] = "Yes";
    $arrayConfirm['messages'][1]['template'][2]['actions'][0]['text'] = "yes";
    $arrayConfirm['messages'][1]['template'][3]['actions'][1]['type'] = "message";
    $arrayConfirm['messages'][1]['template'][3]['actions'][1]['lebel'] = "No";
    $arrayConfirm['messages'][1]['template'][3]['actions'][1]['type'] = "no";
     pushMsg($arrayHeader,$arrayPostData,$arrayConfirm);
  }
  }
  elseif($id==$queryfromdb2)
  {
     if($message == "สวัสดี"){
     $arrayPostData['to'] = $id;
     $arrayPostData['messages'][0]['type'] = "text";
     $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา".$name2;
     $arrayPostData['messages'][1]['type'] = "text";
     $arrayPostData['messages'][1]['text'] = "เราชื่อดอร่านะ";
     $arrayPostData['messages'][2]['type'] = "sticker";
     $arrayPostData['messages'][2]['packageId'] = "2";
     $arrayPostData['messages'][2]['stickerId'] = "34";
     $arrayPostData['messages'][3]['type'] = "text";
     $arrayPostData['messages'][3]['text'] = "https://erp.wealththai.net/quickregister??".$id;
     pushMsg($arrayHeader,$arrayPostData);
  }
  }
  function pushMsg($arrayHeader,$arrayPostData,$arrayConfirm){
     $strUrl = "https://api.line.me/v2/bot/message/push";
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL,$strUrl);
     curl_setopt($ch, CURLOPT_HEADER, false);
     curl_setopt($ch, CURLOPT_POST, true);
     curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayPostData));
     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayConfirm));
     curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
     $result = curl_exec($ch);
     curl_close ($ch);


  }
  exit;
?>
