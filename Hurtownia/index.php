<?php
session_start();
if((isset($_SESSION['zalogowany']))&&($_SESSION['zalogowany']==true))
{
	header('Location:sale.php');
	exit();
}
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

<title>Hurtownia</title>
<link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>

<div class="header">
		<div>
			<a href="dom.html" id="logo"><img src="images/logo.png" alt="logo"></a>
			<ul>
				<li>
					<a href="dom.html">Home</a>
				</li>
				<li>
					<a href="about.html">O nas</a>
				</li>
				
				<li>
					<a href="sale.php">Cennik</a>
				</li>
				<li>
					<a href="contact.html">Kontakt</a>
				</li>
				<li class="selected">
                    <a href="index.php">Rejestracja</a>
                </li>
			</ul>
		</div>
		
	</div>
	<div class="body">
		<div>
			<h2><center><a href="rejestracja.php">Nie masz konta ? Kliknij Tu!</a></center></h2>
		<h1><center>
			
				Zarejestruj się aby zobaczyć ceny produktów 
			
			</center></h1>

		</div>
	</div>
	<div class="body">
		<div class="locator">
		<center>
			<div class="register">
				<h3>Logowanie</h3>
			<form action="zaloguj.php" method="post">
				Login: <br/><input type="text" name="login"/><br/>
				Hasło: <br/><input type="password" name="haslo"/><br/><br/>
				<input type="submit" value="Zaloguj się"/>

			</form>
			<a href="rejestracja.php">Nie masz konta ? Zarejestruj się !</a>
<br/><br />
				<?php
if(isset($_SESSION['blad']))
	echo $_SESSION['blad'];




?>
				</center>
			</div>
	<div class="footer">
		<div>
			<p>
				&#169; Hurtownia odzieżowa - Outlet
			</p>
			<ul>
				<li>
					<a href="#">Privacy Policy</a>
				</li>
				<li>
					<a href="#">Terms And Conditons</a>
				</li>
			</ul>
			<div class="connect">
				 <a href="https://www.facebook.com/Hurtownia-odzie%C5%BCowa-Outlet-320702694931089/?fref=ts" id="facebook">Facebook</a>
			</div>
		</div>
	</div>


</body>
<script type="text/javascript">
	document.getElementsByTagName("div")[0].style.display = "none";
  </script>
</html>  