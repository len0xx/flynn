<?php

//
// VKAPI
//

if (!isset($_REQUEST)) return;

// Including data file
require_once "data.php";

// Receiving and decoding the notification
$data = json_decode(file_get_contents('php://input'));
$msg = $data->object->message->text;

// Checking the secretKey
if(strcmp($data->secret, FLN_SECRET_KEY) !== 0 && strcmp($data->type, 'confirmation') !== 0) {
    echo("ok");
    return;
}

// Checking what's inside the "type" field
switch ($data->type) {
    //Если это уведомление для подтверждения адреса сервера...
    case 'confirmation':
        //...отправляем строку для подтверждения адреса
        echo FLN_CONFIRMATION_TOKEN;
        break;

    //Если это уведомление о новом сообщении...
    case 'message_new':
        //...получаем id его автора]
        define("FLN_USER_ID", $data->object->message->from_id);
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
        echo('ok');

        break;
}
?>
