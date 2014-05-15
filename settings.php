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
  <title>Security Manager System | Settings </title>
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
       <h3>Settings </h3>
       <p>View and edit your settings</p>

       
       <h5>Username</h5>
       <input id="username" type="text" value="<?php echo $user->data()->username; ?>"> <br/>
       <h5>Mail</h5>
       <input id="mail" type="text" value="<?php echo $user->data()->mail;  ?>">
       <h5>New password</h5>
       <p>Because of its encryptation we cant show you your old password,<br/> however if you decide to change it you can type a new one in the box. <br/>An empty box will result in NO change to your old password.</p>
       <input id="password" pattern=".{6,}" type="password">

       <a href="#" onclick="updateSettings()" class="button">Update my settings</a>



     </div>
   </div>
 </div>



 <script src="js/vendor/jquery.js"></script>
 <script src="js/foundation.min.js"></script>
 <script>
  $(document).foundation();
</script>

<script>

 function updateSettings(){
  var username  = $("#username").val();
  var mail      = $("#mail").val();
  var password      = $("#password").val();

  $.post( "controls/doAction.php", { action:"updateSettings", username: username, mail: mail, password:password })
  .done(function( data ) {

    data = JSON.parse(data);
    if(data.message == 'success'){
      alert("Your settings were updated successfully");
      window.location.reload();

    }else{
      alert("There was an error: " + data.message);
    }

});
}

</script>
</body>
</html>
