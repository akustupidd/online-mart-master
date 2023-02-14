<?php
include "conn_db/db_config.php";
if(isset($_GET['from'])=='Plist'){
	$id=$_GET['id'];
	$sql="delete from tbl_products where Pid=$id";
	$result= mysqli_query($conn, $sql);
	$conn->close();
	
	if(!$result){
		echo "Err a deleting record";
	}else{
		header("location: ../index.php?pt=productlist");
	}
}

	
?>
