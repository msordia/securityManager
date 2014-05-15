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
  <title>Security Manager System | Dashboard</title>
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
     <h3>Dashboard </h3>
     <p>This is a panel for general administration of the security system.</p>

     <ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-4" id="dashboard-actions"> 
        <li class="text-centered"> <a href="requests.php"> <img class="th" src="img/Requests.jpg"> <h5>Pending requests</h5> </a> </li>
        <li class="text-centered"> <a href="registeredApps.php"> <img class="th" src="img/Apps.png"> <h5>Registered Applications</h5> </a> </li>
        <li class="text-centered"> <a href="reports.php"> <img class="th" src="img/Report.jpg"> <h5>View report</h5> </a> </li>
        <li class="text-centered"> <a href="audit.php"> <img class="th" src="img/Audit.png"> <h5>Audit</h5> </a> </li>
        <li class="text-centered"> <a href="settings.php"> <img class="th" src="img/Settings.svg"> <h5>Settings</h5> </a> </li>
     </ul>
     
 </div>
</div>
</div>



<script src="js/vendor/jquery.js"></script>
<script src="js/foundation.min.js"></script>
<script>
  $(document).foundation();
</script>
</body>
</html>
