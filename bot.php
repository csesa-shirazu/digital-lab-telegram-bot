<?php
ob_start();

$API_KEY = 'TOKEN HERE';
define('API_KEY',$API_KEY);
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
function SendMessage($chatid,$text,$parsmde,$keyboard,$message_id){
    bot('sendMessage',[
        'chat_id'=>$chatid,
        'text'=>$text,
        'parse_mode'=>$parsmde,
        'reply_markup'=>$keyboard,
        'message_id'=>$message->message_id
    ]);
}
function SendPhoto($chatid,$photo,$keyboard,$caption){
    bot('SendPhoto',[
        'chat_id'=>$chatid,
        'photo'=>$photo,
        'caption'=>$caption,
        'reply_markup'=>$keyboard
    ]);
}
function SendAudio($chatid,$audio,$keyboard,$caption,$sazande,$title){
    bot('SendAudio',[
        'chat_id'=>$chatid,
        'audio'=>$audio,
        'caption'=>$caption,
        'performer'=>$sazande,
        'title'=>$title,
        'reply_markup'=>$keyboard
    ]);
}
function SendDocument($chatid,$document,$caption){
    bot('SendDocument',[
        'chat_id'=>$chatid,
        'document'=>$document,
        'caption'=>$caption,
    ]);
}
function SendVoice($chatid,$voice,$keyboard,$caption){
    bot('SendVoice',[
        'chat_id'=>$chatid,
        'voice'=>$voice,
        'caption'=>$caption,
        'reply_markup'=>$keyboard
    ]);
}
function SendVideo($chat_id, $video, $caption){
    bot('SendVideo',[
        'chat_id'=>$chat_id,
        'video'=>$video,
        'caption'=>$caption
    ]);
}

function SendAction($chat_id, $action){
	bot('sendchataction',[
	'chat_id'=>$chat_id,
	'action'=>$action
	]);
	}
	
function Forward($berekoja,$azchejaei,$kodompayam)
{
bot('ForwardMessage',[
'chat_id'=>$berekoja,
'from_chat_id'=>$azchejaei,
'message_id'=>$kodompayam
]);
}

function is_sticker($message){
    if ($message->sticker == true)
        return true;
    return false;
}  


function SendSticker($chatid,$sticker,$keyboard){
	bot('SendSticker',[
	'chat_id'=>$chatid,
	'sticker'=>$sticker,
	]);
}



## Developed by : @erfaansabouri ##

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$data = $update->callback_query->data;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$message_id = $message->message_id;
$sticker = $message->sticker;
$document = $message->document;
$entit = $message->entities;
$first_name = $message->from->first_name;
$last_name = $message->from->last_name;
$username = $message->from->username;
$text = $message->text;
$video = $update->message->video->file_id;
$voice = $update->message->voice->file_id;
$file = $update->message->document->file_id;
$music = $update->message->audio->file_id;
$rpto = $update->message->reply_to_message->forward_from->id;
$type = $update->message->chat->type;
$self_done = false;
## Developed by : @erfaansabouri ##


function keyboard_maker($array){
    $counter = 0;
    $keyboard = [];
    while($row = $array[$counter]){
        $keyboard[$counter] = [['text' => $row]];
        $counter++;
    }
    return $keyboard;
}

$groups = ['گروه یک : يک شنبه-14:00:16:00' , 'گروه دو : سه شنبه-14:00:16:00' , 'گروه سه : چهار شنبه-08:00:10:00'];
if($text == '/start' || $text == 'بازگشت⤴️'){
    $groups_kb = keyboard_maker($groups);
    bot('sendmessage',[
    	'chat_id'=>$chat_id,
    	'text'=>"لطفا گروه کلاسی خود را انتخاب کنید.",
        'parse_mode'=>'MarkDown',
    	'reply_markup'=>json_encode([
    	    'resize_keyboard'=>true,
    	    'one_time_keyboard'=>true,
    	    'keyboard'=>$groups_kb,
    	])  
	]);
}


// Group a : Sina
if($text == $groups[0]){
    
    $xml=simplexml_load_file("db1.xml");
    $i=0;
    $names = [];
    while($item = $xml->student[$i]){
        $fullname = $item->Name.' '.$item->Family;
        array_push($names , $fullname);
        $i++;
    }
    array_push($names , 'بازگشت⤴️');
    $keyboard_name = keyboard_maker($names);
    
    bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"برای مشاهده اطلاعات ، نام خود را انتخاب کنید.",
    'parse_mode'=>'MarkDown',
	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>$keyboard_name,
	
	])
	]);
    
}

// Group B : Erfan
if($text == $groups[1]){
    
    $xml=simplexml_load_file("db2.xml");
    $i=0;
    $names = [];
    while($item = $xml->student[$i]){
        $fullname = $item->Name.' '.$item->Family;
        array_push($names , $fullname);
        $i++;
    }
    array_push($names , 'بازگشت⤴️');
    $keyboard_name = keyboard_maker($names);
    
    bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"برای مشاهده اطلاعات ، نام خود را انتخاب کنید.",
    'parse_mode'=>'MarkDown',
	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>$keyboard_name,
	
	])
	]);
    
}


// Group C : unknown
if($text == $groups[2]){
    
    $xml=simplexml_load_file("db3.xml");
    $i=0;
    $names = [];
    while($item = $xml->student[$i]){
        $fullname = $item->Name.' '.$item->Family;
        array_push($names , $fullname);
        $i++;
    }
    array_push($names , 'بازگشت⤴️');
    $keyboard_name = keyboard_maker($names);
    
    bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"برای مشاهده اطلاعات ، نام خود را انتخاب کنید.",
    'parse_mode'=>'MarkDown',
	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>$keyboard_name,
	
	])
	]);
    
}


else{
    $xml=simplexml_load_file("db1.xml");
    $i=0;
    $names = [];
    while($item = $xml->student[$i]){
        if($text == $item->Name.' '.$item->Family){
            SendMessage($chat_id,$item->Avg);
            return;
        }
        $i++;
    }
    
    $xml=simplexml_load_file("db2.xml");
    $i=0;
    $names = [];
    while($item = $xml->student[$i]){
        if($text == $item->Name.' '.$item->Family){
            SendMessage($chat_id,$item->Avg);
            return;
        }
        $i++;
    }
    
    $xml=simplexml_load_file("db3.xml");
    $i=0;
    $names = [];
    while($item = $xml->student[$i]){
        if($text == $item->Name.' '.$item->Family){
            SendMessage($chat_id,$item->Avg);
            return;
        }
        $i++;
    }
}

unlink("error_log");
?>
