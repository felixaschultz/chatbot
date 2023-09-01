<?php
    function llm($q){
        include("./general-infos.php");
        include("./black-list.php");
        //function to run an AI to answer some question of users
        $answers = "For that I do not have the answer yet.";

        if(str_contains(strtolower($q),"moin")
        || str_contains(strtolower($q),"mojn")
        ){
            $answers = "Moin";
        }

        if($q == "What is the meaning of life?"){
            $answers = 42;
        }

        if($q == "What is your name?"){
            $answers = $botname;
        }

        if($q == "How old are you?"){
            $answers = "I´m only a few days old. My programmers are working hard, to make me better.";
        }

        foreach($blacklistWords as $needle) {
            $found[$needle] = strpos(strtolower($q), $needle, 0);
            if($found){
                $answers = "For that I can´t provide you with an answer";
            }
        }

        return $answers;
    }
?>