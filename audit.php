<?php

/*
Octopus - Security Manager
Copyright (C) 2014 - ITESM

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details. <http://www.gnu.org/licenses/>.
*/

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
       <form data-abide>  
        <div id="form-wrap">
          <div>
           Name:
           <input id="name" type="text" placeholder="Auditor full name" required pattern="[a-zA-Z]+">
           <small class="error">Name is required and must be a string.</small> 
          </div>
          <div>
            Company:
            <input id="company" type="text" placeholder="" required pattern="[a-zA-Z]+">
            <small class="error">Name is required and must be a string.</small> 
          </div>
          <a href="#" onclick="registerAuditor()" class="button">Register and get token</a>

        </div>
        </form>
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

  if(name.trim().length == 0 || company.trim().length == 0){
    alert("The input fields cant be empty.");
  }
  else if(name.trim().length < 4){
    alert("The name must be at least 4 characters long.");
  }
  else if(company.trim().length < 4){
    alert("The company must be at least 4 characters long.");
  }else{

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

}

</script>
</body>
</html>
