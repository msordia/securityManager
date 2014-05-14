<?php
require 'core/init.php';

$user = new User();
$user->checkIsValidUser();

?>

<!doctype html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Security Manager System | Audit</title>
  <link rel="stylesheet" href="css/foundation.css" />
  <link rel="stylesheet" href="css/gestor.css" />
  <script src="js/vendor/modernizr.js"></script>
</head>

<body>

  <?php include 'includes/templates/header.php' ?>

  <br/><br/>

  <div class="row">
    <div class="large-12 columns">
     <div class="panel">
       <h3>Audit </h3>
       <p>Register a new auditor.</p>
        <div id="form-wrap">
           Name:
           <input id="name" type="text" placeholder="Auditor full name"> <br/>
           Company:
           <input id="company" type="text" placeholder="">
           <a href="#" onclick="registerAuditor()" class="button">Register and get token</a>

        </div>
       <div id="token-wrap" style="display:none">
        <h4>The auditor was successfully registered.</h4>
        Token: <span id="accessToken"></span> </div>
     </div>
   </div>
 </div>



 <script src="js/vendor/jquery.js"></script>
 <script src="js/foundation.min.js"></script>
 <script>
  $(document).foundation();
</script>

<script>

 function registerAuditor(){

  var name    = $("#name").val();
  var company = $("#company").val();

  $.post( "controls/doAction.php", { action:"registerAuditor", name: name, company: company })
  .done(function( data ) {
    try{ data = JSON.parse(data);}
    catch(e){ alert("There was an error, please try again."); return;}
    
    if(data.message == 'success'){
      $("#accessToken").text(data.accessToken);
      $("#token-wrap").show();
      $("#form-wrap").hide();
    }else{
      alert("There was an error registering the auditor.");
    }

});
}

</script>
</body>
</html>
