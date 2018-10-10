<?php
include_once 'vendor/autoload.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);
header("Content-Type: application/json");

use jdlc\telegram\TelegramBot;
echo TelegramBot::setWebHook();
