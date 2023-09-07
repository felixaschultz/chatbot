<?php
    if(isset($_GET["chat"])){
        $id = $_GET["chat"];
        $username = $_SESSION["email"];
        $chatSQL = "SELECT * FROM chats WHERE user = '$username' ORDER BY created_at DESC";
        $query = mysqli_query($db, $chatSQL);

        while($row = $query->fetch_assoc()){
            echo "<a href='?chat=".$row["chat_id"]."' class='lq-question'>".$row["chat_name"]."</a>";
        }
    }
?>