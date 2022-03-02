<?php 

session_start();
include_once "./connections/travelclass.php";
$con = $lib->openConnection();


; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/materialize.min.css">
    <link rel="stylesheet" href="./assets/css/W3CSS/w3.min.css">
    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body{
            background: url("./assets/img/bg.jpg");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            
        }

        form{
            margin-top: 40px;
            border-radius: 20px;
            box-shadow: 0 2px 10px #222, 0 2px 10px #222;
            background-blend-mode: screen;
            opacity: 0.9;
        }
        #btn_login{
            background: dodgerblue;
        }
        #btn_login:hover{
            background: lime;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col s12 m12 l12">
                <form action="" method="post" class="col s12 m10 l10 offset-m1 offset-l1" style="padding: 0 0;">
                <header class="green center-align white-text" style="padding: 20px 10px; border-top-left-radius: 20px; border-top-right-radius: 20px">LOGIN</header>
                <br>

                    <div class="container">
                        <select name="course" required="required" class="browser-default">
                            <option disabled selected>Choose Your Course/Strand</option>
                            <?php 
                                $sel_course = $con->prepare("SELECT * FROM course");
                                $sel_course->execute();
                                $sel_course_count = $sel_course->rowCount();

                                if($sel_course_count > 0){
                                    while($course = $sel_course->fetch()){
                            ; ?>
                            <option value="<?php echo $course['course_id'] ?>"><?php echo $course['course'] ?></option>
                            <?php  }}; ?>
                        </select>
                        <div class="input-field black">
                            <label for="school-id" class="white-text" style="padding: 0 10px;">School ID: </label>
                            <input type="text" name="school_id" class="white-text" style="padding: 0 10px;" maxlength="11" onkeypress="IsInputNumber(event)">
                        </div>
                    </div>
                    <br>
                    <div class="col s12 m12 l12 center-align">
                        <button class="btn waves-effect" id="btn_login" name="btn_login">LOGIN</button>
                    </div>
                    <br><br><br>
                    
                </form>
            </div>
        </div>
    </div>

    <?php 
        if(isset($_POST['btn_login']))
        {
            $school_id = $_POST['school_id'];
            $course_id = $_POST['course'];
            if(strlen($school_id) <= 6){
                $stmt = $con->prepare("SELECT * FROM user WHERE school_number = ? AND course = ?");
                $stmt->execute([$school_id, $course_id]);

                $check = $stmt->rowCount();

                if($check > 0){
                    $val = $stmt->fetch();
                    $u_id = $val['user_id'];

                    $u_name = $val['firstname']." ".$val['middlename']." ".$val['lastname'];
                    $_SESSION['user_id'] = $val['user_id'];
                    $stmt1 = $con->prepare("INSERT INTO user_log (`user_id`, `user_name`) VALUES(?,?)");
                    $stmt1->execute([$u_id, $u_name]);

                    // header("Location: ./home.php");
                    ?>
                    <script>
                        window.location.href = "./home.php";
                    </script>

                    <?php
                }else{
                    ?>
                    <script>
                        window.location.href = "./school_id_err.php?status=not_found";
                    </script>
                    <?php
                }
                
            }else{
                ?>
                <script>
                    window.location.href = "./school_id_err.php?status=not_valid";
                </script>
                <?php
            }

            
        } ; 
    ?>

    <script src="./assets/js/jquery-1.7.2.min.js"></script>
    <script src="./assets/js/materialize.min.js"></script>
    <script>
        function IsInputNumber(evt) {
            var ch = String.fromCharCode(evt.which);
            if(!(/[0-9]/D.test(ch))){
                evt.preventDefault();
                
            }
        }
    </script>
</body>
</html>