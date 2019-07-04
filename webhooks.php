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
  $senderId = '104';
  $sendername = 'Kontrakarn';
  $recieverLineUserId = 'Lineuserid';
  $recievername = 'ต๊อบ';
  $messagesend = 'ซิพกับเดล มีสองพี่น้อง ขายของในคลอง ในกองเรามีแต่ถั่วดีๆ เพิ่งเด็ดสดๆ มากินให้หมด';
  function getDataFromUrl($url) {
   $ch = curl_init();
   // Set URL and header options
   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_HEADER, 0);

   // Start to capture the output
   ob_start();
   // Excecuting the curl call
   curl_exec($ch);
   // Get the srtout content and clean the buffer
   $sendmessage = ob_get_clean();

   // Close the Curl resource
   curl_close($ch);


  if($id==$queryfromdb1)
  {
    if($message == "สว"){
      $arrayPostData['to'] = $id;
      $arrayPostData['messages'][0]['type'] = "text";
      $arrayPostData['messages'][0]['text'] = "สวัสดีคุณ ".$name1."\n"."มีอะไรให้รับใช้คะ?";}
    elseif ($message == 'ส่งข้อความ') {
      $arrayPostData['to'] = $id;
      $arrayPostData['messages'][0]['type'] = "text";
      $arrayPostData['messages'][0]['text'] = "พิมพ์มาได้เลยค่ะ";
    }
    elseif ($message) {
      $arrayPostData['to'] = $id;
      $sendmessage = $message;
      $arrayPostData['messages'][0]['type'] = "text";
      $arrayPostData['messages'][0]['text'] = "ทวนนะคะ"."\n".$sendmessage;

    }

  }ว
  pushMsg($arrayHeader,$arrayPostData);
  }
  }
  elseif($id==$queryfromdb2)
  {
    if($message == "สวัสดี"){
      $arrayPostData['to'] = $id;
      $arrayPostData['messages'][0]['type'] = "text";
      $arrayPostData['messages'][0]['text'] = "สวัสดีคุณ ".$name2."\n"."มีข้อความใหม่ส่งถึงคุณ"."\n"."ส่งมาจาก ".$sendername."\n"."ข้อความ ".$messagesend;
     pushMsg($arrayHeader,$arrayPostData);
  }
  }
function pushMsg($arrayHeader,$arrayPostData/*,$arrayConfirm*/){
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
