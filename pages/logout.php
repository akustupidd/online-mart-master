<?php
    #if(isset($_GET['logout'])){
    #    session_destroy();
    ##    unset($_SESSION['id']);
    #    header("location: ../index.php");
    #}
    session_start();
    unset($_SESSION['id']);
    unset($_SESSION['pass']);
    header("location: ../index.php");