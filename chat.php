<?php
    header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Allow-Methods: GET, POST");
	header("Access-Control-Allow-Headers: Content-Type");

    $inputData = file_get_contents("php://input");
    $answer = "";
    if($inputData == "What is the meaning of life?"){
        $answer = 42;
    }

    if($inputData == "What is your name?"){
        $answer = "I can´t answer it at the moment";
    }


    echo json_encode($answer);
?>