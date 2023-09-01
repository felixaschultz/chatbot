<?php
    session_start();
    $botname = "Chatbot 0.1 alpha";
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
</head>
<body class="container">
    <aside class="latest-questions">
        <header class="lq-header">
            <h1 class="chat-header-title"><?php echo $botname;?></h1>
            <button class="cta new-chat">New Chat</button>
        </header>
        <h2>Your recent chats</h2>
        <section class="lq-group">
            <p>August</p>
            <article class="lq-question">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Corrupti culpa sunt dolorem, vero tempore rerum nulla magnam dolore fugit magni asperiores nam aliquam cupiditate, pariatur beatae ipsam? Maxime, facere in.
            </article>
            <article class="lq-question">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa id vel aut pariatur aspernatur. Odit vel expedita unde est, reiciendis qui, eum nostrum consequatur ipsum, sunt possimus deleniti delectus tempore.
            </article>
            <article class="lq-question">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatum, laborum ducimus iusto sint voluptate veritatis ipsam itaque dolore unde deserunt, aperiam natus voluptates autem temporibus ea commodi at qui? Eligendi.
            </article>
        </section>
        <section class="lq-group">
            <p>July</p>
            <article class="lq-question">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus consectetur impedit perspiciatis tempore quibusdam amet libero aliquam pariatur harum quae perferendis fuga explicabo, repellat reiciendis hic. Temporibus facere odit cumque.
            </article>
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
            <article class="chat-message-container --user">
                <section class="chat-message">
                    What is the meaning of life?
                </section>
                <p class="chat-user">You</p>
            </article>
            <article class="chat-message-container --bot">
                <section class="chat-message">
                    42
                </section>
                <p class="chat-user">Chatbot</p>
            </article>
            <article class="chat-message-container --user">
                <section class="chat-message">
                    Lorem ipsum dolor
                </section>
                <p class="chat-user">You</p>
            </article>
            <?php 
                if(isset($_SESSION["answer"])){
                    if(is_array($_SESSION["answer"])){
                        foreach($_SESSION["answer"] as $question){
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
            ?>
        </section>
        <footer class="chat-footer">
            <form method="post" id="chatbot">
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
                    <textarea class="chatbot-inputfield" placeholder="Type your message" name=""  cols="30" rows="3"></textarea>
                    <button type="submit" class="chatbot-submitMessage"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="none" class="send-icon" stroke-width="2"><path d="M.5 1.163A1 1 0 0 1 1.97.28l12.868 6.837a1 1 0 0 1 0 1.766L1.969 15.72A1 1 0 0 1 .5 14.836V10.33a1 1 0 0 1 .816-.983L8.5 8 1.316 6.653A1 1 0 0 1 .5 5.67V1.163Z" fill="currentColor"></path></svg></button>
                </label>
            </form>
        </footer>
    </main>
    <script>
        const questionBtn = document.querySelectorAll(".question");
        const messageContainer = document.querySelector(".message-container");
        const form = document.querySelector("#chatbot");
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
                fetchData(question);

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
            fetchData(question);
        })

        function fetchData(e){
            return fetch("chat.php", {
                method: "POST",
                body: e
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

                    document.querySelector(".--bot").scrollIntoView()
                }
            })
        }
    </script>
</body>
</html>