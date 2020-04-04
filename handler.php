<?php

//
// F L Y N N — Requests handler v0.62
//
if (!isset($_REQUEST)) return;


// Including data & config files
require_once "data.php";
require_once "config.php";

$appSettings = _getSettings("flynn");
if (!$appSettings['activity']) _callback_response("Application activity status is false");

// Receiving and decoding the notification
$event = _callback_getEvent();
try {
    switch ($event['type']) {
        // If it's a confirmation event..
        case CALLBACK_API_EVENT_CONFIRMATION:
            //..then send the server a confirmation token
            if ($event['secret'] == FLN_SECRET_KEY) _callback_response(FLN_CONFIRMATION_TOKEN);
        break;
    
        // If it's a new message..
        case CALLBACK_API_EVENT_NEW_MESSAGE:
            // Whitelist of IDs
            $app_settings = _getSettings('flynn');
            define("WHITELIST", $app_settings['whitelist']);
            define("BLACKLIST", $app_settings['blacklist']);
            define("FLN_RECIEVED_MESSAGE", $event['object']['message']['text']);
            define("FLN_MSG_ID", $event['object']['message']['id']);
            
            define("FLN_ATTACHMENTS", $event['object']['message']['attachments']);
            define("FLN_ATTACHMENTS_AMOUNT", count(FLN_ATTACHMENTS));
            $dataTypes = ['sticker', 'doc', 'photo', 'video', 'audio', 'graffiti', 'audio_message', 'wall', 'fwd_messages', 'geo', 'podcast', 'link'];
            if (FLN_ATTACHMENTS_AMOUNT) define("FLN_MESSAGE_ATTACHMENT_TYPE", FLN_ATTACHMENTS[0]['type']);
            elseif (isset($event['object']['message']['fwd_messages']) && count($event['object']['message']['fwd_messages'])) define("FLN_MESSAGE_ATTACHMENT_TYPE", "fwd_messages");
            elseif (isset($event['object']['message']['geo'])) define("FLN_MESSAGE_ATTACHMENT_TYPE", "geo");
            else define("FLN_MESSAGE_ATTACHMENT_TYPE", "none");
            if (FLN_RECIEVED_MESSAGE == "") define("FLN_MESSAGE_EMPTY", true);
            else define("FLN_MESSAGE_EMPTY", false);
            
            if (FLN_MESSAGE_ATTACHMENT_TYPE == 'sticker') define("FLN_STICKER_ID", FLN_ATTACHMENTS[0]['sticker']['product_id'] . "_" . FLN_ATTACHMENTS[0]['sticker']['sticker_id']);
            else define("FLN_STICKER_ID", "none");
            
            //..getting the ID of a sender
            define("FLN_USER_ID", $event['object']['message']['from_id']);
            // and the getting information about the user
            $userInfo = _vkApi_call('users.get', array(
                'access_token' => FLN_ACCESS_TOKEN,
                'user_ids' => FLN_USER_ID
            ));

            // also getting user's first and last names
            define("FLN_USER_FIRST_NAME", $userInfo[0]['first_name']);
            define("FLN_USER_LAST_NAME", $userInfo[0]['last_name']);
            
            // Including algorithms & cases files
            require_once "algorithms.php";
            require_once "cases.php";
            checkUser(FLN_USER_ID);
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
        
        case CALLBACK_API_EVENT_TYPING:
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
