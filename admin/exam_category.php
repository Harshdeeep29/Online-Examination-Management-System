<?php
include('head_admin.php');
if (isset($_SESSION['username']) && $_SESSION['password']) {

?>
<div class="content p-0">
    <!-- Main Content -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light text-center">
        <a class="navbar-brand alert-link m-auto" href="#">Welcome To Admin Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Select Exam</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Last result</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Logout</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        Dropdown button
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </form>
        </div> -->
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
            <div class="dropdown ml-auto">
                    <button class="btn btn-secondary dropdown-toggle "  type="button" data-toggle="dropdown" aria-expanded="false">
                    <?php 
                     echo $_SESSION['username']; ?></button>
                    <div class="dropdown-menu" >
                        <a class="dropdown-item" href="admin_logout.php">Logout</a>
                    </div>
                </div>


        </nav>
    </div>
    <div class="row m-3">
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">

            <form class="m-auto p-3 border border-dark " action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="alert alert-link alert-primary text-center" role="alert">
                    Add Exam
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">New Exam Category</label>
                    <input type="text" class="form-control" id="exampleInputEmail1 examname" aria-describedby="emailHelp" name="examname" required placeholder="Add New Exam">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Exam Time In Minutes</label>
                    <input type="text" class="form-control" id="exampleInputPassword1 examtime" name="examtime" required placeholder="Add Timespan For Exam ">
                </div>

                <button type="submit" class="btn btn-primary" name="create">Create Exam</button>
                <!-- <small id="emailHelp" class="form-text text-muted "><a href="registration.php">New user? Register here</a></small> -->


                <!-- <div class="alert alert-success m-3" role="alert" style="display:none" id="success">
            <a href="#" class="alert-link">Success !</a> Registration Completed.
        </div> -->
                <!-- <div class="alert alert-danger m-3" role="alert" style="display:none" id="failure">
                    <a href="#" class="alert-link">Invalid Credential</a> Try Again.
                </div> -->
            </form>

            <?php
            include('../connect.php');

            if (isset($_POST['create'])) {
                $examname = $_POST['examname'];
                $examtime = $_POST['examtime'];
                $insert = mysqli_query($connect, "INSERT INTO `add_exams`(`id`, `exam`, `time`) VALUES ('','$examname','$examtime')");

                if ($insert) {
            ?>
                    <script>
                        alert("Exam added successfully")
                        window.location.href = window.location.href;
                    </script>
            <?php                }
            }
            ?>
        </div>
        <script>
            function validateForm() {
                var examname = document.getElementById("examname").value.trim();
                var examtime = document.getElementById("examtime").value.trim();

                if (examname === "" || examtime === "") {
                    alert("Please fill out all fields.");
                    return false; // Prevent form submission
                }

                return true; // Allow form submission
            }

            function clearForm() {
                document.getElementById("examname").value = "";
                document.getElementById("examtime").value = "";
            }
        </script>

        <?php
        $qur = "SELECT * FROM `add_exams`";
        $res = mysqli_query($connect, $qur);

        ?>
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 border border-dark">
            <div class="alert alert-link alert-primary text-center mt-3" role="alert">
                Exam Categories
            </div>
            <?php
            // Pagination
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            $row = 5;
            $offset = ($page - 1) * $row;

            $sql = "SELECT * from `add_exams` order by `id` asc limit {$offset},{$row}";
            $result = mysqli_query($connect,$sql);
            ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Exam Name</th>
                        <th scope="col">Exam Time</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($item = mysqli_fetch_array(($result))) {
                        $id = $item['id'];
                        // echo "$id";
                        echo "<tr>";
                        echo "<th scope=row>" . $item['id'] . "</th>";
                        echo "<td>" . $item['exam'] . "</td>";
                        echo " <td>" . $item['time'] . "</td>";
                        echo " <td><a href='edit.php?id=$id'><button type=button class='btn btn-success btn-sm border border-light'>Edit</button></a></td>";
                        echo " <td><a href='remove.php?id=$id'><button type=button class='btn btn-danger btn-sm border border-light'>Remove</button></a></td>";

                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <?php
            $sql1 = "SELECT * from `add_exams`";
            $result1 = mysqli_query($connect,$sql1);

            $num = mysqli_num_rows($result1);
            if ($num > 0) {
                $offset1 = ceil($num / $row);
                echo '
                    <nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
                ';
                if ($page > 1) {
                    echo '<li class="page-item">
      <a class="page-link" href="exam_category.php?page=' . ($page - 1) . '">Previous</a>
    </li>';
                }
                for ($i = 1; $i <= $offset1; $i++) {
                    if ($i == $page) {
                        $active = "active";
                    } else {
                        $active = "";
                    }
                    echo '    <li class="page-item"><a class="page-link" href="exam_category.php?page=' . $i . '">' . $i . '</a></li>';
                }
                if ($offset1 > $page) {
                    echo ' <li class="page-item">
      <a class="page-link" href="exam_category.php?page=' . ($page + 1) . '">Next</a>
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