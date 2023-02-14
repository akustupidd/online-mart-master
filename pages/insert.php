<?php
	include "db/db_con.php";
	session_start();
	$productID=$_GET['pid'];
	$qty=$_POST['quantity'];
	if($_SESSION['id']){
		$user_id = $_SESSION['id'];
		$selectSeID="select * from tbl_session where user_id=$user_id";
		$selectResult=$conn->query($selectSeID);
		$rowSes=$selectResult->fetch_row();
		$ses_id=$rowSes[0];
		$check = "select* from tbl_cartitem where pid = '$productID' and SesID=	'$ses_id'";
		$CheckRes =$conn->query($check);
		$data = $CheckRes->fetch_row();
		if($data>1){
			if(empty($qty)){
				$sql="update tbl_cartitem set Qty=qty+1 where Pid='$productID' and SesID='$ses_id'";
			}else{
				$sql="update tbl_cartitem set Qty=qty+'$qty' where Pid='$productID' And SesID='$ses_id'";
			}
		}
		else{
			$selectP = "select Pprice from tbl_products where Pid =$productID";
			$selectPRes = $conn->query($selectP);
			$rowP = $selectPRes->fetch_row();
			if(empty($qty)){
				$sql="insert into tbl_cartitem(Pid,Pprice,Qty,SesID) Values('$productID','$rowP[0]',1,'$ses_id')";
			}else{
				$sql="insert into tbl_cartitem(Pid,Pprice,Qty,SesID) Values('$productID','$rowP[0]','$qty','$ses_id')";
			}
		}
		$result= mysqli_query($conn, $sql);
		$conn->close();
		if(!$result){
			echo "Add Error";
		}else{
			header("location: ../index.php?p=shop");
		}
	}else{
		header("location: login.php");
	}
	
	
?>
