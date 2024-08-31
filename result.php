<?php
include('head.php');
include('connect.php');
if (isset($_SESSION['email']) && $_SESSION['password']) {

$date=date("Y-m-d H:i:s");
$_SESSION["end_time"]=date("Y-m-d H:i:s", strtotime($date."+ $_SESSION[exam_time] minutes"));
?>

<div class="conatiner">

    <?php
        $correct=0;
        $wrong=0;

        if(isset($_SESSION['answer'])){
            for($i=1;$i<=sizeof($_SESSION['answer']);$i++){
                $answer="";
                $res=mysqli_query($connect,"SELECT * from questions where category='$_SESSION[exam]' && question_no=$i");
                while($row=mysqli_fetch_array($res)){
                    $answer=$row["answer"];
                }
                if(isset($_SESSION["answer"] [$i])){
                    if($answer==$_SESSION["answer"] [$i]){
                        $correct=$correct+1;
                    }else{
                        $wrong=$wrong+1;
                    }
                }else{
                    $wrong=$wrong+1;
                }
            }
        }

        $count=0;
        $res=mysqli_query($connect,"SELECT * from questions where category='$_SESSION[exam]'");
        $count=mysqli_num_rows($res);
        $wrong=$count-$correct;
        echo"<br>"; echo"<br>";
        echo"<center>";
        echo"Total Question=".$count;
        echo"<br>";
        echo"Correct Answer=".$correct;
        echo"<br>";
        echo"Wrong Answer=".$wrong;
         echo"</center>";

    ?>
</div>

<?php
if(isset($_SESSION['exam_start'])){
    $date=date("y-m-d");
mysqli_query($connect,"INSERT INTO `exam_result`(`id`, `email`, `exam_type`, `total_question`, `correct_answer`, `wrong_answer`, `exam_time`) VALUES ('','$_SESSION[email]','$_SESSION[exam]','$count','$correct','$wrong','$date')");
}
if(isset($_SESSION["exam_start"])){
    unset($_SESSION["exam_start"]);
    ?>
        <script type="text/javascript">
            window.location.href=window.location.href;
        </script>
    <?php
}
 
        }else{
            header('location:login.php');
        }
        ?>