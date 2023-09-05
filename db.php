<?php
    $server = "mysql27.unoeuro.com";
    $user = "felix_schultz_dk";
    $password = "g9za2w5dRGeDm4ExFb3c";
    $database = "felix_schultz_dk_db";

    $db = mysqli_connect($server, $user, $password,$database);

    if(!$db){
        echo "Not Connect!";
        die();
    }
?>