<?php

//
// F L Y N N — v0.56
//
// "Algorithms" file
// this file contains all the algorithms the program works with
//

//Преобразуем текстовое сообщение в массив
//В процессе преобразования переводим все слова в нижний регистр, удаляем лишние символы, лишние пробелы
$message_aii = explode(" ", mb_strtolower(FLN_RECIEVED_MESSAGE));
$msg_stripped = str_split(mb_strtolower(FLN_RECIEVED_MESSAGE));
$restricted = str_split(",./';:\"\\<>[]{}!@#$%^&*()_+№-=~`|?");
                                                                                                                                                                                                                        $forbidden = ['блять', 'сука', 'хуй', 'пизда', 'ебать', 'пиздец', 'охуеть', 'бля', 'блядь', 'ебаный', 'суки'];
$new_msg = '';
foreach ($msg_stripped as $char) if (!in_array($char, $restricted)) $new_msg .= $char;
$message = explode(" ", $new_msg);

//Функция для проверки на наличие или отсутствие конкретного слова в сообщении
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
        $trigger = false;
        foreach ($words as $word) if (!in_array($word, $message)) $trigger = true;
    } return $trigger;
}

// Функция, возвращающая случайный элемент массива
function getr($arr) { return $arr[rand(0, sizeof($arr))]; }

// Функция, возвращающая содержимое текстового файла в папке
function ifile($name) {
    if (!file_exists("info/$name.txt") || file_get_contents("http://lnx.pw/vk/info/{$name}.txt") == "") return "Данные ещё не были записаны в этот файл. Попробуйте позже";
    return file_get_contents("http://lnx.pw/vk/info/{$name}.txt");
}

function calc($metric_out) {
    global $message, $message_aii;
    $numb =  floatval($message_aii[array_search("в", $message) + 1]);
    $calculation = 0;
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
    } elseif (array_search("парсек", $message)) {
        $met_in = "парсек";
        $metric_in_volume = 1 / 9460730472580.8 / 3.26;
    } elseif (array_search("астрономических", $message) && array_search("единиц", $message)) {
        $met_in = "астрономических единиц";
        $metric_in_volume = 1 / 149597870.7;
    }
    if ($status_ok) {
        if ($metric_out == "light_years") {
            $calculation = round($numb * $metric_in_volume * 9460730472580.8, 2);
            $met_out = "световых годах";
        } elseif ($metric_out == "au") {
            $calculation = round($numb * $metric_in_volume * 9460730472580.8 / 63241.1, 2);
            $met_out = "астрономических единицах";
        } elseif ($metric_out == "parsec") {
            $calculation = round($numb * $metric_in_volume * 9460730472580.8 * 3.26, 2);
            $met_out = "парсеках";
        } elseif ($metric_out == "light_days") {
            $calculation = round($numb * $metric_in_volume * 9460730472580.8 / 365, 2);
            $met_out = "световых днях";
        }
        return "В " . implode(" ", [$numb, $met_out, $calculation, $met_in]);
    } else return "Ошибка";
}

//Функция для отправки сообщения
function send($reply, $attach) {
    $request_params = array(
        'message' => $reply,
        'user_id' => FLN_USER_ID,
        'access_token' => FLN_ACCESS_TOKEN,
        'v' => FLN_VKAPI_VERSION,
        'random_id' => FLN_RANDOM_NUMBER,
        'attachment' => $attach
    );
    $get_params = http_build_query($request_params);
    sleep(1);
    file_get_contents('https://api.vk.com/method/messages.send?' . $get_params);
}

?>
