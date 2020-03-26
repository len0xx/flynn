<?php

//
// F L Y N N — v0.59
//
// "Algorithms" file
// this file contains all the algorithms the program works with
//

// A function that converts a string message into an array of lowercase words ..
// .. and gets rid of all the extra symbols
                                                                                                                                                                                        $forbidden = ['блять', 'сука', 'хуй', 'пизда', 'ебать', 'пиздец', 'охуеть', 'бля', 'блядь', 'ебаный', 'суки'];
function convert($str) {
    global $event;
    if (FLN_MESSAGE_ATTACHMENT_TYPE == 'fwd_messages' && FLN_MESSAGE_EMPTY) $str_up = $event['object']['message']['fwd_messages'][0]['text'];
    else $str_up = $str;
    $new_msg = '';
    foreach (str_split(mb_strtolower($str_up)) as $char) if (!in_array($char, str_split(",./';:\"\\<>[]{}!@#$%^&*()_+№-=~`|?"))) $new_msg .= $char;
    return explode(" ", $new_msg);
} if (FLN_CONVERSION_REQUIRED) $message = convert(FLN_RECIEVED_MESSAGE);

// A function for checking whether the message contains the certain word 
function has($key, $words) {
    global $message;
    $trigger = true;
    if ($key == "and") {
        foreach ($words as $word) if (!in_array($word, $message)) $trigger = false;
        if ($trigger) for ($x = count($words) - 1; $x > 0; $x--) if (array_search($words[$x], $message) < array_search($words[$x - 1], $message)) $trigger = false;
    } elseif ($key == "and_uo") { // Unordered "AND"
        foreach ($words as $word) if (!in_array($word, $message)) $trigger = false;
    } elseif ($key == 'or') {
       $trigger = false;
       foreach ($words as $word) if (in_array($word, $message)) $trigger = true;
    } elseif ($key == 'only') {
        $trigger = false;
        if (in_array($words, $message) && count($message) == 1) $trigger = true;
    } elseif ($key == 'not') {
        $trigger = true;
        foreach ($words as $word) if (in_array($word, $message)) $trigger = false;
    } return $trigger;
}

// A function that returns a random element of an array
function getr($arr) { return $arr[rand(0, sizeof($arr))]; }

// A function that returns contains of a file
function ifile($name) {
    if (!file_exists("info/$name.txt") || file_get_contents("http://lnx.pw/vk/info/{$name}.txt") == "") return "Данные ещё не были записаны в этот файл. Попробуйте позже";
    return file_get_contents("http://lnx.pw/vk/info/{$name}.txt");
}

// A function of a better rounding
function _round($num) {
    if ($num < 0.01) return round($num, 6);
    else return round($num, 3);
}

// A function that converts different values
function calc($metric_out) {
    global $message, $event;
    if (FLN_MESSAGE_ATTACHMENT_TYPE == 'fwd_messages' && FLN_MESSAGE_EMPTY) $message_aii = explode(" ", mb_strtolower($event['object']['message']['fwd_messages'][0]['text']));
    else $message_aii = explode(" ", mb_strtolower(FLN_RECIEVED_MESSAGE));
    $numb = floatval($message_aii[array_search("в", $message) + 1]);
    $calculation = 0;
    $err_calc = false;
    if ($numb * 1 == 0) $err_calc = true;
    $met_in = "undefined";
    $met_out = "undefined";
    $status_ok = true;
    if (array_search("сантиметров", $message)) {
        $met_in = "сантиметров";
        $metric_in_volume = 1000000;
    } elseif (array_search("метров", $message)) {
        $met_in = "метров";
        $metric_in_volume = 1000;
    } elseif (array_search("километров", $message)) {
        $met_in = "километров";
        $metric_in_volume = 1;
    } elseif (array_search("световых", $message) && array_search("лет", $message)) {
        $met_in = "световых лет";
        $metric_in_volume = 1 / 9460730472580.8;
    } elseif (array_search("парсек", $message) || array_search("парсеков", $message)) {
        $met_in = "парсек";
        $metric_in_volume = 1 / 9460730472580.8 / 3.26;
    } elseif (array_search("астрономических", $message) && array_search("единиц", $message)) {
        $met_in = "астрономических единиц";
        $metric_in_volume = 1 / 149597870.7;
    } else $status_ok = false;
    if ($status_ok && !$err_calc) {
        if ($metric_out == "light_years" || $metric_out == "light_years1") {
            $calculation = _round($numb * $metric_in_volume * 9460730472580.8);
            $met_out = ($metric_out == "light_years" ? "световых годах" : "световом году");
        } elseif ($metric_out == "au" || $metric_out == "au1") {
            $calculation = _round($numb * $metric_in_volume * 9460730472580.8 / 63241.1);
            $met_out = ($metric_out == "au" ? "астрономических единицах" : "астрономической единице");
        } elseif ($metric_out == "parsec" || $metric_out == "parsec1") {
            $calculation = _round($numb * $metric_in_volume * 9460730472580.8 * 3.26);
            $met_out = ($metric_out == "parsec" ? "парсеках" : "парсеке");
        } elseif ($metric_out == "light_days" || $metric_out == "light_days") {
            $calculation = _round($numb * $metric_in_volume * 9460730472580.8 / 365);
            $met_out = ($metric_out == "light_days" ? "световых днях" : "световом дне");
        }
        return "В " . implode(" ", [$numb, $met_out, $calculation, $met_in]);
    } else {
        if ($err_calc) return "Указано неверное число.\n\nВведите корректное число, отличное от 0. Например:\nСколько световых лет в 12 парсеках?";
        elseif (!$status_ok) return "Указана неподдерживаемая единица измерения.\n\nСписок поддерживаемых: парсеки, световые годы, астрономические единицы";
    }
}

// A function for sending the reply
function send($app, $reply, $attach) {
    $userID = FLN_USER_ID;
    if (!in_array($userID, WHITELIST)) $msg_reply = "Ваш ID не допущен к приложению. Попробуйте позже или свяжитесь с администратором";
    else $msg_reply = $reply;
    if ($app == FLN_APPNAME) {
        $access_token = FLN_ACCESS_TOKEN;
        $ver = FLN_VKAPI_VERSION;
        $randomID = FLN_RANDOM_NUMBER;
    } else {
        $access_token = TRN_ACCESS_TOKEN;
        $ver = TRN_VKAPI_VERSION;
        $randomID = TRN_RANDOM_NUMBER;
    }
    if ($reply == "noreply") {
        $request_params = array(
            'start_message_id' => FLN_MSG_ID,
            'peer_id' => $userID,
            'access_token' => $access_token,
            'v' => $ver,
            'group_id' => FLN_GROUP_ID
        );
        $get_params = http_build_query($request_params);
        file_get_contents('https://api.vk.com/method/messages.markAsRead?' . $get_params);
    } else {
        $request_params = array(
            'message' => $msg_reply,
            'user_id' => $userID,
            'access_token' => $access_token,
            'v' => $ver,
            'random_id' => $randomID,
            'attachment' => $attach
        );
        $get_params = http_build_query($request_params);
        sleep(1);
        file_get_contents('https://api.vk.com/method/messages.send?' . $get_params);
    }
}

?>
