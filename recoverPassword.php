<?php
require 'core/init.php';
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
  <title>Security Manager System | Recover Password</title>
  <?php include 'includes/templates/headTags.php' ?>
</head>
<body>

  <div class="row centeredXY">
    <div class="small-9 small-centered columns ">
      <div class="panel text-centered">

          <img src="img/icon.png" width="120px">
          <h2>Recover password</h2>
          <h4>A new password will be sent to your email</h4>
          <br/><br/>

          <form id="recover" data-abide="ajax">
            <input name="mail" placeholder="e-mail" type="email">
            <small class="error">An email address is required.</small>
            <button type="submit">Get a new password</button>
          </form>
      </div>          
    </div>
  </div>


<?php include 'includes/templates/commonJs.php' ?>

<script>

$('input[name="mail"]').on('valid', function() {
  
});

$('form#recover').on('submit', function(e) {
            recoverPassword();
            e.preventDefault();
});

function recoverPassword(zone){
  var mymail = $('input[name="mail"]').val();
  $.post( "controls/recoverPassword.php",
   {mail: mymail}, 
   function( data ) {
      console.log("-recoverPassword-");
      console.log(data);
  }, "json");
}

</script>

</body>
</html>
