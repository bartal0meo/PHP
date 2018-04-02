<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
    $db=mysqli_connect('127.0.0.1','root','','tools');
    $db -> query ('SET NAMES utf8');
    $db -> query ('SET CHARACTER_SET utf8_unicode_ci');
    if(mysqli_connect_errno()){
     echo 'Brak polaczenia z baza:'.mysqli_connect_error();
     die();
    }
    $sql="SELECT * FROM kategorie ORDER BY id DESC";
    $featured=$db->query($sql);
	?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>PRO Tools</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link rel="stylesheet" type="text/css" href="style.css" />
<!--[if IE 6]>
<link rel="stylesheet" type="text/css" href="iecss.css" />
<![endif]-->
<script type="text/javascript" src="js/boxOver.js"></script>
</head>
<body>
<div id="main_container">
  <div id="header">
    <div class="top_right">
      <div class="languages">
        
        <a href="#" class="lang"><img src="images/en.gif" alt="" border="0" /></a> <a href="#" class="lang"><img src="images/de.gif" alt="" border="0" /></a> </div>
      <div class="big_banner"> <a href="#"><img src="images/banner728.png" alt="" border="0" /></a> </div>
    </div>
    <div id="logo"> <a href="#"><img src="images/logo.png" alt="" border="0" width="182" height="85" /></a> </div>
  </div>
  <div id="main_content">
    <div id="menu_tab">
      <ul class="menu">
        <li><a href="index.php" class="nav"> Home </a></li>
        <li class="divider"></li>
        <li><a href="magazyn.php" class="nav">Produkty</a></li>
        <li class="divider"></li>
        <li><a href="#" class="nav">Specjalne</a></li>
        <li class="divider"></li>
        <li><a href="#" class="nav">Moje Konto</a></li>
        <li class="divider"></li>
        <li><a href="#" class="nav">Zaloguj</a></li>
        <li class="divider"></li>
        <li><a href="#" class="nav">Wysylka</a></li>
        <li class="divider"></li>
        <li><a href="contact.html" class="nav">Kontakt</a></li>
        <li class="divider"></li>
        <li><a href="details.html" class="nav">Szczeg�ly</a></li>
      </ul>
    </div>
    <!-- end of menu tab -->
    <div class="left_content">
      <div class="title_box">Kategorie</div>
      <ul class="left_menu">
        <li class="even"><a href="#">Narzedzia</a></li>
        <li class="odd"><a href="#">Klucze</a></li>
        <li class="even"><a href="#">Akcesoria</a></li>
        <li class="odd"><a href="#">Odziez Robocza</a></li>
        <li class="even"><a href="#">Narzedzia Zapasowe</a></li>
        <li class="odd"><a href="#">Akcesoria</a></li>
       
      </ul>
      <div class="title_box">Produkt Specjalny</div>
      <div class="border_box">
        <div class="product_title"><a href="#">Makita 156 MX-VL</a></div>
        <div class="product_img"><a href="#"><img src="images/p1.jpg" alt="" border="0" /></a></div>
        <div class="prod_price"><span class="reduce">799zl</span> <span class="price">599zl</span></div>
      </div>
      <div class="title_box">Newsletter</div>
      <div class="border_box">
        <input type="text" name="newsletter" class="newsletter_input" value="Tw�j e-mail"/>
        <a href="#" class="join">Subskrybuj</a> </div>
      <div class="banner_adds"> <a href="#"><img src="images/bann2.jpg" alt="" border="0" /></a> </div>
    </div>
    <!-- end of left content -->
    <div class="center_content">
      <div class="oferta">  
        <div class="oferta_details">
          <div class="oferta_title"></div>
          <div class="oferta_text">  
 </div>
          </div>
      </div>
      <div class="center_title_bar">Produkty: </div>
	  <?php
 while($product=mysqli_fetch_assoc($featured)) : ?>
       <div class="">
	   <center>
		
		 <li class="center_title_bar"><a>Nazwa:  <?= $product['nazwa']; ?></a></li>
         
        
						
			<?php
			echo '<img src="data:image/jpeg;base64,'.base64_encode($product['zdjecie1']).' ">';
			?>			
							<br></br>
				<div><a>Opis: <?= $product['opis']; ?></a></div>
				<div><a>Cena:  <?= $product['cena']; ?></a></div>
				<br></br>
	</center>	

        </div>
       
	 
    <?php endwhile; ?>
      
      <div class="prod_box">
       
