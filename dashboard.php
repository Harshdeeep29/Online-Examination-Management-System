<?php
include('head.php');
if (isset($_SESSION['email']) && $_SESSION['password']) {

?>
<div class="container">
    <div class="row">
        <br>
        <!-- <div class="col-lg-2 col-lg-push-10">
            <div id="current_que" style="float: left;">0</div>
            <div style="float: l eft;">/</div>
            <div id="total_que" style="float: left;">0</div>
        </div> -->
    </div>
    <div class="card">
    <div class="ml-auto d-inline-flex m-2">
            <div id="current_que" style="float: left;">0</div>
            <div style="float: l eft;">/</div>
            <div id="total_que" style="float: left;">0</div>
        </div>
        <h5 class="card-header h4  " id="load_questions">Questions</h5>
            <div class="next_previous_button">
                <input href="#" class="btn btn-primary m-4" onclick="load_previous();" value="pervious" type="button"></a>
                <input href="#" class="btn btn-primary m-4" onclick="load_next();" value="next" type="button"></a>
            </div>
    </div>
</div>

<script type="text/javascript">
    function load_total_que() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("total_que").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","forajax/load_total_que.php", true);
        xmlhttp.send(null);

    }

    function radioclick(radiovalue,questionno){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("total_que").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","forajax/save_answer_in_session.php?questionno="+ questionno +"&value1="+radiovalue, true);
        xmlhttp.send(null);
    }

    var questionno = "1";
    load_questions(questionno);

    function load_questions(questionno) {
        document.getElementById("current_que").innerHTML = questionno;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                if (xmlhttp.responseText == "over") {
                    window.location = "result.php";
                } else {
                    document.getElementById("load_questions").innerHTML = xmlhttp.responseText;
                    load_total_que();
                }
            }
        };
        xmlhttp.open("GET", "forajax/load_questions.php?questionno=" + questionno, true);
        xmlhttp.send(null);
    }

    function load_previous(){
        if(questionno=="1"){
        load_questions(questionno);

        }else{
            questionno=eval(questionno)-1;
            load_questions(questionno);
        }
    }
    function load_next(){
        questionno=eval(questionno)+1;
        load_questions(questionno);
    }
</script>
</body>

</html>
<?php
}else{
            header('location:login.php');
        }
        ?>