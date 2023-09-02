<?php
    function llm($q){
        include("./general-infos.php");
        include("./black-list.php");
        include("./jokes.php");
        $createdOn = "2023-08-28";
        //function to run an AI to answer some question of users
        $answers = "For that I do not have the answer yet.";
        $strpattern = '/\b(calculate|calculation)\b/i';
        $mathpattern = '/[-+]?\d+(\.\d+)?\s*[\/*+-]\s*[-+]?\d+(\.\d+)?/';
        $birthdate = new DateTime($createdOn);
        // Get the current date
        $currentDate = new DateTime();

        // Calculate the difference between the current date and the birthday
        $age = $birthdate->diff($currentDate)->y;
        $createdOn = date("d. m Y", strtotime($createdOn));
        

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
            $answers = "I´m {$age} years old. I was born on {$createdOn} and I´m being currently developed by my Master!";
        } else if(str_contains(strtolower($q), "your purpose")){
            $answers = "My purpose is to serve you with some basic information. My developer has worked som simply statements in
            for you to test. I will do my best to learn more infos for you.";
        } else if(strtolower($q) == "tell me a joke"){
            $answers = $jokes[array_rand($jokes)];
        }

        if(preg_match('/convert (\d+) (fahrenheit|celcius|celsius) to (fahrenheit|celcius|celsius)/i', $q, $convert)){
            $value = intval($convert[1]);
            $fromUnit = strtolower($convert[2]);
            $toUnit = strtolower($convert[3]);
            if ($fromUnit === "fahrenheit" && $toUnit === "celsius" || $toUnit === "celcius" && $fromUnit === "fahrenheit") {
                $result = floatval(($value - 32) * 5/9);
                $answers = "$value Fahrenheit is equal to $result Celsius";
                $answers = "
                    To convert $value degrees Fahrenheit to Celsius, you can use the following formula:<br>
                    °C=(°F−32)× 9/5 <br>
                    Let us calculate that: <br>
                    °C=({$value}°F−32)× 9/5 =(−27°F)× 9/5={$result}°C <br><br>
                    So, $value degrees Fahrenheit is equal to $result degrees Celsius.
                ";
            } elseif ($fromUnit === "celsius" && $toUnit === "fahrenheit" || $toUnit === "fahrenheit" && $fromUnit === "celcius") {
                $result = floatval(($value * 9/5) + 32);
                /* $answers = "$value Celsius is equal to $result Fahrenheit"; */
                $answers = "
                    To convert $value degrees Celsius to Fahrenheit, you can use the following formula:<br>
                    °F=(°C×5/9)+32 <br>
                    Let us calculate that: <br>
                    °F=({$value}°C×9/5)+32 = ({($value * 9/5)}°F) + 32 = {$result}°F<br><br>
                    So, $value degrees Celsius is equal to $result degrees Fahrenheit.
                ";
            }
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
                $answers = "The square root of $number is: $result";
            }
        } else if(preg_match_all('/(calculate|calculate the|what\'s the|what is the) square root of (\d+(\.\d+)?)/i', str_replace("x", "*", $q), $sqaure)){
            for ($i = 0; $i < count($sqaure[0]); $i++) {
                $number = floatval($sqaure[2][$i]);
                $result = sqrt($number);
                
                $answers = "The square root of $number is: $result";
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