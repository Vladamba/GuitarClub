<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$host = '127.0.0.1';
$user = 'root';
$password = 'BloomOfMetal666';
$dbname = 'main';
$charset = 'utf8mb4';

$nameMaxLen = 32;
$passwordMaxLen = 32;
$headerMaxLen = 128;
$messageMaxLen = 65536;

$mailurl = 'https://cssborka.ru/vladmail.php?';
session_start();