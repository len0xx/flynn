<?php

//
// F L Y N N — v0.52
//
// "Data" file 
// this file contains all the data used for connecting with server and sending messages
//

//Коды, секретные слова и прочая документация
define("FLN_CONFIRMATION_TOKEN", '8c6e3d3a');
define("FLN_ACCESS_TOKEN", '52ee9efe62283e2b61e96d008bc3d4000ed4721d545eb02c7eacd31f4e23daa817114eae859094f03fec4');
define("FLN_SECRET_KEY", 'FLNSPACE43');
define("FLN_VKAPI_VERSION", '5.103');
// Генерируем случайное шестизначное число (Обязательный параметр с версии 5.90)
define("FLN_RANDOM_NUMBER", rand(100000, 999999));

define("CALLBACK_API_EVENT_CONFIRMATION", "confirmation");
define("CALLBACK_API_EVENT_NEW_MESSAGE", "message_new");
define("CALLBACK_API_EVENT_REPLY", "message_reply");
?>
