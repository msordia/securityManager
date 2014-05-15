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

$apps = new Applications();
$apps = $apps->data();

?>

<!doctype html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Security Manager System | Registered Applications</title>
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
       <h3>Registered Applications </h3>
       <p>This is a list of all the registered apps to use the Security Manager .</p>

       <table> 
         <thead> 
           <tr> 
             <th width="300">Application name</th> 
             <th width="200">Token</th> 
             <th width="200">Registered Date</th> 
             <th width="200">Reistered by</th> 
             <th width="300">Deactivate</th> 
           </tr> 
         </thead>

         <tbody> 

           <?php
           foreach ($apps as $app) {
            
             echo "<tr id='$app->id'> <td> $app->name </td>
                        <td> $app->token </td>
                        <td> $app->registerDate </td>
                        <td> $app->registeredBy </td> 
                        <td> <a onclick=\"deactivate($app->id,'$app->token', '$app->name');\" class='tiny button alert'>Desactivate</a> </td> 
                      </tr>";

            }
          
          ?>
          
        </tbody>
      </table>

    </div>
  </div>
</div>



<script src="js/vendor/jquery.js"></script>
<script src="js/foundation.min.js"></script>
<script>
  $(document).foundation();

   function deactivate(id, token, name){
    var r = confirm("Do you want to deactivate the '"+name+"' app? ");
    if(!r) return;

    $.post( "controls/doAction.php", { action:"deactivateApp", token: token, id:id })
      .done(function( data ) {
        data = JSON.parse(data);
        if(data.message == 'success'){
          alert("The application was deactivated successfully");
          var elem = "tr#"+id;
          $(elem).remove();
        }else{
          alert("There was an error: " + data.message);
        }
      });
  }

</script>
</body>
</html>
