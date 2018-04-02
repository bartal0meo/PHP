﻿<?php
session_start();

if (isset($_POST['email']))
{
	//Udana walidacja ? tak
	$wszystko_OK=true;
	
	
	//Sprawdzenie poprawnosci nicku
	$nick=$_POST['nick'];
	
	//Sprawdzanie dlugosci nicku 
	
	if((strlen($nick)<3)||(strlen($nick)>20))
	{
		$wszystko_OK=false;
		$_SESSION['e_nick']="Nick musi posiadać od 3 do 20 znaków!";
		
	}
	// Sprawdzanie czy znaki sa normalne
	if(ctype_alnum($nick)==false)
	{
		$wszystko_OK=false;
		$_SESSION['e_nick']="Nick może składać się tylko z liter i cyfr (bez polskich znaków oraz spacji)";
	}
	
	// sprawdzanie poprawnosci e-maila
	$email = $_POST['email'];
	$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
	
	if((filter_var($emailB,FILTER_VALIDATE_EMAIL)==false)||($emailB!=$email))
	{
		$wszystko_OK=false;
		$_SESSION['e_email']="Podaj poprawny adres e-mail";
		
		
	}
	//poprawność hasła
	
	$haslo1=$_POST['haslo1'];
	$haslo2=$_POST['haslo2'];
	
	if((strlen($haslo1)<8)||(strlen($haslo1)>20))
	{
		$wszystko_OK=false;
		$_SESSION['e_haslo']="Hasło musi posiadać od 8 do 20 znaków";
		
	}
	if($haslo1!=$haslo2)
	{
		$wszystko_OK=false;
		$_SESSION['e_haslo']="Podane hasła nie są identyczne";
	}
	$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
	
	//sprawdzenie czy zaakceptowano regulamin ?
	if(!isset($_POST['regulamin']))
	{
		$wszystko_OK=false;
		$_SESSION['e_regulamin']="nie zaakceptowano regulaminu";
	}
	
	//sprawdanie captcha
	$sekret = "6LfyrQcUAAAAAG8R1cLYgpSQeP02i1QwyoGr-TkH"; //dla nowej domeny nowe konto na recaptchy 1:18
	
	$sprawdz=file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);
	
	$odpowiedz=json_decode($sprawdz);
	
	if($odpowiedz->success==false)
		
		{
		$wszystko_OK=false;
		$_SESSION['e_bot']="potwierdź że nie jesteś botem";
		}
	//Sprawdzanie czy w bazie nie ma takich samych nickow
	require_once"connect.php";
	
	mysqli_report(MYSQLI_REPORT_STRICT);
	
	
	try
	{
		$polaczenie=new mysqli($host,$db_user,$db_password,$db_name);
		if($polaczenie->connect_errno!=0)
		{
			throw new Exception(mysqli_connect_errno());
	
		}
		else
		{
			//czy mail istenijew bazie
			$rezultat=$polaczenie->query("SELECT id FROM uzytkownicy WHERE email='$email'");
			
			if(!$rezultat)throw new Exception($polaczenie->error);
			
			$ile_takich_maili=$rezultat->num_rows;
			
			if($ile_takich_maili>0)
			{
				$wszystko_OK=false;
				$_SESSION['e_email']="Istnieje już konto przypisane do tego adresu  e-mail";
			}
			
			//czy nick istenijew bazie
			$rezultat=$polaczenie->query("SELECT id FROM uzytkownicy WHERE user='$nick'");
			
			if(!$rezultat)throw new Exception($polaczenie->error);
			
			$ile_takich_nickow=$rezultat->num_rows;
			
			if($ile_takich_nickow>0)
			{
				$wszystko_OK=false;
				$_SESSION['e_nick']="Istnieje użytkownik o takiej nazwie";
			}
			
		//wszystkie testy zaliczone , dodajemy gracza do bazy	
	if($wszystko_OK==true)
		{
			if($polaczenie->query("INSERT INTO uzytkownicy VALUES(NULL,'$nick','$haslo_hash','$email')"))
			{
				$_SESSION['udanarejestracja']=true;
				header('Location:witamy.php');
			}
			else
			{
				throw new Exception($polaczenie->error);
			}
			
		} 
			
			$polaczenie->close();
			
		}
	}
	catch(Exception $e)
	{
		echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie</span>';
		//echo '<br/>Informacja developerska:'.$e;
	}

}



?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

<title>Zarejestruj się </title>
<script src='https://www.google.com/recaptcha/api.js'></script>

<style>
.error
{
color:red;
margin-top:10px;
margin-bottom:10px;
}
</style>
<link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
<div class="header">
		<div>
			<a href="dom.html" id="logo"><img src="images/logo.png" alt="logo"></a>
			<ul>
				<li class="selected">
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
                    <a href="index.php">Logowanie</a>
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
		
			<div class="register">
			
				<center><h3>Rejestracja</h3></center>
		

<form method="post">
<center>
Nickname: <br/> <input type="text" name="nick" /><br/>
<?php
if(isset($_SESSION['e_nick']))
{
	echo'<div class="error">'.$_SESSION ['e_nick'].'</div>';
	unset($_SESSION['e_nick']);
}


?>
E-mail:   <br/> <input type="text" name="email" /><br/>
<?php
if(isset($_SESSION['e_email']))
{
	echo'<div class="error">'.$_SESSION ['e_email'].'</div>';
	unset($_SESSION['e_email']);
}




?>
Twoje hasło:   <br/> <input type="password" name="haslo1" /><br/>
<?php
if(isset($_SESSION['e_haslo']))
{
	echo'<div class="error">'.$_SESSION ['e_haslo'].'</div>';
	unset($_SESSION['e_haslo']);
}




?>

Powtórz hasło:   <br/> <input type="password" name="haslo2" /><br/>



<label>
<input type="checkbox" name="regulamin" /> Akeptuję regulamin

</label>
<?php
if(isset($_SESSION['e_regulamin']))
{
	echo'<div class="error">'.$_SESSION ['e_regulamin'].'</div>';
	unset($_SESSION['e_regulamin']);
}




?>
</center>

<div  class="g-recaptcha" data-sitekey="6LfyrQcUAAAAAALo2bzYSDWr3n7V87KABA5qhvC4"> </div>

<center>
<?php
if(isset($_SESSION['e_bot']))
{
	echo'<div class="error">'.$_SESSION ['e_bot'].'</div>';
	unset($_SESSION['e_bot']);
}

?>

<br/>
<input type="submit" value="Zarejestruj się" />
</center>
</form>



</body>
<script type="text/javascript">
	document.getElementsByTagName("div")[0].style.display = "none";
  </script>
</html>  