<?php
    function llm($q){
        include("./general-infos.php");
        include("./black-list.php");
        //function to run an AI to answer some question of users
        $answers = "For that I do not have the answer yet.";
        $strpattern = '/\b(calculate|calculation)\b/i';
        $mathpattern = '/[-+]?\d+(\.\d+)?\s*[\/*+-]\s*[-+]?\d+(\.\d+)?/';

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
        }

        if(preg_match($strpattern, $q)){
            $pattern = '/(\d+\s*[\+\-\*\/]\s*\d+)/';
            
            if(preg_match($pattern, $q, $matches) || preg_match($mathpattern, $q, $matches)){
                $calculation = $matches[0];
                eval("\$result = $calculation;");
                $answers = "The anwser is ". $result;
            }
        }

        if(preg_match($mathpattern, $q, $matches)){
            $calculation = $matches[0];
            eval("\$result = $calculation;");
            $answers = "The anwser is ". $result;
        }

        return $answers;
    }
?>