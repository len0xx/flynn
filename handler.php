<?php

//
// F L Y N N — Requests handler v0.56
//

if (!isset($_REQUEST)) return;

// Including data & config files
require_once "data.php";
require_once "config.php";

// Receiving and decoding the notification
$event = _callback_getEvent();
define("FLN_RECIEVED_MESSAGE", $event['object']['message']['text']);
// Checking the secretKey
if(strcmp($event['secret'], FLN_SECRET_KEY) !== 0 && strcmp($event['type'], 'confirmation') !== 0) _callback_response("ok");
    
try {
    switch ($event['type']) {
        // If it's a confirmation event..
        case CALLBACK_API_EVENT_CONFIRMATION:
            //..then send the server a confirmation token
            echo FLN_CONFIRMATION_TOKEN;
        break;
    
        // If it's a new message..
        case CALLBACK_API_EVENT_NEW_MESSAGE:
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
        
        default:
            _callback_response("Unsupported event");
        break;
    }
} catch (Exception $e) {
    log_error($e);
}
?>
