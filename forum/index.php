<?php
require_once 'config.php';
require_once 'core.php';

$result = '';
if (isset($_POST['exit']))
{
    $_SESSION['logged'] = false;
}

if (isset($_POST['loginBtn'])) {
    $name = trim($_POST['name']);
    $password = trim($_POST['password']);

    if (mb_strlen($name) <= 0 || mb_strlen($name) >= $nameMaxLen) {
        $result = 'Bad name!';
    }

    if (mb_strlen($password) <= 0 || mb_strlen($password) >= $passwordMaxLen) {
        $result = 'Bad password!';
    }   

    if ($result == '') {
            if (check_user($_POST['name'], $_POST['password'])) {                
                $_SESSION['logged'] = true;
                $_SESSION['name'] = $_POST['name'];
        } 
        else {
            $result = 'User not found';
        }
    }
}

if (isset($_POST['createBtn'])) {
    $name = trim($_POST['name']);
    $password = trim($_POST['password']);
    $number = trim($_POST['number']);

    if (mb_strlen($name) <= 0 || mb_strlen($name) >= $nameMaxLen) {
        $result = 'Bad name!';
    }

    if (mb_strlen($password) <= 0 || mb_strlen($password) >= $passwordMaxLen) {
        $result = 'Bad password!';
    }   

    if ($result == '') {
        if (check_user_name($name)) {
            if ($number == $_SESSION['number']) {
                $clientNumber = rand(1000, 9999);                     
                $_SESSION['logged'] = true;
                $_SESSION['name'] = $name;   

                $sql = 'INSERT INTO `users`(`name`, `email`, `password`) VALUES (:name, :email, :password)';
                $query = $pdo->prepare($sql);
                $query->execute([':name' => $name, ':email' => $_POST['email'], ':password' => hash('sha256', $password)]);
            }
            else {
                $result = 'Incorrect number';
            }
        } 
        else {
            $result = 'Name is already taken';
        }
    }
}


if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) { 
    if (isset($_POST['create']))
    {
        $header = trim($_POST['header']);
        $message = trim($_POST['message']);

        if (mb_strlen($header) <= 0 || mb_strlen($header) >= $headerMaxLen) {
            $result = 'Bad header!';
        }

        if (mb_strlen($message) <= 0 || mb_strlen($message) >= $messageMaxLen) {
            $result = 'Bad message!';
        }
        
        if (preg_match('/^(https?|http):\/\/[^\s\/]+?\.[^\s\/]+\/?.*$/i', $message)){
            $result = 'Message must not contain links!';
        }

        if ($result == '') {
            $sql = 'INSERT INTO `messages`(`name`, `header`, `message`) VALUES (:name, :header, :message)';
            $query = $pdo->prepare($sql);
            $query->execute([':name' => $_SESSION['name'], ':header' => $header, ':message' => $message]);
            $result = 'Published successfully';

            /*$url = $mailurl;
            $data = [
              'to' => $_SESSION['email'],
              'subject' => 'Published successfully',
              'message' => $header.PHP_EOL.$message
            ];

            $url = $url.http_build_query($data);
            file_get_contents($url);*/
        } 
    }

    $content = file_get_contents('main.tpl');
    $content = str_replace('{messages}', get_messages(), $content);
    $content = str_replace('{result}', $result, $content);
    
    $content = str_replace('{header}', isset($_POST['header']) ? $_POST['header'] : '', $content);
    $content = str_replace('{message}', isset($_POST['message']) ? $_POST['message'] : '', $content);
}
else {
    if (isset($_POST['sendBtn'])) {  
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $number = rand(1000, 9999);
            $_SESSION['number'] = $number;
            $url = $mailurl;
            $data = [
              'to' => $_POST['email'],
              'subject' => 'Your secret number',
              'message' => $number
            ];

            $url = $url.http_build_query($data);
            echo file_get_contents($url);   
        } 
        else {
            $result = 'Email is incorrect';
        }
    }

    $content = file_get_contents('login.tpl');
    $content = str_replace('{result}', $result, $content);

    $content = str_replace('{name}', isset($_POST['name']) ? $_POST['name'] : '', $content);
    $content = str_replace('{password}', isset($_POST['password']) ? $_POST['password'] : '', $content);
    $content = str_replace('{email}', isset($_POST['email']) ? $_POST['email'] : '', $content);
}

$header_footer = file_get_contents('../header_footer.tpl');
$header_footer = str_replace('{content}', $content, $header_footer);
echo $header_footer;

unset($pdo);