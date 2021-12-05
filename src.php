<?php
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['user_type'])){
    if($_SESSION['user_type']=="mentor"){
        header("location: Mentorwelcome.php");
    }elseif($_SESSION['user_type']=="mentee"){
        header("location: Menteewelcome.php");
    }

}else{
    header("location: loginselector.php");
}
?>