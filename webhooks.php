<?php // callback.php
require "vendor/autoload.php";
require_once('vendor/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');
$access_token ='YmOTeNtLzS70P55TfovHyurPZc0jBcUGR4GSFlEqzJQmCbtsoAOurD6SFUbRG8MvHaAQV3gF/1Fj29KWMkHEpIQuUS1Wn4p18JW2Mjx4ky0XxqUgTVJ/x1qR9CR7UwuQ854y0cJhethnu3CPfPT9XQdB04t89/1O/w1cDnyilFU=';



// Get POST body content
$content = file_get_contents('php://input');

  $arrayJson = json_decode($content, true);
  $arrayHeaderr = array();
  $arrayHeaderp = array();
  $arrayHeader[] = "Content-Type: application/json";
  $arrayHeader[] = "Authorization: Bearer {$access_token}";



  //รับข้อความจากผู้ใช้
  $message = $arrayJson['events'][0]['message']['text'];

  //รับ id ของผู้ใช้
  $id = $arrayJson['events'][0]['source']['userId'];
  $queryfromdb1 = 'Ue019d5b78036772cd8be0b26646376f2';
  $name1 = 'เอิร์ท';
  $name2 = 'ต๊อบ';
  $queryfromdb2 = 'Uaf703e9707ecc91b4ebb7f6bc758ee1a';
  $senderId = '104';
  $sendername = 'Kontrakarn';
  $recieverLineUserId = 'Lineuserid';
  $recievername = 'ต๊อบ';
  $messagesend = 'ซิพกับเดล มีสองพี่น้อง ขายของในคลอง ในกองเรามีแต่ถั่วดีๆ เพิ่งเด็ดสดๆ มากินให้หมด';


/*    $arrayPostData['to'] = $id;
    $arrayPostData['messages'][0]['type'] = "text";
    $arrayPostData['messages'][0]['text'] = "สำหรับคนที่ยังไม่ได้สมัครเป็นสมาชิก Wealththai กดลิ้งนี้"."\n"."https://erp.wealththai.net/quickregister?lusid?".$id."?lusid?"."\n".
    "สำหรับคนที่เป็นสมาชิก Wealththai แล้วกดลิ้งนี้"."\n"."https://erp.wealththai.net/quickregister?lusid?".$id."?lusid?"."\n"."
line://app/1595423850-4b5xx9wP";
  pushMsg($arrayHeader,$arrayPostData);*/

  if($message == "เชื่อมต่อบัญชี"){
    $arrayReplyData['to'] = $id;
    $arrayReplyData['messages'][0]['type'] = "text";
    $arrayReplyData['messages'][0]['text'] = "http://erp.wealththai.net/Profile/lineuserid/up?".$id;
replyMsg($arrayHeaderr,$arrayReplyData);
}

  elseif($message == "Connect1562Server"){
    $arrayReplyData['to'] = $id;
    $arrayReplyData['messages'][0]['type'] = "text";
    $arrayReplyData['messages'][0]['text'] = "https://erp.wealththai.net/userprofile/lineuserid/up?".$id;
replyMsg($arrayHeaderr,$arrayReplyData);
}
if(!empty($_POST['passwordconnecttolinemember']))
{

    $arrayPushData['to'] = $_POST['lineid'];
    $arrayPushData['messages'][0]['type'] = "text";
    $arrayPushData['messages'][0]['text'] = 'เชื่อมต่อไลน์กับบัญชีระบบ Wealththai ของคุณเรียบร้อยแล้ว!';
    pushMsg($arrayHeaderp,$arrayPushData);
    return;

}
elseif(!empty($_POST['passwordconnecttoline']))
{

    $arrayPushData['to'] = $_POST['lineid'];
    $arrayPushData['messages'][0]['type'] = "text";
    $arrayPushData['messages'][0]['text'] = 'เชื่อมต่อไลน์กับบัญชีระบบ Wealththai ของคุณเรียบร้อยแล้ว!';
    pushMsg($arrayHeaderp,$arrayPushData);
    return;

}
    //!empty == "!=" (if($_POST['username'] != NULL))
    elseif(!empty($_POST['recievername']) && !empty($_POST['sendername']))
{

      $arrayPushData['to'] = $_POST['reciverlineuserid'];
      $arrayPushData['messages'][0]['type'] = "text";
      $arrayPushData['messages'][0]['text'] = "สวัสดีคุณ ".$_POST['recievername']."สวัสดีคุณ ".$_POST['username']."\n"."มีข้อความใหม่ส่งถึงคุณ"."\n"."ส่งมาจาก ".$_POST['sendername']."\n"."ข้อความ ".$_POST['message'];

      pushMsg($arrayHeaderp,$arrayPushData);

      /*$arrayPostData['to'] = $queryfromdb2;
      $arrayPostData['messages'][0]['type'] = "text";
      $arrayPostData['messages'][0]['text'] = "ไอดี ".$_POST['username']."สวัสดีคุณ ".$_POST['username']."\n"."มีข้อความใหม่ส่งถึงคุณ"."\n"."ส่งมาจาก ".$sendername."\n"."ข้อความ ".$messagesend;
      pushMsg($arrayHeader,$arrayPostData);*/
        return;

}
else
{
    return;
}

function replyMsg($arrayHeaderr,$arrayReplyData){
     $strUrlr = "https://api.line.me/v2/bot/message/reply";
     $chr = curl_init();
     curl_setopt($chr, CURLOPT_URL,$strUrlr);
     curl_setopt($chr, CURLOPT_HEADER, false);
     curl_setopt($chr, CURLOPT_POST, true);
     curl_setopt($chr, CURLOPT_HTTPHEADER, $arrayHeaderr);
     curl_setopt($chr, CURLOPT_POSTFIELDS, json_encode($arrayReplyData));
     curl_setopt($chr, CURLOPT_RETURNTRANSFER,true);
     curl_setopt($chr, CURLOPT_SSL_VERIFYPEER, false);
     $result = curl_exec($chr);
     curl_close ($chr);
  }
  function pushMsg($arrayHeaderp,$arrayPushData){
   $strUrlp = "https://api.line.me/v2/bot/message/push";
   $chp = curl_init();
   curl_setopt($chp, CURLOPT_URL,$strUrlp);
   curl_setopt($chp, CURLOPT_HEADER, false);
   curl_setopt($chp, CURLOPT_POST, true);
   curl_setopt($chp, CURLOPT_HTTPHEADER, $arrayHeaderp);
   curl_setopt($chp, CURLOPT_POSTFIELDS, json_encode($arrayPushData));
   curl_setopt($chp, CURLOPT_RETURNTRANSFER,true);
   curl_setopt($chp, CURLOPT_SSL_VERIFYPEER, false);
   $result = curl_exec($chp);
   curl_close ($chp);
  }
    exit;

?>
