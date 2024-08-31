<?php
include('head_admin.php');
include('../connect.php');
if (isset($_SESSION['username']) && $_SESSION['password']) {

$id=$_GET['id'];
// echo "$id";
$que=mysqli_query($connect,"SELECT * FROM `add_exams` WHERE id='$id'");
$item=mysqli_fetch_array(($que));

?>
<div class="content p-0">
    <!-- Main Content -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand alert-link" href="#">EXAMANIES !</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
        </div>
    </nav>
    <hr class="m-2">
    <!-- Add your main page content here -->
    <div class="content p-0">
        <!-- Main Content -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand alert-link" href="#">EDIT EXAMS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


        </nav>
    </div>
    <div class="row m-3">
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">

            <form class="m-auto p-3 border border-dark " action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="alert alert-link alert-primary text-center" role="alert">
                    Edit Exam
                </div>
                <input type="text" name="id" value="<?php echo $item['id']?>" hidden/>

                <div class="form-group">
                    <label for="exampleInputEmail1">New Exam Category</label>
                    <input type="text" class="form-control" id="exampleInputEmail1 examname" aria-describedby="emailHelp" name="examname" required placeholder="Add New Exam" value="<?php echo $item['exam'] ;?>">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Exam Time In Minutes</label>
                    <input type="text" class="form-control" id="exampleInputPassword1 examtime" name="examtime" required placeholder="Add Timespan For Exam " value="<?php echo $item['time'] ;?>">
                </div>

                <button type="submit" class="btn btn-primary" name="update">Update Exam</button>
               
                
            </form>

            <?php
        if(isset($_POST['update'])){
            $exam=$_POST['examname'];
            $time=$_POST['examtime'];
            $id=$_POST['id'];

            $updated=mysqli_query($connect,"UPDATE `add_exams` SET `exam`='$exam',`time`='$time' WHERE id=$id");
            if($updated){
                ?>
                <script>
                    window.location="exam_category.php";
                </script>
                <?php
                
            }
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