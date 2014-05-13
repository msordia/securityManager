<?php
require 'core/init.php';
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Security Manager System | Reports for Audit</title>
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
       <h3>Audit Reports </h3>
       <p>Get a report of all the activity that happened over a period of time in a specific application.</p>

       System
       <select id="application">
       </select>
       <br/>

       Start date
       <input id="dateFrom" type="date" placeholder="MM/DD/YYYY" value="02/02/2014"> <br/>
       End date
       <input id="dateTo" type="date" placeholder="MM/DD/YYYY" value="01/01/2014"> <br/>

       Token:
       <input id="token" type="text" placeholder="Your access token as an auditor"> <br/>

       <a href="#" onclick="getReport()" class="button">Get Report</a>

        <div id="details" style="display:none;">
               <h3> Access requests </h3>
               <p> Information from the security management</p>
               <table id="tblReport"> 
                 <thead> 
                   <tr> 
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

               <h3> Actual access and modifications made inside the application. </h3>
               <p> Information from the application log</p>
               <table id="tblReportApp"> 
                 <thead> 
                   <tr> 
                     <th width="200">User</th> 
                     <th width="200">Reason</th> 
                     <th width="200">Duration</th> 
                     <th width="200">Date</th> 
                     <th width="300">Things done</th> 
                   </tr> 
                 </thead>

                 <tbody> 
                 </tbody>
               </table>

         </div>

     </div>
   </div>
 </div>



 <script src="js/vendor/jquery.js"></script>
 <script src="js/foundation.min.js"></script>
 <script>
  $(document).foundation();
</script>

<script>
  init();
  function init(){
    getApplicationData();
  }

  function getApplicationData(){
   $.post( "controls/doAction.php", { action:"getApplicationData" })
   .done(function( data ) {
    data = JSON.parse(data);
    var options = "";
    for(var k in data) {
     //console.log(k, data[k]);
     options += "<option token='"+data[k].token+"'>"+data[k].name+"</option>";
   }

   $("#application").html(options);

 });
 }


 var template = "<tr> <td> $usr </td> <td> $rsn </td> <td> $drtn </td> <td>$date</td> <td>$aprvd</td> </tr>";



 function getReport(){
          var application = $("#application").find(":selected").attr("token");
          var dateFrom    = $("#dateFrom").val();
          var dateTo      = $("#dateTo").val();
          var token       = $("#token").val();
          $.post( "controls/doAction.php", { action:"getAuditReport", applicationToken: application, dateFrom: dateFrom, dateTo: dateTo, accessToken:token })
          .done(function( data ) {
            
            data = JSON.parse(data);
            var html = "";
            
            var report = data[0];
            for(var k in report) {
             var r = template;
             r = r.replace("$usr", report[k].username);
             r = r.replace("$rsn", report[k].reason);
             r = r.replace("$drtn", report[k].duration);
             r = r.replace("$date", report[k].date);
             r = r.replace("$aprvd", report[k].approved == '0'? 'Rejected' : 'Approved');
             html += r;
           }
           $("#tblReport").find('tbody').html(html);

           var log = data[1];
           html = "";
          for(var k in log) {
             var r = template;
             r = r.replace("$usr", log[k].username);
             r = r.replace("$rsn", log[k].reason);
             r = r.replace("$drtn", log[k].duration);
             r = r.replace("$date", log[k].date);
             r = r.replace("$aprvd", log[k].approved == '0'? 'Rejected' : 'Approved');
             html += r;
          }
          $("#tblReportApp").find('tbody').html(html);
          $("#details").slideDown();
           
         });
        }

      </script>
  </body>
  </html>
