<?php
    header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Allow-Methods: GET, POST");
	header("Access-Control-Allow-Headers: Content-Type");
    session_start();

    $answer = "";

    $id = json_decode(file_get_contents("php://input"), true)["id"];
    $question = json_decode(file_get_contents("php://input"), true)["message"];
    $bot = json_decode(file_get_contents("php://input"), true)["bot"];
    $timestamp = date("Y-m-d H:i:s");
    $logged_in_user = json_decode(file_get_contents("php://input"), true)["user"];
    include("general-infos.php");
    include("llm-function.php");

    if($question == ""){
        return;
    }

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
            $error = "";
            if($response_data['error']["type"] == "insufficient_quota"){
                $error = "";
            }
            $answer = "GPT-3: I'm sorry, I couldn't generate a response. The monthly quota is reached.";
        }
    }else{
        $answer = Llm($question, $id);
    }

    $chatSQL = "SELECT * FROM chats WHERE chat_id = $id";
    $query = mysqli_query($db, $chatSQL);
    $num = mysqli_num_rows($query);
    $savedAnswer = htmlentities($answer);
    $savedQuestion = htmlentities($question);
    if($num === 0){
        $questions = "INSERT INTO chats(chat_name, created_at, user, chat_id, username) VALUES('$savedAnswer', '$timestamp', '$logged_in_user', '$id', null)";
        $answerQuery = mysqli_query($db, $questions);
    }else{
        $questions = "UPDATE chats SET chat_name = '$savedAnswer', created_at = '$timestamp' WHERE chat_id = $id";
        $answerQuery = mysqli_query($db, $questions);
    }

    $answers = "INSERT INTO answers(question, answer, chat_id, created_at) VALUES('$savedQuestion', '$savedAnswer', $id, '$timestamp')";
    $answerQuery = mysqli_query($db, $answers);
    $answer = $savedAnswer;

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