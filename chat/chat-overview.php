<?php
    if(isset($_GET["chat"])){
        $id = $_GET["chat"];
        $chatSQL = "SELECT * FROM answers WHERE chat_id = $id";
        $query = mysqli_query($db, $chatSQL);
        $num = mysqli_num_rows($query);


        if($num === 0){
            echo "<h2>Try with telling me your name and see what I answer.</h2>";
        }

        while($row = $query->fetch_assoc()){
            echo '<article class="chat-message-container --user">
                        <section class="chat-message">
                            '. $row["question"] .'
                        </section>
                        <img src="'. $_SESSION["profile"] .'" class="userprofile">
                    </article>';
                    echo '<article class="chat-message-container --bot">
                        <section class="chat-message">
                            '. $row["answer"] .'
                        </section>
                        <p class="chat-user">'.$botname.'</p>
                    </article>';
        }
    }
?>  