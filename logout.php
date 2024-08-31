<?php
session_start();
if (isset($_SESSION['email']) && $_SESSION['password']) {

session_destroy();
?>
<script>
    window.location="login.php";
</script>
<?php
}else{
            header('location:login.php');
        }
        ?>