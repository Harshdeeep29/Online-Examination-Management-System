<?php
include('head.php');
include('connect.php');
if (isset($_SESSION['email']) && $_SESSION['password']) {

?>
<div class="mt-5 mb-3">
  <div class="alert alert-primary container m-auto  shadow w-50 text-center font-weight-bold " role="alert ">
    Last Exam Result
  </div>
</div>

<?php
$count = 0;
$res = mysqli_query($connect, "SELECT * FROM `exam_result` WHERE email='$_SESSION[email]' order by id desc");
$count = mysqli_num_rows($res);

if ($count == 0) {
  echo '<div class="mt-5">
<div class="alert alert-danger container m-auto  shadow w-50 text-center font-weight-bold " role="alert ">
  Last Exam Result
</div>
</div>';
} else {
  echo '
            <table class="table table-hover table-dark container m-auto  shadow w-75 rounded">
  <thead class="alert-secondary">
    <tr>
      <th scope="col">Email</th>
      <th scope="col">Exam Type</th>
      <th scope="col">Total Answers</th>
       <th scope="col">Correct Answers</th>
        <th scope="col">Wrong Answers</th>
      <th scope="col">Exam Time</th>

    </tr>
  </thead>
  <tbody>
    ';
  while ($row = mysqli_fetch_array($res)) {
    echo '
            <tr>
            <td>' . $row["email"] . '</td>
            <td>' . $row["exam_type"] . '</td>
            <td>' . $row["total_question"] . '</td>
            <td>' . $row["correct_answer"] . '</td>
            <td>' . $row["wrong_answer"] . '</td>
            <td>' . $row["exam_time"] . '</td>

            </tr>
        
        
            ';
  }
  echo "</tbody>
        </table>";
}
?>

</body>

</html>
<?php
}else{
            header('location:login.php');
        }
        ?>