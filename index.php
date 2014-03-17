<?php
require 'core/init.php';
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
  <title>Security Manager System | Welcome</title>
  <?php include 'includes/templates/headTags.php' ?>
</head>
<body>

  <div class="row centeredXY">
    <div class="small-9 small-centered columns ">
      <div class="panel text-centered">

        <img src="img/icon.png" width="120px">
        <h2>Security Manager System </h2>
        <h4>Login</h4>
        <br/><br/>

        <form id="login" data-abide="ajax">
          <div class="mail-field">
            <input name="mail" placeholder="E-mail" type="email">
            <small class="error">An email address is required.</small>
          </div>
          <div class="password-field">
            <input name="password" placeholder="Password" type="password" required>
            <small class="error">A password is required.</small>
          </div>
          <button type="submit">Login</button>
        </form>
        <a href="recoverPassword.php">Forgot Password</a>
      </div>          
    </div>
  </div>

  <?php include 'includes/templates/commonJs.php' ?>

  <script type="text/javascript">

    $('form#login').on('submit', function(e) {
      logIn();
      e.preventDefault();
    });

    function logIn(){

      var user = $('input[name="mail"]').val();
      var pass = $('input[name="password"]').val();

      $.post( "controls/verifyLogin.php", { username: user, password: pass})
      .done(function( data ) {
        if(data == "error"){
          showError();
        }else{
          window.location.replace(data);
        }
      });
    }

    function showError(){
      $("#loginError").fadeIn('fast');
    }

    function hideError(){
      $("#loginError").hide();
    }


  </script>
</body>
</html>
