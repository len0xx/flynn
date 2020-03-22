<?php

//
// F L Y N N — v0.57
//
// "Config" file 
// this file contains all the functions used for handling the notification
//


// Function returns the "event" element decoded from JSON
function _callback_getEvent() {
    return json_decode(file_get_contents('php://input'), true);
}

// Function for exiting the script with $data message
function _callback_response($data) {
    exit($data);
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

?>