<?php
    header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Allow-Methods: GET, POST");
	header("Access-Control-Allow-Headers: Content-Type");
    session_start();

    $answer = "";
    $chats = array();
    $allAnswers = array();

    
    if(isset(json_decode(file_get_contents("php://input"), true)["token"])){
        $token = json_decode(file_get_contents("php://input"), true)["token"];
        $_SESSION["name"] = $token["name"];
        $_SESSION["email"] = $token["email"];
        $_SESSION["profile"] = $token["image"];
        $_SESSION["logged_in"] = true;
        echo "logged_in";
    }else if(isset(json_decode(file_get_contents("php://input"), true)["email"])){
        $email = json_decode(file_get_contents("php://input"), true)["email"];
        $_SESSION["email"] = $email;
        $_SESSION["logged_in"] = true;
        echo "logged_in";
    }
?>