<?php
session_start();
include('../connect.php');

$question_no = "";
$question = "";
$opt1 = "";
$opt2 = "";
$opt3 = "";
$opt4 = "";
$answer = "";
$count = "";
$ans = "";

$queno = $_GET['questionno'];

if(isset($_SESSION['answer'][$queno])){
    $ans = $_SESSION["answer"][$queno];
}

$res = mysqli_query($connect, "SELECT * from questions where category='$_SESSION[exam]' && question_no=$_GET[questionno]");
$count = mysqli_num_rows($res);
if($count == 0){
    echo "over";
}else{
    while($row = mysqli_fetch_array($res)){
        $question_no = $row["question_no"];
        $question = $row["question"];
        $opt1 = $row["opt1"];
        $opt2 = $row["opt2"];
        $opt3 = $row["opt3"];
        $opt4 = $row["opt4"]; 
    }
    ?>
    <br>
    <table>
        <tr>
            <td colspan="2" class="h4 m-3">
                <?php
                echo "(" . $question_no . ") " . $question;
                ?>
            </td>
        </tr>
    </table>
    <table class="h5 m-3">
        <tr>
            <td>
                <input type="radio" name="r1" id="r1_opt1" value="<?php echo $opt1;?>" onclick="radioclick(this.value,<?php echo $question_no ?>)"
                <?php
                if($ans == $opt1){
                    echo "checked";
                }
                ?>>
            </td>
            <td class="pl-2">
                <?php
                    echo $opt1;
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <input type="radio" name="r1" id="r1_opt2" value="<?php echo $opt2;?>" onclick="radioclick(this.value,<?php echo $question_no ?>)"
                <?php
                if($ans == $opt2){
                    echo "checked";
                }
                ?>>
            </td>
            <td class="pl-2">
                <?php
                    echo $opt2;
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <input type="radio" name="r1" id="r1_opt3" value="<?php echo $opt3;?>" onclick="radioclick(this.value,<?php echo $question_no ?>)"
                <?php
                if($ans == $opt3){
                    echo "checked";
                }
                ?>>
            </td>
            <td class="pl-2">
                <?php
                    echo $opt3;
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <input type="radio" name="r1" id="r1_opt4" value="<?php echo $opt4;?>" onclick="radioclick(this.value,<?php echo $question_no ?>)"
                <?php
                if($ans == $opt4){
                    echo "checked";
                }
                ?>>
            </td>
            <td class="pl-2">
                <?php
                    echo $opt4;
                ?>
            </td>
        </tr>
    </table>
    <?php
}
?>
