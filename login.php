<?php
include('connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Login</title>
</head>

<body>
    <form class="m-auto p-3 border border-dark w-50" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="alert alert-link alert-primary text-center" role="alert">
            Login Form
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary" name="submit">Log in</button>
        <small id="emailHelp" class="form-text text-muted "><a href="registration.php">New user? Register here</a></small>


        <!-- <div class="alert alert-success m-3" role="alert" style="display:none" id="success">
            <a href="#" class="alert-link">Success !</a> Registration Completed.
        </div> -->
        <div class="alert alert-danger m-3" role="alert" style="display:none" id="failure">
            <a href="#" class="alert-link">Invalid Credential</a> Try Again.
        </div> 
    </form>
    <?php
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $logged = mysqli_query($connect,"SELECT  `email`, `password` FROM `registration` WHERE `password`='{$password}' AND email='{$email}'");
        if (mysqli_num_rows($logged) > 0) {
            while($newrow=mysqli_fetch_assoc($logged)){
                session_start();
                $_SESSION['email']=$newrow['email'];
                $_SESSION['password']=$newrow['password'];
                header("location:select_exam.php");

            }
    
        }else{
            ?>
            <!-- javascript -->
            <script>
                document.getElementById("failure").style.display="block";
            </script>
        <?php
        }
    }
    ?>
</body>

</html>