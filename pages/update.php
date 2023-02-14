<?php
	include "db/db_con.php";
	$qty=$_POST['txt_qty'];
	$caid = $_POST['txt_ca'];
	for ($i = 0; $i < count($caid);$i++){
		$sql="update tbl_cartitem set Qty ='".$qty[$i]."' WHERE CaID='".$caid[$i]."';";

	}
	$result= mysqli_query($conn, $sql);
	$conn->close();
	if(!$result){
		echo 'Error updating a record';
	}else{
		header("location: ../index.php?p=shoping-cart");
	}
?>