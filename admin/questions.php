<?php
include('head_admin.php');
include('../connect.php');
if (isset($_SESSION['username']) && $_SESSION['password']) {

$id = isset($_GET["id"]) ? $_GET["id"] : ''; // Check if 'id' is set, otherwise assign an empty string
$exam_category = '';

if ($id != '') {
    $que = mysqli_query($connect, "SELECT * FROM `add_exams` WHERE id='$id'");
    while ($item = mysqli_fetch_array($que)) {
        $exam_category = $item['exam'];
    }
} else {
    // Handle the case when 'id' is not set, maybe redirect or show an error
    echo "Invalid exam ID.";
    exit;
}
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
            <a class="navbar-brand alert-link" href="#">Add Questions in <?php echo $exam_category; ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">

        <form class="m-auto p-3 border border-dark" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" method="post">
            <div class="alert alert-link alert-primary text-center" role="alert">
                Create Questions Here
            </div>

            <input type="text" name="category" value="<?php echo $exam_category ?>" hidden/>

            <div class="form-group">
                <label for="exampleInputEmail1">Add Question</label>
                <input type="text" class="form-control" id="exampleInputEmail1 examname" aria-describedby="emailHelp" name="question" required placeholder="Write a Question">
            </div>
            <div class="row">
                <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Option 1</label>
                        <input type="text" class="form-control" id="exampleInputEmail1 examname" aria-describedby="emailHelp" name="opt1" required placeholder="Write Option">
                    </div>
                </div>
                <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Option 2</label>
                        <input type="text" class="form-control" id="exampleInputEmail1 examname" aria-describedby="emailHelp" name="opt2" required placeholder="Write Option">
                    </div>
                </div>
                <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Option 3</label>
                        <input type="text" class="form-control" id="exampleInputEmail1 examname" aria-describedby="emailHelp" name="opt3" required placeholder="Write Option">
                    </div>
                </div>
                <div class="col-xl-6 col-sm-6 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Option 4</label>
                        <input type="text" class="form-control" id="exampleInputEmail1 examname" aria-describedby="emailHelp" name="opt4" required placeholder="Write Option">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Add Answer</label>
                <input type="text" class="form-control" id="exampleInputEmail1 examname" aria-describedby="emailHelp" name="answer" required placeholder="Correct Answer">
            </div>

            <button type="submit" class="btn btn-primary" name="create">Create Exam</button>
        </form>

        <?php
        if (isset($_POST['create'])) {
            $loop = 0;
            $count = 0;
            $res = mysqli_query($connect, "SELECT * from `questions` where category='$exam_category' order by id asc");
            $count = mysqli_num_rows($res);
            if ($count != 0) {
                while ($item = mysqli_fetch_array($res)) {
                    $loop++;
                    mysqli_query($connect, "UPDATE `questions` SET `question_no`='$loop' where id=$item[id]");
                }
            }
            $loop++;
            mysqli_query($connect, "INSERT INTO `questions`(`id`, `question_no`, `question`, `opt1`, `opt2`, `opt3`, `opt4`, `answer`, `category`) VALUES ('', '$loop', '$_POST[question]', '$_POST[opt1]', '$_POST[opt2]', '$_POST[opt3]', '$_POST[opt4]', '$_POST[answer]', '$_POST[category]')");
            ?>
            <script>
                alert('Question Added Successfully');
                window.location.href = window.location.href.split('?')[0] + "?id=<?php echo $id; ?>"; 
            </script>
            <?php
        }
        ?>
    </div>
</div>

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
