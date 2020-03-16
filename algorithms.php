<?php

//
// F L Y N N — v0.45
//
// "Algorithms" file
// this file contains all the algorithms the program works with
//

// β—function
function deform($ar) {
    if (count($ar)) {
        $new_ar = array();
        foreach ($ar as $el) {
            if (strlen($el) > 4) {
                $spl = str_split($el);
                $new_w = '';
                for ($i = 0; $i < count($spl) - 1; $i++) $new_w .= $spl[$i];
                array_push($new_ar, $new_w);
            } else array_push($new_ar, $el);
        } return $new_ar;
    }
}

//Преобразуем текстовое сообщение в массив
//В процессе преобразования переводим все слова в нижний регистр, удаляем лишние символы, лишние пробелы
$msg_stripped = str_split(mb_strtolower($msg));
$restricted = str_split(",./';:\"\\<>[]{}!@#$%^&*()_+№-=~`|?");
                                                                                                                                                                                                                        $forbidden = ['блять', 'сука', 'хуй', 'пизда', 'ебать', 'пиздец', 'охуеть', 'бля', 'блядь', 'ебаный', 'суки'];
$new_msg = '';
foreach ($msg_stripped as $char) if (!in_array($char, $restricted)) $new_msg .= $char;
$message = explode(" ", $new_msg);
if (count($message)) {
    global $message;
    $new_msg2 = array();
    foreach($message as $key => $value) if ($value != '') array_push($new_msg2, $value);
}

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
    file_get_contents('https://api.vk.com/method/messages.send?' . $get_params);
}

?>
