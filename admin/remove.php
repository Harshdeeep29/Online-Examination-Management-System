<?php
session_start();
if (isset($_SESSION['username']) && $_SESSION['password']) {

    include('../connect.php');
    $id=$_GET['id'];
    $que=mysqli_query($connect,"DELETE FROM `add_exams` WHERE id=$id");
    if($que){
        header("location:exam_category.php");
    }else{
        echo "failed";
    }
}else{
    header('location:admin_login.php');
}
?>