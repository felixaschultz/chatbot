<?php
    header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Allow-Methods: GET, POST");
	header("Access-Control-Allow-Headers: Content-Type");
    session_start();

    $questions = [];
    
    $question = file_get_contents("php://input");
    $answer = "I don´t know what you´re talking about";
    if($question == "What is the meaning of life?"){
        $answer = 42;
    }

    if($question == "What is your name?"){
        $answer = "Chatbot";
    }

    if($question == "How old are you?"){
        $answer = "My age is not relevant for you to know!";
    }

    if(str_contains($question, "profession")){
        $answer = "I don´t know the word profession? Please ask me something else.";
    }

    if(!isset($_SESSION["answer"])){
        $_SESSION["answer"] = array(
            [
                "question" => $question,
                "answer" => $answer
            ]
        );
    }else{
        array_push($_SESSION["answer"], [
            "question" => $question,
            "answer" => $answer
        ]);
    }

    echo json_encode(
        $answer
    );
?>