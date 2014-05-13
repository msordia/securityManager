
<!doctype html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>External App</title>
  <link rel="stylesheet" href="css/foundation.css" />
  <link rel="stylesheet" href="css/gestor.css" />
  <script src="js/vendor/modernizr.js"></script>
</head>

<style type="text/css">
  span{
    display: inline-block;
    width: 200px;
  }

  input{
    display: inline-block !important;
    width: 300px !important;
  }

</style>

<body>

 
  <div class="row">
    <div class="large-12 columns">
     <div class="panel">
       <h3>Simulate an external app calling the API </h3>
       
       <br/><br/>
       <p>Make an access request.</p>

       <span>applicationToken</span>   <input type="text" id="applicationToken" name="applicationToken" value="29fd4c4776a1dccc10ee7f7bf66e0c43e44e2c4026c49f1deb7f236aa1823a7b" />  <br/>
       <span>username</span>           <input type="text" id="username" name="username" value="GerardoP" /> <br/>
       <span>usermail</span>           <input type="text" id="usermail" name="usermail" value="gerardo@mail.com" /> <br/>
       <span>userId</span>             <input type="text" id="userId" name="userId" value="012" /> <br/>
       <span>duration</span>           <input type="text" id="duration" name="duration" value="02:03:04" /> <br/>
       <span>reason</span>             <input type="text" id="reason" name="reason" value="Modificar ingresos de personal"/> <br/>
       <button class="small" onclick="makeRequest()">Make request</button>

       <br/><br/>
       <p>Register an app.</p>
       <span>applicationName</span>  <input type="text" value="Test Application" name="applicationName" id="applicationName"><br/>
       <span>username</span>         <input type="text" value="JohnDoe" name="username" id="username2"><br/>
       <span>url</span>              <input type="text" value="http://localhost:8082/gestor/external/externalApi.php" name="url" id="url"><br/>
       <button class="small" onclick="registerApp()">Register app</button>

        </tbody>
      </table>

    </div>
  </div>
</div>

<script src="js/vendor/jquery.js"></script>
<script type="text/javascript">
  
  function makeRequest(){

    var username = $("#username").val();
    var usermail = $("#usermail").val();
    var userId   = $("#userId").val();
    var duration = $("#duration").val();
    var reason   = $("#reason").val();
    var appToken = $("#applicationToken").val();

    $.post( "http://localhost:8082/gestor/api/applications.php", { action:"requestAccess", username: username, usermail:usermail, userId:userId, duration:duration, reason:reason, applicationToken: appToken })
      .done(function( data ) {
        console.log("makeRequest finished, data:")
        console.log(data);
        alert("Request successful");
      });
  }

  function registerApp(){
    var applicationName = $("#applicationName").val();
    var username = $("#username2").val();
    var url = $("#url").val();
    
    $.post( "http://localhost:8082/gestor/api/applications.php", { action:"registerApplication", username: username, url:url, applicationName:applicationName})
      .done(function( data ) {
        console.log("registerApp finished, data:")
        console.log(data);
        alert("RegisterApp successful");
      });
}

</script>
</body>
</html>
