<?php
include('head_admin.php');
include('../connect.php');
if (isset($_SESSION['username']) && $_SESSION['password']) {

?>
<?php
//pagination
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$row = 5;
$offset = ($page - 1) * $row;

$sql = "SELECT * FROM `add_exams` ORDER BY `id` ASC LIMIT {$offset},{$row}";
$result = mysqli_query($connect, $sql) or die("query failed");
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
            <a class="navbar-brand alert-link" href="#">ADD EXAMS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="ml-auto">
                <div class="form-group d-flex">
                    <input type="text" class="form-control shadow" name="search1" id="inputEmail" placeholder="Find Exam or Time">
                    <button class="btn bg-dark border border-danger shadow text-light ml-2" name="search">Search</button>
                </div>
            </form>
            <?php
            //Search

            ?>

        </nav>
    </div>
    <div class="">

        <?php
        $qur = "SELECT * FROM `add_exams`";
        $res = mysqli_query($connect, $qur);

        ?>
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 border border-dark mx-2">
            <div class="alert alert-link alert-primary text-center mt-3" role="alert">
                Exam Categories
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Exam Name</th>
                        <th scope="col">Exam Time</th>
                        <th scope="col">Select</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_POST['search'])) {
                        $search = $_POST['search1'];
                        $que = mysqli_query($connect, "SELECT * FROM `add_exams` WHERE time like '%$search%' or exam like '%$search%'");

                        if ($que) {
                            if (mysqli_num_rows($que) > 0) {
                                while ($item = mysqli_fetch_assoc($que)) {
                                    $id = $item['id'];
                                    // echo "$id";
                                    echo "<tr>";
                                    echo "<th scope=row>" . $item['id'] . "</th>";
                                    echo "<td>" . $item['exam'] . "</td>";
                                    echo " <td>" . $item['time'] . "</td>";
                                    echo " <td><a href='questions.php?id=$id'><button type=button class='btn btn-success btn-sm border border-light'>Select</button></a></td>";

                                    echo "</tr>";
                                }
                            } else {
                                echo '<div class="alert alert-danger" role="alert">
                                 No Such Data Exist
                                </div>';
                            }
                        }
                    } else {
                        while ($item = mysqli_fetch_array(($result))) {

                            $id = $item['id'];
                            // echo "$id";
                            echo "<tr>";
                            echo "<th scope=row>" . $item['id'] . "</th>";
                            echo "<td>" . $item['exam'] . "</td>";
                            echo " <td>" . $item['time'] . "</td>";
                            echo " <td><a href='questions.php?id=$id'><button type=button class='btn btn-success btn-sm border border-light'>Select</button></a></td>";

                            echo "</tr>";
                        }
                    }

                    ?>
                </tbody>
            </table>
            <?php
            $sql1 = "SELECT * from `add_exams`";
            $result1 = mysqli_query($connect, $sql1);

            $num = mysqli_num_rows($result1);
            if ($num > 0) {
                $offset1 = ceil($num / $row);
                echo '
                    <nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
                ';
                if ($page > 1) {
                    echo '<li class="page-item">
      <a class="page-link" href="add_questions.php?page=' . ($page - 1) . '">Previous</a>
    </li>';
                }
                for ($i = 1; $i <= $offset1; $i++) {
                    if ($i == $page) {
                        $active = "active";
                    } else {
                        $active = "";
                    }
                    echo '    <li class="page-item"><a class="page-link" href="add_questions.php?page=' . $i . '">' . $i . '</a></li>';
                }
                if ($offset1 > $page) {
                    echo ' <li class="page-item">
      <a class="page-link" href="add_questions.php?page=' . ($page + 1) . '">Next</a>
    </li>
  </ul>
</nav>';
                }
            }
            ?>
        </div>
    </div>
</div>



<!-- add exams -->


<!-- Bootstrap JS and dependencies -->
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