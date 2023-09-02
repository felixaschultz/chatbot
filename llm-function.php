<?php
    function llm($q){
        include("./general-infos.php");
        include("./black-list.php");
        include("./jokes.php");
        //function to run an AI to answer some question of users
        $answers = "For that I do not have the answer yet.";
        $strpattern = '/\b(calculate|calculation)\b/i';
        $mathpattern = '/[-+]?\d+(\.\d+)?\s*[\/*+-]\s*[-+]?\d+(\.\d+)?/';
        $answers = "For that I do not have the answer yet.";
        if(str_contains(strtolower($q),"moin")
        || str_contains(strtolower($q),"mojn")
        ){
            $answers = "Moin";
        } else if($q == "What is the meaning of life?"){
            $answers = 42;
        } else if($q == "What is your name?"){
            $answers = "Hi my name is ".$botname;
        } else if($q == "How old are you?"){
            $answers = "I´m only a few days old. My programmers are working hard, to make me better.";
        } else if(str_contains(strtolower($q), "your purpose")){
            $answers = "My purpose is to serve you with some basic information. My developer has worked som simply statements in
            for you to test. I will do my best to learn more infos for you.";
        } else if(strtolower($q) == "tell me a joke"){
            $answers = $jokes[array_rand($jokes)];
        }

        if(preg_match($strpattern, $q)){
            $pattern = '/(\d+\s*[\+\-\*\/]\s*\d+)/';
            
            if(preg_match($pattern, $q, $matches) || preg_match($mathpattern, str_replace("x", "*", $q), $matches)){
                $calculation = $matches[0];
                eval("\$result = $calculation;");
                $answers = "I have calulated ". $calculation ." and the anwser is ". $result;
            }
        }
        if (preg_match_all('/(calculate|what is the sqrt\()(\d+(\.\d+)?)(\)|\?)?/i', str_replace("x", "*", $q), $sqaure)) {
            foreach ($sqaure[2] as $match) {
                $number = floatval($match);
                $result = sqrt($number);
                $answers = "Square root of $number is: $result\n";
            }
        } else if(preg_match_all('/(calculate|calculate the|what\'s the|what is the) square root of (\d+(\.\d+)?)/i', str_replace("x", "*", $q), $sqaure)){
            for ($i = 0; $i < count($sqaure[0]); $i++) {
                $questionType = $sqaure[1][$i];
                $number = floatval($sqaure[2][$i]);
                $result = sqrt($number);
                
                $answers = "$questionType square root of $number is: $result";
            }
        }

        if(preg_match($mathpattern, str_replace("x", "*", $q), $matches)){
            $calculation = $matches[0];
            eval("\$result = $calculation;");
            $answers = "I have calulated ". $calculation ." and the anwser is ". $result;
        }
        if(preg_match('/[-+]?\d+(\.\d+)?\s*[\/*+-]\s*[-+]?\d+(\.\d+)?/', str_replace("x", "*", $q), $matches)){
            $calculation = $matches[0];
            eval("\$result = $calculation;");
            $answers = "I have calulated ". $calculation ." and the anwser is ". $result;
        }

        return $answers;
    }
?>