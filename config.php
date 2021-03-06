<?php

//
// F L Y N N — v0.62
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
    $log_name = 'log/log_' . date("j-n-Y") . '.txt';
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

function _vkApi_call($method, $params = array()) {
    $params['v'] = FLN_VKAPI_VERSION;
  
    $query = http_build_query($params);
    $url = VK_API_ENDPOINT.$method;
  
    $curl = curl_init($url);
    // Send a request using POST method
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $query);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($curl);
    $error = curl_error($curl);
    if ($error) {
            log_error($error);
      throw new Exception("Failed {$method} request");
    }
  
    curl_close($curl);
  
    $response = json_decode($json, true);
    if (!$response || !isset($response['response'])) {
            log_error($json);
      throw new Exception("Invalid response for {$method} request");
    }
  
    return $response['response'];
}

function _getSettings($app) {
    if ($app == "tron") $addition = "../"; 
    else $addition = "";
    return json_decode(file_get_contents($addition."settings.json"), true);
}

function _setSettings($app, $name, $value) {
    if ($app == "tron") $addition = "../"; 
    else $addition = "";
    $settings = json_decode(file_get_contents($addition."settings.json"), true);
    $settings[$name] = $value;
    file_put_contents($addition."settings.json", json_encode($settings));
}

?>