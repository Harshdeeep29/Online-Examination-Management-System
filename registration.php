<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Registration</title>
</head>

<body>
    <form class="m-auto p-3 border border-dark w-50" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="alert alert-link alert-primary text-center" role="alert">
             Registration Form
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">First Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="fname" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Last Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="lname" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Contact</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="phone" required>
        </div>


        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        <small id="emailHelp" class="form-text text-muted "><a href="login.php">Already a user? Login here</a></small>


        <div class="alert alert-success m-3" role="alert" style="display:none" id="success">
            <a href="#" class="alert-link">Success !</a> Registration Completed.
        </div>
        <div class="alert alert-danger m-3" role="alert" style="display:none" id="failure">
            <a href="#" class="alert-link">Already Exist</a> Email already exist.
        </div>
    </form>
    <?php
    include('connect.php');
    if (isset($_POST['submit'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $unique_user = mysqli_query($connect, "SELECT `email`,`username` from `registration` where email='{$email}' and username='{$username}'");
        if (mysqli_num_rows($unique_user) > 0) {
    ?>
            <!-- javascript -->
            <script>
                document.getElementById("failure").style.display = "block";
            </script>
        <?php
        } else {
            $insert = mysqli_query($connect, "INSERT INTO `registration`(`id`, `fname`, `lname`, `username`, `password`, `email`, `phone`) VALUES ('','$fname','$lname','$username','$password','$email','$phone')");
        ?>
            <!-- javascript -->
            <script>
                document.getElementById("success").style.display = "block";
            </script>
    <?php
        }
    }
    ?>
</body>

</html>