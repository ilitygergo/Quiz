<?php

?>

<div class="login-page ">
    <div class="form w3-round-large">
        <form class="register-form">
            <input type="text" placeholder="name"/>
            <input type="password" placeholder="password"/>
            <input type="email" placeholder="email address"/>
            <button>create</button>
            <p class="message">Already registered? <a href="#">Sign In</a></p>
        </form>
        <form class="login-form">
            <input type="email" placeholder="email"/>
            <input type="password" placeholder="password"/>
            <button>login</button>
            <p class="message">Not registered? <a href="#">Create an account</a></p>


            <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
            <script>
                $('.message a').click(function(){
                    $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
                });
            </script>


        </form>
    </div>
</div>
