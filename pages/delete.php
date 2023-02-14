<?php
	include "db/db_con.php";
	$cartid=$_GET['Caid'];
	$sql="delete from tbl_cartitem where CaID=$cartid";
	$result= mysqli_query($conn, $sql);
	$conn->close();
	
	if(!$result){
		echo " Err a deleting record";
	}else{
		header("location: ../index.php?p=shoping-cart");
	}
	
?>
