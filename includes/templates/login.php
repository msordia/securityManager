
<div id="login-overlay">
	<div id="loginForm"> 
		<h1>Inicia sesión</h1>
		<input type="text" id="txtUser" placeholder="Email"/> <br/>
		<input type="password" id="txtPass" placeholder="Contrasena"/> <br/>
		<!-- <label for="remember"><input type="checkbox" name="remember" id="remember"> Recordar</label> -->

		<button class="btn btn-small btn-blue" onclick="logIn();">Entrar</button>
		<button class="btn btn-small btn-gray" onclick="cancelLogIn();">Cancelar</button>
		<div class="register">
			<span> ¿No tienes cuenta? </span> <a href="register.php">Creala aquí</a>
		</div>

		<input type="hidden" id="token" name="token"  value="<?php echo Token::generate(); ?>">
		<span class="error" id="loginError" style="display:none">Login invalido.</span>
	</div>
</div>

<script type="text/javascript">	

	$.fn.exists = function () {
		return this.length !== 0;
	}

	$(document).ready(function() {

		var loginOverlay = $("#login-overlay");
		var loginForm = $("#loginForm");
		var loginBtn = $("#loginBtn");

		$("#txtPass").keypress(function(event){
			var keycode = (event.keyCode ? event.keyCode : event.which);
			if(keycode == '13'){
				logIn();
			}
			event.stopPropagation();
		});

		loginOverlay.click(function() {
			loginOverlay.fadeOut('fast');
		});

		loginBtn.click(function(event){
			loginOverlay.show();
			$("#txtUser").focus();
			event.stopPropagation();
		});

		loginForm.click(function(event){
			event.stopPropagation();
		});

	});

	function cancelLogIn(){
		$("#login-overlay").fadeOut('fast');
	}

	function logIn(){

		var user = $("#txtUser").val();
		var pass = $("#txtPass").val();
		var tok = $("#token").val();
		var rem = $("#remember").val();

		$.post( "controls/verifyLogin.php", { username: user, password: pass, token: tok, remember:rem })
		.done(function( data ) {
			if(data == "error"){
				showError();
			}else{
				window.location.replace(data);
			}
		});
	}

	function showError(){
		$("#loginError").fadeIn('fast');
	}

	function hideError(){
		$("#loginError").hide();
	}

</script>