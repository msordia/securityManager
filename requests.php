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

$requests = new Requests();
$requests = $requests->getAllPendingRequests();

?>

<!doctype html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Security Manager System | Pending Requests</title>
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
       <h3>Pending requests </h3>
       <p>This is a list of all the pending access requests.</p>

       <table> 
         <thead> 
           <tr> 
             <th width="300">Application</th> 
             <th width="200">User</th> 
             <th width="200">Reason</th> 
             <th width="200">Duration</th> 
             <th width="200">Date</th> 
             <th width="300">Accept / Reject</th> 
           </tr> 
         </thead>

         <tbody> 

           <?php
           foreach ($requests as $request) {
            
             echo "<tr id='$request->id'> <td> $request->appName </td>
                        <td> $request->username </td>
                        <td> $request->reason </td>
                        <td> $request->duration </td> 
                        <td> $request->date</td> 
                        <td> <a onclick='acceptReq($request->id);' class='tiny button success'>Accept</a> 
                             <a onclick='rejectReq($request->id);' class='tiny button alert'>Reject</a> 
                         </td> 
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
</script>

<script>
  function acceptReq(id){
    $.post( "controls/doAction.php", { action:"acceptReq", id: id })
      .done(function( data ) {
        try{ data = JSON.parse(data);}
        catch(e){ alert("There was an error, please try again."); return;}
        if(data.message == 'success'){
          alert("Request accepted successfully");
          var elem = "tr#"+id;
          $(elem).remove();
        }else{
          alert("There was an error: " + data.message);
        }
      });
  }

   function rejectReq(id){
    $.post( "controls/doAction.php", { action:"rejectReq", id: id })
      .done(function( data ) {
        try{ data = JSON.parse(data);}
        catch(e){ alert("There was an error, please try again."); return;}
        if(data.message == 'success'){
          alert("Request rejected successfully");
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
