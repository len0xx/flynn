<?php

//
// VKAPI — Handler
//

if (!isset($_REQUEST)) return;

// Including data file 
require_once "data.php";

// Receiving and decoding the notification
$event = _callback_getEvent();
$msg = $event['object']['message']['text'];

function _callback_getEvent() {
    return json_decode(file_get_contents('php://input'), true);
}

function _callback_response($data) {
    echo $data;
    exit();
}

// Three functions for writing log files
function _log_write($message) {
    $trace = debug_backtrace();
    $function_name = isset($trace[2]) ? $trace[2]['function'] : '-';
    $mark = date("H:i:s") . ' [' . $function_name . ']';
    $log_name = '/log_' . date("j.n.Y") . '.txt';
    file_put_contents($log_name, $mark . " : " . $message . "\n", FILE_APPEND);
}

function log_msg($message) {
    if (is_array($message)) $message = json_encode($message);
    
    _log_write('[INFO] ' . $message);
}

function log_error($message) {
    if (is_array($message)) $message = json_encode($message);
    
    _log_write('[ERROR] ' . $message);
}

// Checking the secretKey
if(strcmp($event['secret'], FLN_SECRET_KEY) !== 0 && strcmp($event['type'], 'confirmation') !== 0) _callback_response("ok");

// Checking what's inside the "type" field
try {
    switch ($event['type']) {
        //Если это уведомление для подтверждения адреса сервера...
        case CALLBACK_API_EVENT_CONFIRMATION:
            //...отправляем строку для подтверждения адреса
            echo FLN_CONFIRMATION_TOKEN;
        break;
    
        //Если это уведомление о новом сообщении...
        case CALLBACK_API_EVENT_NEW_MESSAGE:
            //...получаем id его автора]
            define("FLN_USER_ID", $event['object']['message']['from_id']);
            //затем с помощью users.get получаем данные об авторе
            $userInfo = json_decode(file_get_contents("https://api.vk.com/method/users.get?access_token=".FLN_ACCESS_TOKEN."&user_ids=".FLN_USER_ID."&v=".FLN_VKAPI_VERSION));
    
            //и извлекаем из ответа его имя и фамилию
            define("FLN_USER_FIRST_NAME", $userInfo->response[0]->first_name);
            define("FLN_USER_LAST_NAME", $userInfo->response[0]->last_name);
    
            // Including algorithms file
            require_once "algorithms.php";
    
            // Including cases file
            require_once "cases.php";
    
            //Возвращаем "ok" серверу Callback API
            _callback_response('ok');
    
        break;

        case CALLBACK_API_EVENT_REPLY:
            _callback_response("Reply sent");
        break;
        default:
            _callback_response("Unsupported event");
        break;
    }
} catch (Exception $e) {
    log_error($e);
}
?>
