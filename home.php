<aside class="latest-questions">
    <header class="lq-header">
        <h1 class="chat-header-title"><?php echo $botname;?></h1>
        <a href="index.php" class="cta new-chat">New Chat</a>
        <a href="logout.php" class="logout">Logout</a>
    </header>
    <h2>Your recent chats</h2>
    <section class="lq-group">
        <p>September</p>
        <?php
            include("chat/chat.list.php");
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
            include("chat/chat-overview.php")
        ?>
    </section>
    <footer class="chat-footer">
        <form method="post" id="chatbot" class="footer-form">
            <select name="bot" id="bot" class="bot-selector">
                <option value="default"><?php echo $botname ?></option>
                <option value="gpt-3">GPT-3</option>
            </select>
            <section class="suggestions">
                <p class="suggestions-title">Suggestions</p>
                <section class="suggestions-container">
                    <button data-question="Tell me a joke" class="question">
                        Tell me a joke
                    </button>
                    <button data-question="What is your name?" class="question">
                        What is your name?
                    </button>
                    <button data-question="How old are you?" class="question">
                        How old are you?
                    </button>
                    <button data-question="What is the meaning of life?" class="question">
                        What is the meaning of life?
                    </button>
                    <button data-question="Calculate the square root of 25" class="question">
                        Calculate the square root of 25
                    </button>
                    <button data-question="What is 5+2?" class="question">
                        What is 5+2?
                    </button>
                    <button data-question="What is 4x56+3?" class="question">
                        What is 4x56+3?
                    </button>
                </section>
            </section>
            <label for="" class="chatbot-container">
                <textarea class="chatbot-inputfield" placeholder="Type your message" name="message"  cols="30" rows="3"></textarea>
                <span class="count"><span class="counter">0</span> / 100</span>
                <button type="submit" class="chatbot-submitMessage"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="none" class="send-icon" stroke-width="2"><path d="M.5 1.163A1 1 0 0 1 1.97.28l12.868 6.837a1 1 0 0 1 0 1.766L1.969 15.72A1 1 0 0 1 .5 14.836V10.33a1 1 0 0 1 .816-.983L8.5 8 1.316 6.653A1 1 0 0 1 .5 5.67V1.163Z" fill="currentColor"></path></svg></button>
            </label>
        </form>
    </footer>
</main>
<script async>
const questionBtn = document.querySelectorAll(".question");
const messageContainer = document.querySelector(".message-container");
const form = document.querySelector("#chatbot");
const message = document.querySelector(".chatbot-submitMessage");
const id = "<?php echo $_GET["chat"];?>";
let bot = document.querySelector("#bot").value;
const menuBtn = document.querySelector(".menu");
const menu = document.querySelector(".latest-questions");
const chatbotInput = document.querySelector(".chatbot-inputfield");
const count = document.querySelector(".counter");
const counterContainer = document.querySelector(".count");
const MAX_COUNT = 100;

chatbotInput.setAttribute("maxlength", MAX_COUNT);
chatbotInput.addEventListener("keyup", function(e){
    count.textContent = e.target.value.length;
    if(e.target.value.length > MAX_COUNT){
        e.target.value.substring(0, MAX_COUNT)
        counterContainer.classList.add("invalid");
        message.disabled = true;
        form.disabled = true;
    }else{
        counterContainer.classList.remove("invalid");
        message.disabled = false;
        form.disabled = false;
    }
})

questionBtn.forEach(btn => {
    btn.addEventListener("click", function(e){
        e.preventDefault();
        const question = e.target.getAttribute("data-question");
        messageContainer.innerHTML += `
        <article class="chat-message-container --user">
            <section class="chat-message">
                ${e.target.getAttribute("data-question")}
            </section>
            <p class="chat-user"><img src='<?php echo $_SESSION["profile"]; ?>' class="userprofile"></p>
        </article>
        `;
        messageContainer.scrollTop = messageContainer.scrollHeight;
        form.reset();
        fetchData(question, id);

    })
})

menuBtn.addEventListener("click", function(){
    menu.classList.toggle("--open");
})

document.querySelector("#bot").addEventListener("change", (e) => {
    bot = e.target.value;
})

form.addEventListener("submit", function(e){
    e.preventDefault();
    const question = document.querySelector(".chatbot-inputfield").value;

    if(question != ""){
        messageContainer.innerHTML += `
            <article class="chat-message-container --user">
                <section class="chat-message">
                    ${question}
                </section>
                <p class="chat-user"><img src='<?php echo $_SESSION["profile"]; ?>' class="userprofile"></p>
            </article>
            `;
        messageContainer.scrollTop = messageContainer.scrollHeight;
        form.reset();
        fetchData(question, id);
    }else{
        document.querySelector(".chatbot-container").style.borderColor = "red";
    }
})

function fetchData(e, id){
    return fetch("chat.php", {
        method: "POST",
        body: JSON.stringify({
            message: e,
            id: id,
            bot: bot,
            user: "<?php echo $_SESSION["email"]; ?>"
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
            <p class="chat-user"><?php echo $botname?></p>
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
                <p class="chat-user"><?php echo $botname?></p>
            </article>
            `;

            messageContainer.removeChild(document.querySelector(".--loading"))
            document.querySelector(".message-container").scrollTop = document.querySelector(".message-container").scrollHeight;
        }
    })
}
</script>