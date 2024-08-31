<?php
include('head_admin.php');
include('../connect.php');
if (isset($_SESSION['username']) && $_SESSION['password']) {

?>
<div class="content p-0">
    <!-- Main Content -->
    <nav class="navbar navbar-expand-lg navbar-light alert-primary ">
            <a class="navbar-brand alert-link text-dark font-weight-bold " href="#">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="dropdown ml-auto">
                    <button class="btn btn-secondary dropdown-toggle "  type="button" data-toggle="dropdown" aria-expanded="false">
                    <?php 
                     echo $_SESSION['username']; ?></button>
                    <div class="dropdown-menu" >
                        <a class="dropdown-item" href="admin_logout.php">Logout</a>
                    </div>
                </div>


        </nav>
    
    
    <hr class="m-2">
    <!-- Add your main page content here -->
    <div class="content p-0">
        <!-- Main Content -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand alert-link" href="#">ALL EXAMS RESULT</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="ml-auto">
                <div class="form-group d-flex">
                    <input type="text" class="form-control shadow" name="search1" id="inputEmail" placeholder="Find Any User">
                    <button class="btn bg-dark border border-danger shadow text-light ml-2" name="search">Search</button>
                </div>
            </form>

        </nav>
    </div>

    <div class="mt-5 mb-3">
  <div class="alert alert-primary container m-auto  shadow w-50 text-center font-weight-bold " role="alert ">
    All Exam Result
  </div>
</div>

<?php
$count = 0;
$res = mysqli_query($connect, "SELECT * FROM `exam_result` order by id desc");
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
    if (isset($_POST['search'])) {
      $search = $_POST['search1'];
      $que = mysqli_query($connect, "SELECT * FROM `exam_result` WHERE email like '%$search%'");

      if ($que) {
          if (mysqli_num_rows($que) > 0) {
              while ($item = mysqli_fetch_assoc($que)) {
                  $id = $item['id'];
                  // echo "$id";
                  echo '
                  <tr>
                  <td>' . $item["email"] . '</td>
                  <td>' . $item["exam_type"] . '</td>
                  <td>' . $item["total_question"] . '</td>
                  <td>' . $item["correct_answer"] . '</td>
                  <td>' . $item["wrong_answer"] . '</td>
                  <td>' . $item["exam_time"] . '</td>
      
                  </tr>
              
              
                  ';
              }
          } else {
              echo '<div class="alert alert-danger" role="alert">
               No Such Data Exist
              </div>';
          }
      }
  }else{
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
  }
  echo "</tbody>
        </table>";
}
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
<?php
}else{
            header('location:admin_login.php');
        }
        ?>