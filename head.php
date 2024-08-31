<?php
session_start();
if (isset($_SESSION['email']) && $_SESSION['password']) {

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
  <title>Document</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand alert-link " href="#">EXAMANIES !</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Select Exam </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="old_exam_result.php">Last result</a>
        </li>

        <li class="nav-item">
          <a class="nav-link " href="logout.php">Logout</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
            <?php 
            echo $_SESSION['email']; ?>
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="logout.php">Log Out</a>
          </div>
        </div>
      </form>
    </div>
  </nav>
  <nav class="navbar navbar-light bg-dark">
    <span class="navbar-brand mb-0 h1 ml-auto text-light" id="countdowntimer">Navbar</span>
  </nav>
  <script type="text/javascript">
    setInterval(function() {
      timer();
    }, 1000);

    function timer() {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          if (xmlhttp.responseText == "00:00:01") {
            window.location = "result.php";
          }
          document.getElementById("countdowntimer").innerHTML = xmlhttp.responseText;
        }
      };
      xmlhttp.open("GET", "forajax/load_timer.php", true);
      xmlhttp.send(null);
    }
  </script>
   <?php
        }else{
            header('location:login.php');
        }
        ?>