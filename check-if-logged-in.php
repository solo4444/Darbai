<?php
//session_start();
//print_r($_SESSION);
if(empty($_SESSION["logged_in"])){
echo '<div class="Login">
    <form class="login-user" action="" method="post" >
        <input type="text" name="Username" value="" placeholder="Username" id="login_username" class="form-control">

        <input type="password" name="Password" value="" placeholder="Password" id="login_password" class="form-control">

        <button type="button" name="button" class="login-button btn btn-success">Login</button>
        <p id="error_code"></p>
    </form>
    <a href="register_account.php">Register Now</a>
</div>';
}
else if(isset($_SESSION["logged_in"])){
    if ($_SESSION["logged_in"] == "true"){
        echo '<div class="logged-in-user" >
            <h3 class="logged_in_user_username"> Sveiki '. $_SESSION["logged_in_user"] .'</h3>
            <h5><a href="account_settings.php">Paskyros nustatymai</a></h5>
            <h5><a href="index.php" class="logout-button">Atsijungti</a></h5>';
            if($_SESSION["logged_in_user"] == "kabakaba" && isset($_SESSION["show_admin"])){
                if($_SESSION["show_admin"] == "true"){
                    echo '<h5><a href="index.php" class="show-user-button">Rodyti kaip vartotojui</a></h5>';
                }
                else{
                    echo '<h5><a href="index.php" class="show-admin-button">Rodyti kaip adminui</a></h5>';
                }
            }
            echo '</div>';
        }
}
?>
