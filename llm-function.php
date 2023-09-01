<?php
    function llm($q){
        include("./general-infos.php");
        //function to run an AI to answer some question of users
        

        if(str_contains(strtolower($q),"moin")
        || str_contains(strtolower($q),"mojn")
        ){
            $answers = "Moin";
        }else{
            $answers = "For that I do not have the answer yet.";
        }

        if($q == "What is the meaning of life?"){
            $answers .= 42;
        }else{
            $answers = "For that I do not have the answer yet.";
        }

        if($q == "What is your name?"){
            $answers .= $botname;
        }else{
            $answers = "For that I do not have the answer yet.";
        }

        if(){
            
        }

        /*
    
        if(str_contains(strtolower($q),"moin") ||
        str_contains(strtolower($q),"mojn")){
            $answer .= "Moin, do";
        }
    
        if($q == "What is your name?"){
            $answer .= "Chatbot";
        }
    
        if(str_contains(strtolower($q), "fsdk")){
            $answer .= "My answer doesn´t convern!";
        }
    
        if($q == "How old are you?"){
            $answer .= "My age is not relevant for you to know!";
        }
    
        if(str_contains($q, "profession")){
            $answer .= "I don´t know the word profession? Please ask me something else.";
        } */

        return $answers;
    }
?>