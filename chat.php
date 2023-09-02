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
    $bot = json_decode(file_get_contents("php://input"), true)["bot"];
    include("llm-function.php");

    if($bot == "gpt-3"){
        $api_key = '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';
        $url = 'https://api.openai.com/v1/chat/completions';
        $data = [
            'prompt' => $question,
            'max_tokens' => 50, // Adjust the number of tokens in the response
            "model" => "gpt-3.5-turbo",
        ];

        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $api_key,
        ];

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        $response_data = json_decode($response, true);

        if (isset($response_data['choices'][0]['content'])) {
            $answer = "GPT-3: ".$response_data['choices'][0]['content'];
        }else{
            $answer = "GPT-3: I'm sorry, I couldn't generate a response. " . $response_data['error'][0]['content'];
        }
    }else{
        $answer = llm($question);
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