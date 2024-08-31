<?php
session_start();
include('../connect.php');
$exam_category=$_GET['exam_category'];
$_SESSION['exam']=$exam_category;
$res=mysqli_query($connect,"SELECT * from `add_exams` where exam='$exam_category'");
while($row = mysqli_fetch_array($res)){
    $_SESSION['exam_time']=$row['time'];
}
$date=date("Y-m-d H:i:s");  

$_SESSION["end_time"]=date("Y-m-d H:i:s",strtotime($date."+$_SESSION[exam_time] minutes"));

$_SESSION['exam_start']="yes";
?>