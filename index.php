<?php
    session_start();
    $botname = "Chatbot 0.2 beta";
    if(!isset($_GET["chat"])){
        header("Location: ?chat=" . rand());
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $botname;?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="responsive.css">
    <link rel="apple-touch-icon" sizes="57x57" href="https://www.intastellarsolutions.com/assets/icons/fav/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="https://www.intastellarsolutions.com/assets/icons/fav/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="https://www.intastellarsolutions.com/assets/icons/fav/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="https://www.intastellarsolutions.com/assets/icons/fav/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="https://www.intastellarsolutions.com/assets/icons/fav/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="https://www.intastellarsolutions.com/assets/icons/fav/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="https://www.intastellarsolutions.com/assets/icons/fav/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="https://www.intastellarsolutions.com/assets/icons/fav/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="https://www.intastellarsolutions.com/assets/icons/fav/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="https://www.intastellarsolutions.com/assets/icons/fav/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://www.intastellarsolutions.com/assets/icons/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="https://www.intastellarsolutions.com/assets/icons/fav/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://www.intastellarsolutions.com/assets/icons/fav/favicon-16x16.png">
    <script>
        window.addEventListener("DOMContentLoaded", function (){
            document.querySelector(".message-container").scrollTop = document.querySelector(".message-container").scrollHeight;
        })
    </script>
</head>
<body class="container">
    <aside class="latest-questions">
        <header class="lq-header">
            <h1 class="chat-header-title"><?php echo $botname;?></h1>
            <a href="index.php" class="cta new-chat">New Chat</a>
        </header>
        <h2>Your recent chats</h2>
        <section class="lq-group">
            <p>August</p>
            <?php
                if(isset($_SESSION["chats"])){
                    foreach($_SESSION["chats"] as $chatid){
                        echo "<a href='?chat=".$chatid["id"]."' class='lq-question'>".$chatid["question"]."</a>";
                    }
                }
            ?>
            
        </section>
    </aside>
    <main class="chat-container">
        <header class="chat-header">
            <button class="menu">
                <span class="menu-line"></span>
                <span class="menu-line"></span>
                <span class="menu-line"></span>
            </button>
            <h2 class="mobile-headline"><?php echo $botname;?></h2>
        </header>
        <section class="message-container">
            <?php
                if(isset($_GET["chat"])){
                    /* if($_SESSION["answer"]["id"] === $_GET["chat"]){ */
                        if(isset($_SESSION["answer"]) && is_array($_SESSION["answer"])){
                            foreach($_SESSION["answer"] as $question){
                                if($question["chat_id"] == $_GET["chat"]){
                                    echo '<article class="chat-message-container --user">
                                        <section class="chat-message">
                                            '. $question["question"] .'
                                        </section>
                                        <p class="chat-user">You</p>
                                    </article>';
                                    echo '<article class="chat-message-container --bot">
                                        <section class="chat-message">
                                            '. $question["answer"] .'
                                        </section>
                                        <p class="chat-user">Chatbot</p>
                                    </article>';
                                }
                                
                            }
                        }
                    /* } */

                    /* 2063911979 */
                    /* 1121142122 */
                }
            ?>
        </section>
        <footer class="chat-footer">
            <form method="post" id="chatbot">
                <input type="hidden" name="id" id="id" value="<?php echo $_GET["chat"];?>">
                <section class="suggestions">
                    Suggestions:
                    <button data-question="What is your name?" class="question">
                        What is your name?
                    </button>
                    <button data-question="How old are you?" class="question">
                        How old are you?
                    </button>
                    <button data-question="What is the meaning of life?" class="question">
                        What is the meaning of life?
                    </button>
                </section>
                <label for="" class="chatbot-container">
                    <textarea class="chatbot-inputfield" placeholder="Type your message" name="message"  cols="30" rows="3"></textarea>
                    <button type="submit" class="chatbot-submitMessage"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="none" class="send-icon" stroke-width="2"><path d="M.5 1.163A1 1 0 0 1 1.97.28l12.868 6.837a1 1 0 0 1 0 1.766L1.969 15.72A1 1 0 0 1 .5 14.836V10.33a1 1 0 0 1 .816-.983L8.5 8 1.316 6.653A1 1 0 0 1 .5 5.67V1.163Z" fill="currentColor"></path></svg></button>
                </label>
            </form>
        </footer>
    </main>
    <script>
        const questionBtn = document.querySelectorAll(".question");
        const messageContainer = document.querySelector(".message-container");
        const form = document.querySelector("#chatbot");
        const message = document.querySelector(".chatbot-submitMessage");
        const id = document.querySelector("#id").value;
        questionBtn.forEach(btn => {
            btn.addEventListener("click", function(e){
                e.preventDefault();
                const question = e.target.getAttribute("data-question");
                messageContainer.innerHTML += `
                <article class="chat-message-container --user">
                    <section class="chat-message">
                        ${e.target.getAttribute("data-question")}
                    </section>
                    <p class="chat-user">You</p>
                </article>
                `;
                messageContainer.scrollTop = messageContainer.scrollHeight;
                fetchData(question, id);

            })
        })

        form.addEventListener("submit", function(e){
            e.preventDefault();
            const question = document.querySelector(".chatbot-inputfield").value;
            messageContainer.innerHTML += `
                <article class="chat-message-container --user">
                    <section class="chat-message">
                        ${question}
                    </section>
                    <p class="chat-user">You</p>
                </article>
                `;
            messageContainer.scrollTop = messageContainer.scrollHeight;
            fetchData(question, id);
            message.value = "";
        })

        function fetchData(e, id){
            return fetch("chat.php", {
                method: "POST",
                body: JSON.stringify({
                    message: e,
                    id: id
                })
            }).then((e) => {
                messageContainer.innerHTML += `
                <article class="chat-message-container --bot --loading">
                    <section class="chat-message">
                        <div class="loading">
                            <span class="loading-item"></span>
                            <span class="loading-item"></span>
                            <span class="loading-item"></span>
                        </div>
                    </section>
                    <p class="chat-user">Chatbot</p>
                </article>
                `;
                return e.json() 
            }).then(e => {
                const answer = e;
                if(answer !== ""){
                    messageContainer.innerHTML += `
                    <article class="chat-message-container --bot">
                        <section class="chat-message">
                            ${answer}
                        </section>
                        <p class="chat-user">Chatbot</p>
                    </article>
                    `;

                    messageContainer.removeChild(document.querySelector(".--loading"))
                    document.querySelector(".message-container").scrollTop = document.querySelector(".message-container").scrollHeight;
                }
            })
        }
    </script>
</body>
</html>