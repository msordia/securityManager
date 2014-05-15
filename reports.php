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
       <select id="application">
         <option>ARSI</option>
         <option>MYSA</option>
       </select>
       <br/>

       Start date
       <input id="dateFrom" type="date" placeholder="MM/DD/YYYY" value="01/01/2014"> <br/>
       End date
       <input id="dateTo" type="date" placeholder="MM/DD/YYYY" value="05/05/2014">

       <a href="#" onclick="getReport()" class="button">Get Report</a>

       <div id="details" style="display:none;">
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

         <h4 style="display:none;">There is no activity recorded.</h4>

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
  $.post( "controls/doAction.php", { action:"getReport", applicationToken: application, dateFrom: dateFrom, dateTo: dateTo })
  .done(function( data ) {

    data = JSON.parse(data);
    var html = "";

    if(data.length == 0){
      $("#tblReport").hide();
      $("#details").show();
      $("#details").find('h4').slideDown();

    }else{
      for(var k in data) {
       var r = template;
       r = r.replace("$usr", data[k].username);
       r = r.replace("$rsn", data[k].reason);
       r = r.replace("$drtn", data[k].duration);
       r = r.replace("$date", data[k].date);
       r = r.replace("$aprvd", data[k].approved == '0'? '<span class="rjctd">Rejected</span>' : '<span class="apprvd">Approved</span>');
       html += r;
     }
     $("#tblReport").show().find('tbody').html(html);
     $("#details").show();
     $("#details").find('h4').hide();
   }



 });
}

</script>
</body>
</html>
