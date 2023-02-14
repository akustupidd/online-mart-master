<?php
	/*$host = "localhost"; //127.0.0.1
	$user ="root";
	$pwd ="";
	
	$conn = mysqli_connect($host,$user,$pwd);
	if(!$conn){
		die("Connection Failed".mysqli_connect_error());
	}
	$conn = mysqli_connect($host,$user,$pwd);
	if(!$conn){
		die("Connection Failed".mysqli_connect_error());
		
	}
	mysqli_select_db($conn,"webshop") or die("Error in selecting database");
	
	*/
	$host = "localhost:3306"; 
	$user ="root";
	$pwd ="";
	 mysqli_report(MYSQLI_REPORT_STRICT);
	
	// Create connection
	$conn = new mysqli($host, $user, $pwd);

	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	mysqli_select_db($conn,"onlinemart") or die("Error in selecting database");
	#echo "Connection Successfuly!";

	
	function msgstyle($msg,$type){
		switch($type){
			case 'success':
				echo'
					<div class="alert alert-success" role="alert">
					  <strong>Success!</strong> '.$msg.'
					</div>
				';
				break;
			case 'info':
				echo'
					<div class="alert alert-info" role="alert">
					  <strong>info!</strong> '.$msg.'
					</div>
				';
				break;	
			case 'warning':
				echo'
					<div class="alert alert-warning" role="alert">
					  <strong>warning!</strong> '.$msg.'
					</div>
				';
				break;	
			case 'danger':
				echo'
					<div class="alert alert-danger" role="alert">
					  <strong>danger!</strong> '.$msg.'
					</div>
				';
				break;			
		}
	}
	
	
?>