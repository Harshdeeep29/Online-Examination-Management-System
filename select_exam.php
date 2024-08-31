        <?php
        include('connect.php');
        include('head.php');
        if (isset($_SESSION['email']) && $_SESSION['password']) {
       
        $qur = "SELECT * FROM `add_exams`";
        $res = mysqli_query($connect, $qur);

        ?>
        <?php
        // Pagination
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $row = 8;
        $offset = ($page - 1) * $row;

        $sql = "SELECT * from `add_exams` order by `id` asc limit {$offset},{$row}";
        $result = mysqli_query($connect, $sql);

        ?>
        <div class="container border border-dark p-3 mt-5">
            <div class="alert alert-dark" role="alert">
                <a href="#" class="alert-link">SELECT A EXAM TO APPEARE</a>
            </div>
            <?php

            while ($item = mysqli_fetch_array(($result))) {
                $id = $item['id']; ?>
                <input type="text" class="alert alert-info m-1" value="<?php echo $item['exam'] ?>" onclick="set_exam_type_session(this.value)"><?php
            }?>

        </div>
        <?php
        $sql1 = "SELECT * from `add_exams`";
        $result1 = mysqli_query($connect, $sql1);

        $num = mysqli_num_rows($result1);
        if ($num > 0) {
            $offset1 = ceil($num / $row);
            echo '
                            <nav aria-label="Page navigation example" class="mt-2">
        <ul class="pagination justify-content-center">
                        ';
            if ($page > 1) {
                echo '<li class="page-item">
            <a class="page-link" href="select_exam.php?page=' . ($page - 1) . '">Previous</a>
            </li>';
            }
            for ($i = 1; $i <= $offset1; $i++) {
                if ($i == $page) {
                    $active = "active";
                } else {
                    $active = "";
                }
                echo '    <li class="page-item"><a class="page-link" href="select_exam.php?page=' . $i . '">' . $i . '</a></li>';
            }
            if ($offset1 > $page) {
                echo ' <li class="page-item">
            <a class="page-link" href="select_exam.php?page=' . ($page + 1) . '">Next</a>
            </li>
        </ul>
        </nav>';
            }
        }
        ?>
        <script type="text/javascript">
            function set_exam_type_session(exam_category) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        window.location = "dashboard.php";
                    }
                };
                xmlhttp.open("GET", "forajax/set_exam_type_session.php?exam_category=" + exam_category, true);
                xmlhttp.send(null);
            }
        </script>
        <!-- <script type="text/javascript">
            setInterval(function(){
                timer();
            },1000);
            function timer(){
                var xmlhttp=new XMLHttpRequest();
                xmlhttp.onreadystatechange=function(){
                    if(xmlhttp.readyState==4 && xmlhttp.status==200){
                        if(xmlhttp.responseText=="00:00:01"){
                            window.location="result.php";
                        }
                        document.getElementById("countdowntimer").innerHTML=xmlhttp.responseText;
                    }
                };
                xmlhttp.open("GET","forajax/load_timer.php",true);
                xmlhttp.send(null);
            }
        </script> -->
        </body>

        </html>
        <?php
        }else{
            header('location:login.php');
        }
        ?>