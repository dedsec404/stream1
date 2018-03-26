<?php
require 'conf.php';

function dencrypt($code) {
    global $secret_key, $secret_iv;
    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);	
    return openssl_decrypt(base64_decode($code), $encrypt_method, $key, 0, $iv);
}


function encrypt($code) {
    global $secret_key, $secret_iv;
    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);	
    return  base64_encode(openssl_encrypt($code,$encrypt_method, $key, 0, $iv));
}


