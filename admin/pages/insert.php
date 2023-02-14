<?php
	include "conn_db/db_config.php";
	
	
	$username = $_POST['txt_username'];
	$gmail = $_POST['txt_gmail'];
	$password = $_POST['txt_pwd'];
	$role = $_POST['txt_role'];
	if(trim($username)!='' && trim($gmail) !='' && trim($password) !=''&& trim($role) !='' ){
		/*$sql = "insert into tbl_student (stu_name,stu_gender,stu_phone, stu_address) 
		VALUES('$stuname','$gender','$phone','$address');";
		echo $sql;
		$result = mysqli_query($conn, $sql);
		if(!$result){
			echo "Error in inserting a new record";
		}else{
			header("location: ../index.php?p=studentlist");
		}*/
		
		#MySqli prepare Statement
		$passwordmd5= md5 ($password);
		$sql = "insert into tbl_admin (
		user_name,
		gmail,
		user_pwd, 
		role_id
		)VALUES(
			'$username','$gmail','$passwordmd5','$role'
		);";
		#the (?,?,?,?)	parameter marker used for var biding
		$stmt= $conn->prepare($sql);
		#bind_param //s:string,i:int,d:float, b....
		$stmt ->bind_param("ssss",$name,$gmail,$password,$role);
		#$stmt->execute();
		if($stmt->execute()){
			header('location:../index.php?p=adminlist');
		}else{
			echo"Err inserting";
		}
	
	}else{
		echo'Transaction fialed!';
	}
	$conn->close();

?>
