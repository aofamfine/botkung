<?php
session_start();
date_default_timezone_set("Asia/Bangkok"); 
ini_set("display_errors",1);  

function replyMsg($arrayPostData){     

    $access_token ="qd7DzGzDJYSZUh3pxo53LdMgfFpR+Za3HroBRcktSBgycysbECLYbQ0T9zXT2S7CWYcqiNNKWKxR7LWh1H11Qzl2/fvJZwPYlgVTYDxaDAD9BEe0o/81VJFhKh+Z1irwlZHouBQBh/R9K1HsTQ9RVgdB04t89/1O/w1cDnyilFU=";
    $reply_url = "https://api.line.me/v2/bot/message/reply";

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => $reply_url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => json_encode($arrayPostData),
      CURLOPT_HTTPHEADER => array(
        "authorization: Bearer ".$access_token,
        "cache-control: no-cache",
        "content-type: application/json; charset=UTF-8",            
      ),          
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
}

$input = json_decode(file_get_contents('php://input'));
$event_type = $input->events[0]->type;        

if($event_type == "message"){

    $replyToken = isset($input->events[0]->replyToken) ? $input->events[0]->replyToken : null;
    $message_type = isset($input->events[0]->message->type) ? $input->events[0]->message->type : null;
    $message_text = isset($input->events[0]->message->text) ? $input->events[0]->message->text : null;   
  
    if($message_type == "text") {
                    
        if($message_text == "botkung" || $message_text == "Botkung"){

            $message_reply = 'ค้าบบผม {-0_0-}';
            $arrayPostData =[];
            $arrayPostData['replyToken'] = $replyToken;
            $arrayPostData['messages'][0]['type']  = "text";
            $arrayPostData['messages'][0]['text'] = $message_reply;
            replyMsg($arrayPostData);  

        }
        else if($message_text == "bot" || $message_text == "โหลๆ" || $message_text == "น้องบอท" || $message_text == "น้องคุง"|| $message_text == "บอท"){

            $message_reply = 'ค้าบบ';
            $arrayPostData =[];
            $arrayPostData['replyToken'] = $replyToken;
            $arrayPostData['messages'][0]['type']  = "text";
            $arrayPostData['messages'][0]['text'] = $message_reply;
            replyMsg($arrayPostData);  
        }       
        else if($message_text == "100" || $message_text == "100ชั้น" || $message_text == "ดันกิล" || $message_text == "โอลาเคิล" || $message_text == "oracle"){

            $date = date('Y-m-d');
            $dateday =  date('w', strtotime($date ));

            if($dateday == 1){

                  if(date('H') >= 10){
                    $imgurl1 = 'imgdata/one_hundred_class_MVP.jpg';
                    // $imgurl1 = 'imgdata/one_hundred_class_mini.jpg';
                    $imgurl2 = 'imgdata/Dungeon.jpg';
                    $arrayPostData =[];
                    $arrayPostData['replyToken'] = $replyToken;
                    $arrayPostData['messages'][0]['type']  = "image";
  
                    for($i = 1; $i <= 2; $i++){
  
                      $arrayPostData['messages'][0]['originalContentUrl'] = $imgurl.$i;
                      $arrayPostData['messages'][0]['previewImageUrl'] = $imgurl.$i;
                      replyMsg($arrayPostData); 
  
                    }  
                  }
                  else{
                    $message_reply = "เดี๋ยวรอข้อมูลก่อนนะค้าบบ";
                    $arrayPostData =[];
                    $arrayPostData['replyToken'] = $replyToken;
                    $arrayPostData['messages'][0]['type']  = "text";
                    $arrayPostData['messages'][0]['text'] = $message_reply;
                    replyMsg($arrayPostData); 
                  }
            }
            else{

                  $imgurl1 = 'imgdata/one_hundred_class_MVP.jpg';
                  // $imgurl1 = 'imgdata/one_hundred_class_mini.jpg';
                  $imgurl2 = 'imgdata/Dungeon.jpg';
                  $arrayPostData =[];
                  $arrayPostData['replyToken'] = $replyToken;
                  $arrayPostData['messages'][0]['type']  = "image";

                  for($i = 1; $i <= 2; $i++){

                    $arrayPostData['messages'][0]['originalContentUrl'] = $imgurl.$i;
                    $arrayPostData['messages'][0]['previewImageUrl'] = $imgurl.$i;
                    replyMsg($arrayPostData); 

                  }            
            }           

        } 
    }


} //END message

?>