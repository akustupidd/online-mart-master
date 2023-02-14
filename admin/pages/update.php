<?php
	include "conn_db/db_config.php";
	$id=$_GET['id'];
	
	$username = $_POST['txt_username'];
	$gmail = $_POST['txt_gmail'];
	$password = $_POST['txt_pwd'];
	$role = $_POST['txt_role'];
	$passwordmd5= md5 ($password);
	$sql = "update tbl_admin set user_name='$username',
	gmail='$gmail',user_pwd='$passwordmd5',role_id='$role' where user_id=$id";
	$result=mysqli_query($conn, $sql);
	$conn ->close();
	if(!$result){
		echo 'Error updating a record';
	}else{
		header("location: ../index.php?p=adminlist");
	}
?>
