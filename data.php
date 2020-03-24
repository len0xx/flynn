<?php

//
// F L Y N N — v0.58
//
// "Data" file 
// this file contains all the data used for connecting with server and sending messages
//

// Callback API constants
define("CALLBACK_API_EVENT_CONFIRMATION", "confirmation");
define("CALLBACK_API_EVENT_NEW_MESSAGE", "message_new");
define("CALLBACK_API_EVENT_REPLY", "message_reply");
define("CALLBACK_API_EVENT_USER_JOINED", "group_join");
define("CALLBACK_API_EVENT_USER_LEFT", "group_leave");
define("CALLBACK_API_EVENT_NEW_WALL_POST", "wall_post_new");

// FLYNN Tokens
define("FLN_CONFIRMATION_TOKEN", '8c6e3d3a');
define("FLN_ACCESS_TOKEN", '52ee9efe62283e2b61e96d008bc3d4000ed4721d545eb02c7eacd31f4e23daa817114eae859094f03fec4');
define("FLN_SECRET_KEY", 'FLNSPACE43');
define("FLN_VKAPI_VERSION", '5.103');
define("FLN_APPNAME", 'FLYNN');
define("FLN_CONVERSION_REQUIRED", true); // A flag that determines whether a script needs source message conversion or not
define("FLN_RANDOM_NUMBER", rand(100000, 999999)); // Random number (Required since VKAPI v5.90)

// TRON Tokens
define("TRN_CONFIRMATION_TOKEN", '5e350413');
define("TRN_ACCESS_TOKEN", 'f748c50b9abe514fee4435ab1297a84c98ea54f7bea1799e0d04ad5c6133d35f54a912929666f5ec77ed5');
define("TRN_SECRET_KEY", 'TRNSPACE43');
define("TRN_VKAPI_VERSION", FLN_VKAPI_VERSION);
define("TRN_APPNAME", 'TRON');
define("TRN_CONVERSION_REQUIRED", false);
define("TRN_RANDOM_NUMBER", rand(100000, 999999));

// KEVIN Tokens
define("KVN_CONFIRMATION_TOKEN", '83f6793f');
define("KVN_ACCESS_TOKEN", 'd852547f4c2716f186410918e4083efe357ed983c7e79cb4cbeb9ec39b14814cf81cdbdfd53558c47ab84');
define("KVN_SECRET_KEY", 'KVNSPACE43');
define("KVN_VKAPI_VERSION", FLN_VKAPI_VERSION);
define("KVN_CONVERSION_REQUIRED", false);
define("KVN_RANDOM_NUMBER", rand(100000, 999999));

?>
