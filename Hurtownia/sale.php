<?php
session_start();

if(!isset($_SESSION['zalogowany']))
{
	header('Location:index.php');
	exit();
}

?>
<!DOCTYPE html>
<html lang="pl">

<head>
	<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
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
                <li class="selected">
                    <a href="sale.html">Cennik</a>
                </li>
                <li>
                    <a href="contact.html">Kontakt</a>
                </li>
                <li>
                    <?php
echo "<a>Witaj ".$_SESSION['user'].'!<br /> <a href="logout.php">[Wyloguj się!]</a>';


?>
                </li>
            </ul>
        </div>
	</div>
	<div class="body">
		<div class="blog">
			<div>
				<div>
				<div>
				
						<center>
						<h3><a>ZARA</a></h3>
						<a> Cena ...</a>
						</center>
						<p>
						<p>
						<center><a href="zara.html">Więcej</a></center>
						</p>
						</p>
				</div>
					<div>
						<img src="images/zaralogo.jpg" width="459px" height="230px" alt="">
						<p>
						Tutaj opis o kolekcji...
						</p>
					</div>
				</div>
				<div>
					<div>
					<center>
						<h3><a>MOHITO</a></h3>
						<a> Cena ...</a>
						<p>
						<p>
						<center><a href="mohito.html">Więcej</a></center>
						</p>
						</p>
					</center>
					</div>
					<div>
						<img src="images/mohitologo.jpg" width="459px" height="230px" alt="">
						<p>
							Tutaj opis o kolekcji...
						</p>
					</div>
				</div>
				<div>
				<div>
						<center>
						<h3><a>H&M</a></h3>
						<a> Cena ...</a>
						</center>
												<p>
						<p>
						<center><a href="h&m.html">Więcej</a></center>
						</p>
						</p>
				</div>
					<div>
						<img src="images/h&mlogo.jpg" width="459px" height="230px" alt="">
						<p>
						Tutaj opis o kolekcji...
						</p>
					</div>
				</div>
								<div>
					<div>
						<center>
						<h3><a>GUESS</a></h3>
						<a> Cena ...</a>
						</center>
												<p>
						<p>
						<center><a href="guess.html">Więcej</a></center>
						</p>
						</p>
					</div>
					<div>
						<img src="images/guesslogo.jpg" width="459px" height="230px" alt="">
						<p>
						Tutaj opis o kolekcji...
						</p>
					</div>
				</div>
				</div>
			</div>
		</div>
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