<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/models/User.php');

session_start();
if (isset($_SESSION["USERID"])) {
    session_destroy();
}

$user = new User();

if (isset( $_GET["name"]) && isset( $_GET["password"]) && isset( $_GET["email"])) {
    $user->setUserName($_GET["name"]);
    $user->setPassword($_GET["password"]);
    $user->setEmail($_GET["email"]);
    $user->setFirstName('');
    $user->setLastName('');
    $user->setBirthday('');
    $user->setGender('');

    if ($user->validate()) {
        $user->saveUser();
    }
}

if (isset( $_GET["logemail"]) && isset( $_GET["logpassword"])) {
    $user->setEmail($_GET["logemail"]);
    $user->setPassword($_GET["logpassword"]);

    if ($user->login()) {
        $userID = $user->getUserIDByValues($user->getEmail(), $user->getPassword());
        $user->setUserID($userID);

        $_SESSION["USERID"] = $user->getUserID();

        header("Location: http://localhost/Quiz/src/index");
    }
}

?>

<div class="login-page ">
    <div class="form w3-round-large">
        <form class="register-form">
            <input id="name" type="text" name="name" placeholder="name" required/>
            <input id="password" type="password" name="password" placeholder="password" required/>
            <input id="email" type="email" name="email" placeholder="email address" required/>

            <button>create</button>

            <p class="message">Already registered? <a href="#">Sign In</a></p>
        </form>

        <form class="login-form">
            <input id="logemail" type="email" name="logemail" placeholder="email" required/>
            <input id="logpassword" type="password" name="logpassword" placeholder="password" required/>

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
