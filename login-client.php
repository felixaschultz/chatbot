<?php
    header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Allow-Methods: GET, POST");
	header("Access-Control-Allow-Headers: Content-Type");
    session_start();

    $answer = "";
    $chats = array();
    $allAnswers = array();

    $token = json_decode(file_get_contents("php://input"), true)["token"];

    if(isset($token)){
        $_SESSION["name"] = $token["name"];
        $_SESSION["email"] = $token["email"];
        $_SESSION["profile"] = $token["image"];
        $_SESSION["logged_in"] = true;
        echo "logged_in";
    }
?>