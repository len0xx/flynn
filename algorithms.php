<?php

//
// F L Y N N — v0.62
//
// "Algorithms" file
// this file contains all the algorithms the program works with
//

// A function that converts a string message into an array of lowercase words ..
// .. and gets rid of all the extra symbols
                                                                                                                                                                                        $forbidden = ['блять', 'бля', 'блядь', 'сука', 'суки', 'хуй', 'охуеть', 'охуел', 'охуела', 'охуело', 'хуевый', 'нихуя', 'пизда', 'пиздец', 'ебать', 'ебаный', 'пидр', 'пидор', 'пидарас', 'уебок', 'уебан', 'еблан', 'говно', 'мудак', 'шлюха', 'гандон', 'хули', 'чмо'];
function convert($str) {
    global $event;
    if (FLN_MESSAGE_ATTACHMENT_TYPE == 'fwd_messages' && FLN_MESSAGE_EMPTY) $str_up = $event['object']['message']['fwd_messages'][0]['text'];
    else $str_up = $str;
    $new_msg = '';
    foreach (str_split(mb_strtolower($str_up)) as $char) if (!in_array($char, str_split(",./';:\"\\<>[]{}!@#$%^&*()_+№-=~`|?"))) $new_msg .= $char;
    return explode(" ", $new_msg);
} if (FLN_CONVERSION_REQUIRED) $message = convert(FLN_RECIEVED_MESSAGE);

function checkUser($user_id) {
    $settings = _getSettings('flynn');
    if (!in_array($user_id, $settings['users'])) {
        array_push($settings['users'], $user_id);
        _setSettings('flynn', 'users', $settings['users']);
    }
}

function startsWith($string, $startString) { 
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
}

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

// A function that returns a certain amount of randomly chosen elements from given array
function getr_few($arr, $amount) {
    $numbers = [];
    $result = [];
    for ($i = 0; $i < $amount; $i++) {
        $y = rand(0, sizeof($arr));
        if (!in_array($y, $numbers)) array_push($numbers, $y);
        else {
            $y = rand(0, sizeof($arr));
            if (!in_array($y, $numbers)) array_push($numbers, $y);
            else {
                $y = rand(0, sizeof($arr));
                if (!in_array($y, $numbers)) array_push($numbers, $y);
            }
        } array_push($result, $arr[$numbers[$i]]);
    } return $result;
}

// A function that returns contains of a file
function ifile($name) {
    if (!file_exists("info/$name.txt") || file_get_contents("http://lnx.pw/vk/info/{$name}.txt") == "") return "Ошибка: Данные ещё не были записаны в этот файл. Попробуйте позже";
    return file_get_contents("http://lnx.pw/vk/info/{$name}.txt");
}

// A function for a better rounding
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

function isPrevMsg($cont) {
    $previousMsg = _vkApi_call('messages.getById', array(
        'message_ids'  => (int) FLN_MSG_ID - 1,
        'group_id' => FLN_GROUP_ID,
        'preview_length' => 0,
        'extended' => 0,
        'fields' => '',
        'access_token' => FLN_ACCESS_TOKEN
    ));
    return $previousMsg['items'][0]['text'] == $cont;
}

function tryAsking($key) {
    return "\n\nПопробуй также спросить: " . getr(FLN_QUESTIONS);
}

// A function for sending the reply
function send($app, $reply, $attach) {
    global $defaults;
    $userID = FLN_USER_ID;
    if (!in_array($userID, WHITELIST) || in_array($userID, BLACKLIST)) {
        $msg_reply = "Ваш ID не допущен к приложению. Попробуйте позже или свяжитесь с администратором";
        $attachment = "";
    } else {
        if ($reply == ifile("sun")) $msg_reply = $reply . tryAsking("any");
        else $msg_reply = $reply;
        $attachment = $attach;
    } if ($app == FLN_APPNAME) $access_token = FLN_ACCESS_TOKEN;
    else $access_token = TRN_ACCESS_TOKEN;
    if ($msg_reply === false) {
        _vkApi_call('messages.markAsRead', array(
            'start_message_id'  => FLN_MSG_ID,
            'peer_id' => $userID,
            'group_id' => FLN_GROUP_ID,
            'access_token' => $access_token
        ));
    } else {
        _vkApi_call('messages.send', array(
            'message'  => $msg_reply,
            'user_id' => $userID,
            'random_id' => rand(100000, 999999),
            'attachment' => $attachment,
            'access_token' => $access_token
        ));
        if ($app == FLN_APPNAME) {
            if (in_array($msg_reply, $defaults) && !rand(0, 2)) {
                _vkApi_call('messages.send', array(
                    'message'  => "Попробуй написать \"Список вопросов\", чтобы узнать, на какие сообщения я могу ответить",
                    'user_id' => $userID,
                    'random_id' => rand(100000, 999999),
                    'attachment' => $attachment,
                    'access_token' => $access_token
                ));
            }
        }
        
    }
}

?>
