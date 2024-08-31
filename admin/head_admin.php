<?php
session_start();
if (isset($_SESSION['username']) && $_SESSION['password']) {

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Left Sidebar with Dashboard Button</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="head.css">
    <style>
        .head_admin {
            display: flex;
            height: 100vh;
        }
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background-color: #343a40;
            color: white;
            padding: 15px;
        }
        .sidebar-btn {
            width: 100%;
            margin-bottom: 15px;
        }
        .content {
            flex-grow: 1; /* Ensure the main content takes up remaining space */
            padding: 20px;
        }
    </style>
</head>
<body class="head_admin">

    <!-- Left Sidebar -->
    <div id="sidebar">
        <h4>Menu</h4>
        <a href="exam_category.php"><button type="button" class="btn btn-primary sidebar-btn">Add & Edit Exam</button></a>
        <a href="add_questions.php"><button type="button" class="btn btn-primary sidebar-btn">Add & Edit Questions</button></a>
        <a href="results.php"><button type="button" class="btn btn-primary sidebar-btn">All Result</button></a>

        <a href="admin_logout.php"> <button type="button" class="btn btn-primary sidebar-btn">Log Out</button></a>

        <!-- Add more buttons here -->
    </div>
    
    <?php
}else{
            header('location:admin_login.php');
        }
        ?>