</div>
      <div class="prod_box">
</div>
      <div class="center_title_bar">Polecane Produkty</div>
      <div class="prod_box">
        <div class="center_prod_box">
          <div class="product_title"><a href="#">Makita 156 MX-VL</a></div>
          <div class="product_img"><a href="#"><img src="images/p7.jpg" alt="" border="0" /></a></div>
          <div class="prod_price"><span class="reduce">350zl</span> <span class="price">270zl</span></div>
        </div>
        <div class="prod_details_tab"> <a href="#" class="prod_buy">Do Koszyka</a> <a href="#" class="prod_details">Wiecej</a> </div>
      </div>
      <div class="prod_box">
        <div class="center_prod_box">
          <div class="product_title"><a href="#">Bosch XC</a></div>
          <div class="product_img"><a href="#"><img src="images/p1.jpg" alt="" border="0" /></a></div>
          <div class="prod_price"><span class="reduce">350zl</span> <span class="price">270zl</span></div>
        </div>
        <div class="prod_details_tab"> <a href="#" class="prod_buy">Do Koszyka</a> <a href="#" class="prod_details">Wiecej</a> </div>
      </div>
      <div class="prod_box">
        <div class="center_prod_box">
          <div class="product_title"><a href="#">Lotus PP4</a></div>
          <div class="product_img"><a href="#"><img src="images/p3.jpg" alt="" border="0" /></a></div>
          <div class="prod_price"><span class="reduce">350zl</span> <span class="price">270zl</span></div>
        </div>
        <div class="prod_details_tab"> <a href="#" class="prod_buy">Do Koszyka</a> <a href="#" class="prod_details">Wiecej</a> </div>
      </div>
    </div>
    <!-- end of center content -->
    <div class="right_content">
      <div class="title_box">Szukaj</div>
      <div class="border_box">
        <input type="text" name="newsletter" class="newsletter_input" value="slowo"/>
        <a href="#" class="join">szukaj</a> </div>
      <div class="shopping_cart">
        <div class="title_box">W�zek</div>
        <div class="cart_details"> 3 Rzeczy <br />
          <span class="border_cart"></span> Total: <span class="price">1299zl</span> </div>
        <div class="cart_icon"><a href="#"><img src="images/shoppingcart.png" alt="" width="35" height="35" border="0" /></a></div>
      </div>
      <div class="title_box">Co nowego?</div>
      <div class="border_box">
        <div class="product_title"><a href="#">Makieta 156 MX-VL</a></div>
        <div class="product_img"><a href="#"><img src="images/p2.jpg" alt="" border="0" /></a></div>
        <div class="prod_price"><span class="reduce">350zl</span> <span class="price">270zl</span></div>
      </div>
      <div class="title_box">Firmy</div>
      <ul class="left_menu">
        <li class="odd"><a href="#">Bosch</a></li>
        <li class="even"><a href="#">Samsung</a></li>
        <li class="odd"><a href="#">Makita</a></li>
        <li class="even"><a href="#">LG</a></li>
        <li class="odd"><a href="#">Fujitsu Siemens</a></li>
        <li class="even"><a href="#">Motorola</a></li>
        <li class="odd"><a href="#">Phillips</a></li>
        <li class="even"><a href="#">Beko</a></li>
      </ul>
      <div class="banner_adds"> <a href="#"><img src="images/bann1.jpg" alt="" border="0" /></a> </div>
    </div>
    <!-- end of right content -->
  </div>
  <!-- end of main content -->
  <div class="footer">
    <div class="left_footer"> <img src="images/footer_logo.png" alt="" width="89" height="42"/> </div>
    <div class="center_footer"> Template name. All Rights Reserved 2008<br />
     
      <img src="images/payment.gif" alt="" /> </div>
    
  </div>
</div>
<!-- end of main_container -->
</body>
</html>
