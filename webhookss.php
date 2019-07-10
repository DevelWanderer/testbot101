<?php // callback.php
require "vendor/autoload.php";
require_once('vendor/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');
$access_token = 'YmOTeNtLzS70P55TfovHyurPZc0jBcUGR4GSFlEqzJQmCbtsoAOurD6SFUbRG8MvHaAQV3gF/1Fj29KWMkHEpIQuUS1Wn4p18JW2Mjx4ky0XxqUgTVJ/x1qR9CR7UwuQ854y0cJhethnu3CPfPT9XQdB04t89/1O/w1cDnyilFU=';
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
//use LINE\LINEBot\Event;
//use LINE\LINEBot\Event\BaseEvent;
//use LINE\LINEBot\Event\MessageEvent;
use LINE\LINEBot\MessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use LINE\LINEBot\MessageBuilder\LocationMessageBuilder;
use LINE\LINEBot\MessageBuilder\AudioMessageBuilder;
use LINE\LINEBot\MessageBuilder\VideoMessageBuilder;
use LINE\LINEBot\ImagemapActionBuilder;
use LINE\LINEBot\ImagemapActionBuilder\AreaBuilder;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapMessageActionBuilder ;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapUriActionBuilder;
use LINE\LINEBot\MessageBuilder\Imagemap\BaseSizeBuilder;
use LINE\LINEBot\MessageBuilder\ImagemapMessageBuilder;
use LINE\LINEBot\MessageBuilder\MultiMessageBuilder;
use LINE\LINEBot\TemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\DatetimePickerTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselColumnTemplateBuilder;


// Get POST body content
$content = file_get_contents('php://input');
  $arrayJson = json_decode($content, true);
  $arrayHeaderr = array();
  $arrayHeaderr[] = "Content-Type: application/json";
  $arrayHeaderr[] = "Authorization: Bearer {$access_token}";
  $arrayHeader = array();
  $arrayHeader[] = "Content-Type: application/json";
  $arrayHeader[] = "Authorization: Bearer {$access_token}";
  $image_url = "https://wealththai.org/testbot101-master/image/38409924996_befaf1f33b_o.png/1040";
  //รับข้อความจากผู้ใช้
  $message = $arrayJson['events'][0]['message']['text'];
  //รับ id ของผู้ใช้
  $id = $arrayJson['events'][0]['source']['userId'];
  #ตัวอย่าง Message Type "Text + Sticker"
  if($message == "สวัสดี"){
     $arrayReplyData['replyToken'] = $arrayJson['events'][0]['replyToken'];
     $arrayReplyData['messages'][0]['type'] = "text";
     $arrayReplyData['messages'][0]['text'] = "สวัสดีจ้าาา".$id;
     $arrayReplyData['messages'][1]['type'] = "sticker";
     $arrayReplyData['messages'][1]['packageId'] = "2";
     $arrayReplyData['messages'][1]['stickerId'] = "34";
     replyMsg($arrayHeaderr,$arrayReplyData);
  }
  elseif($message == "วว"){
        $arrayReplyData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayReplyData  = new TemplateMessageBuilder('Confirm Template',
        new ConfirmTemplateBuilder(
                'Confirm template builder', // ข้อความแนะนำหรือบอกวิธีการ หรือคำอธิบาย
                array(
                    new MessageTemplateActionBuilder(
                        'Yes', // ข้อความสำหรับปุ่มแรก
                        'YES'  // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                    ),
                    new MessageTemplateActionBuilder(
                        'No', // ข้อความสำหรับปุ่มแรก
                        'NO' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                    )
                )
        )
    );


        replyMsg($arrayHeaderr,$arrayReplyData);
    }

    elseif($message == "*แมว*"){

      $arrayReplyData['replyToken'] = $arrayJson['events'][0]['replyToken'];
      $arrayReplyData['messages'][0]['type'] = "image";
      $arrayReplyData['messages'][0]['originalContentUrl'] = $image_url;
      $arrayReplyData['messages'][0]['previewImageUrl'] = $image_url;
      replyMsg($arrayHeaderr,$arrayReplyData);
    }
    elseif($message == "เทส"){
      $image_urla = "https://wealththai.org/testbot101-master/image/38409924996_befaf1f33b_o.png/1040";
      $arrayReplyData['replyToken'] = $arrayJson['events'][0]['replyToken'];
      $arrayReplyData['messages'][0]['type'] = "image";
      $arrayReplyData['messages'][0]['originalContentUrl'] = $image_urla;
      $arrayReplyData['messages'][0]['previewImageUrl'] = $image_urla;
      replyMsg($arrayHeaderr,$arrayReplyData);
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
         $resultr = curl_exec($chr);
         curl_close ($chr);
      }
        exit;
      function pushMsg($arrayHeader,$arrayPushData){
       $strUrlp = "https://api.line.me/v2/bot/message/push";
       $chp = curl_init();
       curl_setopt($chp, CURLOPT_URL,$strUrlp);
       curl_setopt($chp, CURLOPT_HEADER, false);
       curl_setopt($chp, CURLOPT_POST, true);
       curl_setopt($chp, CURLOPT_HTTPHEADER, $arrayHeader);
       curl_setopt($chp, CURLOPT_POSTFIELDS, json_encode($arrayPushData));
       curl_setopt($chp, CURLOPT_RETURNTRANSFER,true);
       curl_setopt($chp, CURLOPT_SSL_VERIFYPEER, false);
       $resultp = curl_exec($chp);
       curl_close ($chp);
      }
  exit;
?>
