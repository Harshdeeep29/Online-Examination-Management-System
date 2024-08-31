<?php
session_start();
if (isset($_SESSION['username']) && $_SESSION['password']) {

session_destroy();
       header('location:admin_login.php');
        }
        ?>