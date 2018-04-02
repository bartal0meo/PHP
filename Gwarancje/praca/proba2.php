	<?php
	$db=mysqli_connect('127.0.0.1','root','','compiuter');
	$db -> query ('SET NAMES utf8');
	$db -> query ('SET CHARACTER_SET utf8_unicode_ci');
	if(mysqli_connect_errno()){
	 echo 'Brak połączenia z bazą:'.mysqli_connect_error();
	 die();
	}
		?>


<?php 
$query="SELECT * FROM test";
$result=$db->query($query);

$Data = date('Y-m-d');


?>


			<?
$data=$product['Data_B'];
$ile_dni = 730;
$nowa_data=strtotime("+ ".$ile_dni " day",strtotime($data));
echo date ("Y-m-d", $nowa_data);

?>