<?php
	include "db/db_con.php";
  $is_invalid = false;
  if(isset($_POST['submit'])){
    $useremail = $_POST['userEmail'];
    $password = $_POST['pass'];
    $sql = sprintf("select * from tbl_user where email='%s'",$useremail);
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
    if($user['role']=='user'){
      if($password==$user['password']){
        session_start();
        #session_regenerate_id(true);
       
        $_SESSION['id'] = $user['user_id'];
        $_SESSION['pass'] = $user['password'];
        $userid = $user['user_id'];
        $checkUser="select * from tbl_session where user_id = $userid ";
        $resultuser=$conn->query($checkUser);
        $ResUser = $resultuser->fetch_assoc();
        if($ResUser[0]==0){
          $insertSession="insert into tbl_session (user_id) values ($userid)";
          $resultInsert=$conn->query($insertSession);
        }
        header("location: ../index.php");
        exit;
      }
    }else{
      session_start();
      $_SESSION['id'] = $user['user_id'];
      $_SESSION['pass'] = $user['password'];
      header("location: ../Admin/index.php");
      exit();
    }
    $is_invalid = true;
  }

?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>
<style>
    body {
      margin-top: 100px;
  background-color: #9f9da7;
  font-size: 1.6rem;
  font-family: "Open Sans", sans-serif;
  color: #2b3e51;
  }

  h2 {
    font-weight: 300;
    text-align: center;
  }

  p {
    position: relative;
  }

  a,
  a:link,
  a:visited,
  a:active {
    color: #3ca9e2;
    -webkit-transition: all 0.2s ease;
    transition: all 0.2s ease;
  }
  a:focus, a:hover,
  a:link:focus,
  a:link:hover,
  a:visited:focus,
  a:visited:hover,
  a:active:focus,
  a:active:hover {
    color: #329dd5;
    -webkit-transition: all 0.2s ease;
    transition: all 0.2s ease;
  }

  #login-form-wrap {
    background-color: #fff;
    width: 35%;
    margin: 30px auto;
    text-align: center;
    padding: 20px 0 0 0;
    border-radius: 4px;
    box-shadow: 0px 30px 50px 0px rgba(0, 0, 0, 0.2);
  }

  #login-form {
    padding: 0 60px;
  }

  input {
    display: block;
    box-sizing: border-box;
    width: 100%;
    outline: none;
    height: 60px;
    line-height: 60px;
    border-radius: 4px;
  }

  input[type="email"],
  input[type="password"] {
    width: 100%;
    padding: 0 0 0 10px;
    margin: 0;
    color: #8a8b8e;
    border: 1px solid #c2c0ca;
    font-style: normal;
    font-size: 16px;
    -webkit-appearance: none;
      -moz-appearance: none;
            appearance: none;
    position: relative;
    display: inline-block;
    background: none;
  }
  input[type="email"]:focus,
  input[type="password"]:focus {
    border-color: #3ca9e2;
  }
  input[type="email"]:focus:invalid,
  input[type="password"]:focus:invalid {
    color: #cc1e2b;
    border-color: #cc1e2b;
  }
  input[type="email"]:valid ~ .validation,
  input[type="password"]:valid ~ .validation {
    display: block;
    border-color: #0C0;
  }
  input[type="email"]:valid ~ .validation span,
  input[type="password"]:valid ~ .validation span {
    background: #0C0;
    position: absolute;
    border-radius: 6px;
  }
  input[type="email"]:valid ~ .validation span:first-child,
  input[type="password"]:valid ~ .validation span:first-child {
    top: 30px;
    left: 14px;
    width: 20px;
    height: 3px;
    -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
  }
  input[type="email"]:valid ~ .validation span:last-child,
  input[type="password"]:valid ~ .validation span:last-child {
    top: 35px;
    left: 8px;
    width: 11px;
    height: 3px;
    -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
  }

  .validation {
    display: none;
    position: absolute;
    content: " ";
    height: 60px;
    width: 30px;
    right: 15px;
    top: 0px;
  }

  input[type="submit"] {
    border: none;
    display: block;
    background-color: #3ca9e2;
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    cursor: pointer;
    -webkit-transition: all 0.2s ease;
    transition: all 0.2s ease;
    font-size: 18px;
    position: relative;
    display: inline-block;
    cursor: pointer;
    text-align: center;
  }
  input[type="submit"]:hover {
    background-color: #329dd5;
    -webkit-transition: all 0.2s ease;
    transition: all 0.2s ease;
  }

  #create-account-wrap {
    background-color: #eeedf1;
    color: #8a8b8e;
    font-size: 14px;
    width: 100%;
    padding: 10px 0;
    border-radius: 0 0 4px 4px;
  }
</style>
<body>
<div id="login-form-wrap">
  <h2>Login</h2>
  <?php if($is_invalid):  ?>
    <em>Invalid Login</em>
  <?php endif;  ?>
  <form id="login-form" action="login.php" method="POST">
    <p>
    <input type="email" id="email" name="userEmail" placeholder="Email" required><i class="validation"><span></span><span></span></i>
    </p>
    <p>
    <input type="password" id="password" name="pass" placeholder="Password" required><i class="validation"><span></span><span></span></i>
    </p>
    <p>
    <input type="submit" name="submit" id="login" value="Login">
    </p>
  </form>
  <div id="create-account-wrap">
    <p> Not a member? <a href="signup.php">Create Account</a><p>
    <a href="../admin/index.php" style=" align-items: right;">Login As Admin</a>
  </div><!--create-account-wrap-->
</div><!--login-form-wrap-->
</body>
</html>