<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <?php include "styles.php" ?>
    <body>
        <?php include "header.php" ?>
        <?php include "nav.php" ?>

        <script type="text/javascript">


        $(document).ready(function(){
            $(document).on("click", ".sign_up_button", function(){
                var atitinkaReikalavimus = false;
                var emailas = $("#inputEmail").val();
                var username = $("#UsernameInput").val();
                var password = $("#inputPassword").val();
                var repeat_password = $("#RepeatPasswordInput").val();
                if(emailas.indexOf('@') > -1){
                    if(username.length > 7){
                        if(password.length > 7){
                            if(password == repeat_password){
                                if ($('#gridCheck').is(":checked")){
                                    atitinkaReikalavimus = true;
                                }
                                else{
                                    alert("nepazymetas laukas");
                                    $(".error_form-check").text("*nepazymetas laukas!");
                                }
                            }
                            else{
                                alert("slaptazodziai nesutampa");
                                $(".error_RepeatPasswordInput").text("*Slaptazodziai nesutampa!");
                            }
                        }
                        else{
                            alert("passwordas per trumpas");
                            $(".error_inputPassword").text("*Passwordas per trumpas!");
                        }
                    }
                    else{
                        $(".error_UsernameInput").text("*Vardas per trumpas!");
                        alert("vardas per trumpas");
                    }
                }


                if(atitinkaReikalavimus){
                    $.ajax({
                        type: 'POST',
                        url: 'sign_up.php',
                        data: { UserEmail: emailas, UserUsername: username, UserPassword: password} ,
                        success: function(response) {
                            alert(emailas);
                            $("#Sign_up_status").text(response);
                        }

                    });
                }
            });

        });

        </script>

        <div class="container">
                <form class="register-account-form" action="" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                        <label for="inputEmail" class="error_inputEmail error"></label>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="UsernameInput">Username</label>
                        <input type="text" name="Username" class="form-control" id="UsernameInput" placeholder="Username" >
                        <label for="UsernameInput" class="error_UsernameInput error"></label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputPassword">Password</label>
                        <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                        <label for="inputPassword" class="error_inputPassword error"></label>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="RepeatPasswordInput">Repeat Password</label>
                        <input type="password" name="Repeat Password" class="form-control" value="" placeholder="Repeat Password" id="RepeatPasswordInput">
                        <label for="RepeatPasswordInput" class="error_RepeatPasswordInput error"></label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            Pazymedami langeli jus sutinkate su svetaines taisyklemis
                        </label>
                        <label for="form-check-label" class="error_form-check error"></label>
                    </div>
                </div>
                <button type="button" class="btn btn-primary sign_up_button">Sign up</button>
                <h3 id="Sign_up_status"></h3>
            </form>
        </div>
    </body>
    <script type="text/javascript" src="main.js">


    </script>

</html>
