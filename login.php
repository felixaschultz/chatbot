<section class="login-screen">
    <div id="login" data-client_id="d2eefd7f1564fa4c9714000456183a6b0f51e8c9519e1089ec41ce905ffc0c453dfac91ae8645c41ebae9c59e7a6e5233b1339e41a15723a9ba6d934bbb3e92d" data-app-name="Chatbot" data-login_callback="login"></div>
</section>
<script>
    Intastellar.accounts.id.renderButton(
        document.querySelector("#login")
    )

    function login(token){
        console.log(token);

        fetch("login-client.php", {
            method: "POST",
            body: JSON.stringify({
                token: token
            })
        }).then(e => e.text()).then(e => {
            if(e === "logged_in"){
                window.location.reload();
            }
        })
    }
</script>