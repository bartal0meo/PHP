	<!DOCTYPE html>

    <head>
	<?php
	$db=mysqli_connect('127.0.0.1','root','','compiuter');
	$db -> query ('SET NAMES utf8');
	$db -> query ('SET CHARACTER_SET utf8_unicode_ci');
	if(mysqli_connect_errno()){
	 echo 'Connect Error'.mysqli_connect_error();
	 die();
	}
		?>


<?php 
$query="SELECT * FROM test";
$result=$db->query($query);

$Data = date('Y-m-d');


?>
<html>
    <head>
        <title>PHP HTML TABLE DATA SEARCH</title>
        <style>
            table,tr,th,td
            {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        
        <form action="proba.php" method="post">
            <input type="text" name="valueToSearch" placeholder="Item To Search"><br><br>
            <input type="submit" name="search" value="Find"><br><br>
            
            <table>
                <tr>
                    <th>Id</th>
                    <th>Product Name:</th>
                    <th>Purchase Date:</th>
                    <th>Warranty</th>
					<th>The Warranty expires:</th>
                </tr>

 <?php
 while($product=mysqli_fetch_assoc($result)) : ?>
 <tr>
       <div class="">
	   <center>
		
		 
         
        
						
		
							<br></br>
				<div><a><td> <?= $product['id']; ?></td></a></div>
				<div><a><td> <?= $product['name']; ?></td></a></div>
				<div><a><td> <?= $product['Data_B']; ?></td></a></div>
	
		 <?php $Date = strtotime($product['Data_B']);
		 
		
		$date_add=date('Y-n-j', strtotime('+2 year', $Date)); ?>
				
				<br></br>
				<td><li class="center_title_bar"><a>  
				<?php
				if ($date_add > $Data) {
   echo "Yes";
} else {
   echo "No";
} ?></a></li></td>

<div><a><td> <?= $date_add ?></td></a></div>
	

	</center>	

        </div>
       </tr>
	 
    <?php endwhile; ?>
        </table>
        </form>
        
    </body>
</html>