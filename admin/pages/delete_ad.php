
<?php
	include "conn_db/db_config.php";
	$id=$_GET['id'];
	
	$username = $_POST['txt_username'];
	$gmail = $_POST['txt_gmail'];
	$password = $_POST['txt_pwd'];
	$role = $_POST['txt_role'];
	
	$sql = "delete from tbl_admin where user_id=$id";
	$result=mysqli_query($conn, $sql);
	$conn ->close();
	if(!$result){
		echo 'Error delete a record';
	}else{
		header("location: ../index.php?p=adminlist");
	}
?>
