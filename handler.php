<?php

//
// F L Y N N — Requests handler v0.58
//
if (!isset($_REQUEST)) return;

// Including data & config files
require_once "data.php";
require_once "config.php";

// Receiving and decoding the notification
$event = _callback_getEvent();
// Checking the secretKey
if(strcmp($event['secret'], FLN_SECRET_KEY) !== 0 && strcmp($event['type'], CALLBACK_API_EVENT_CONFIRMATION) !== 0) _callback_response("ok");
    
try {
    switch ($event['type']) {
        // If it's a confirmation event..
        case CALLBACK_API_EVENT_CONFIRMATION:
            //..then send the server a confirmation token
            echo FLN_CONFIRMATION_TOKEN;
        break;
    
        // If it's a new message..
        case CALLBACK_API_EVENT_NEW_MESSAGE:
            define("FLN_RECIEVED_MESSAGE", $event['object']['message']['text']);
            
            $dataTypes = ['sticker', 'doc', 'photo', 'video', 'audio', 'graffiti', 'audio_message', 'wall', 'fwd_messages', 'geo'];
            if (count($event['object']['message']['attachments'])) define("FLN_MESSAGE_ATTACHMENT_TYPE", $event['object']['message']['attachments'][0]['type']);
            elseif (isset($event['object']['message']['fwd_messages']) && count($event['object']['message']['fwd_messages'])) define("FLN_MESSAGE_ATTACHMENT_TYPE", "fwd_messages");
            elseif (isset($event['object']['message']['geo'])) define("FLN_MESSAGE_ATTACHMENT_TYPE", "geo");
            else define("FLN_MESSAGE_ATTACHMENT_TYPE", "none");
            if (FLN_RECIEVED_MESSAGE == "") define("FLN_MESSAGE_EMPTY", true);
            else define("FLN_MESSAGE_EMPTY", false);
            
            if (FLN_MESSAGE_ATTACHMENT_TYPE == 'sticker') define("FLN_STICKER_ID", $event['object']['message']['attachments'][0]['sticker']['product_id'] . "_" . $event['object']['message']['attachments'][0]['sticker']['sticker_id']);
            else define("FLN_STICKER_ID", "none");
            
            //..getting the ID of a sender
            define("FLN_USER_ID", $event['object']['message']['from_id']);
            // and the getting information about the user
            $userInfo = json_decode(file_get_contents("https://api.vk.com/method/users.get?access_token=".FLN_ACCESS_TOKEN."&user_ids=".FLN_USER_ID."&v=".FLN_VKAPI_VERSION));

            // also getting user's first and last names
            define("FLN_USER_FIRST_NAME", $userInfo->response[0]->first_name);
            define("FLN_USER_LAST_NAME", $userInfo->response[0]->last_name);
            
            // Including algorithms & cases files
            require_once "algorithms.php";
            require_once "cases.php";
            //Возвращаем "ok" серверу Callback API
            _callback_response('ok');
    
        break;

        case CALLBACK_API_EVENT_REPLY:
            // Incase it's a message reply notification, send "ok" to the server 
            _callback_response("ok");
        break;
        
        case CALLBACK_API_EVENT_USER_JOINED:
            // Do something here
            _callback_response("ok");
        break;
        
        case CALLBACK_API_EVENT_USER_LEFT:
            // Do something here
            _callback_response("ok");
        break;
        
        case CALLBACK_API_EVENT_NEW_WALL_POST:
            // Do something here
            _callback_response("ok");
        break;
        
        default:
            _callback_response("Unsupported event: \"".$event['type']."\"");
        break;
    }
} catch (Exception $e) {
    log_error($e);
}
?>
