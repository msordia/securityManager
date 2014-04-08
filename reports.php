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
  <title>Security Manager System | Reports</title>
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
       <h3>Reports </h3>
       <p>Get a report of all the access request made for a system in a time span.</p>

       System
       <select>
         <option>ARSI</option>
         <option>MYSA</option>
       </select>
       <br/>

       Start date
       <input id="strDate" type="date" placeholder="MM/DD/YYYY"> <br/>
       End date
       <input id="endDate" type="date" placeholder="MM/DD/YYYY">


       <table> 
         <thead> 
           <tr> 
             <th width="300">Application</th> 
             <th width="200">User</th> 
             <th width="200">Reason</th> 
             <th width="200">Duration</th> 
             <th width="200">Date</th> 
             <th width="300">Was accepted</th> 
           </tr> 
         </thead>

         <tbody> 

          
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
 var template = "<tr> <td> $request->appName </td>
                        <td> $request->username </td>
                        <td> $request->reason </td>
                        <td> $request->duration </td> 
                        <td> $request->date</td> 
                        <td> <a onclick='acceptReq($request->id);' class='tiny button success'>Accept</a> 
                             <a onclick='rejectReq($request->id);' class='tiny button alert'>Reject</a> 
                         </td> 
                      </tr>";

</script>
</body>
</html>
