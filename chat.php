<?php
    header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Allow-Methods: GET, POST");
	header("Access-Control-Allow-Headers: Content-Type");
    session_start();

    $questions = [];
    $answer = "";

    $id = json_decode(file_get_contents("php://input"), true)["id"];
    $question = json_decode(file_get_contents("php://input"), true)["message"];
    if($question == "What is the meaning of life?"){
        $answer .= 42;
    }

    if(str_contains(strtolower($question),"moin") ||
    str_contains(strtolower($question),"mojn")){
        $answer .= "Moin, do";
    }

    if($question == "What is your name?"){
        $answer .= "Chatbot";
    }

    if(str_contains(strtolower($question), "fsdk")){
        $answer .= "My answer doesn´t convern!";
    }

    if($question == "How old are you?"){
        $answer .= "My age is not relevant for you to know!";
    }

    if(str_contains($question, "profession")){
        $answer .= "I don´t know the word profession? Please ask me something else.";
    }

    if(!isset($_SESSION["chats"])){
        $_SESSION["chats"] = array(
            [
                "id" => $id,
                "question" => $question,
            ]
        );
    }else{
        if(!in_array_recursive($id, $_SESSION["chats"], true)){
            array_push($_SESSION["chats"], [
                "id" => $id,
                "question" => $question,
            ]);
        }
    }

    if(!isset($_SESSION["answer"])){
        $_SESSION["answer"] = array(
            [
                "question" => $question,
                "answer" => $answer,
                "chat_id" => $id
            ]
        );
    }else{
        array_push($_SESSION["answer"], [
            "question" => $question,
            "answer" => $answer,
            "chat_id" => $id
        ]);
    }

    /* Fra PHP.net */
    function in_array_recursive(mixed $needle, array $haystack, bool $strict): bool
    {
        foreach ($haystack as $element) {
            if ($element === $needle) {
                return true;
            }

            $isFound = false;
            if (is_array($element)) {
                $isFound = in_array_recursive($needle, $element, $strict);
            }
            
            if ($isFound === true) {
                return true;
            }
        }

        return false;
    }

    echo json_encode($answer);
?>