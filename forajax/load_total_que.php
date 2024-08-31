<?php
session_start();
include('../connect.php');
$total_que=0;
$res1=mysqli_query($connect,"SELECT * from questions where category='$_SESSION[exam]'");
$total_que=mysqli_num_rows($res1);
echo $total_que;
?>