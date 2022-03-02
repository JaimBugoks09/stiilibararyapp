<?php 
include_once "./connections/travelclass.php";
$con = $lib->openConnection();

session_start();
$user_id = $_SESSION['user_id'];

$sel = $con->prepare("SELECT * FROM user_notification AS un
INNER JOIN user AS u
ON un.user_id = u.user_id
WHERE un.user_id = ? 
ORDER BY date_added DESC");
$sel->execute([$user_id]);
$check = $sel->rowCount();

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
    <link rel="stylesheet" href="./assets/fontawesome/css/all.min.css">
    <style>

        body{
            background-image: url("../library_system/admin/images/vnhs6.JPG");
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        #nav{
            background-blend-mode: screen;
            opacity: 0.8;
        }

        form h5#categ {
            color: white;
        }

        form h5#categ:hover{
            color: yellow;
            transform: scale(1.1);
        }

        form li#input-search>input{
            width: 100px;
        }
        form li#input-search>input:focus{
            transition: 1s;
            width: 200px;
        }

        header{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header img{
            border-radius: 50%;
        }

        #cont:hover{
            transition: 0.5s ease-in;
            background: radial-gradient(circle at right, #f2f2f2, blue);
            transform: scale(0.98);
            color: white;
        }

        #cat{
            background: radial-gradient(circle at top, indigo, dodgerblue);
            color: white;
            margin-top: -20px;
        }

        #cont:hover a{
            color: white;
        }
        
        #cont:hover #remarks{
            color: white;
        }

        #btn_download{
            background: #222;
            /* background: radial-gradient(circle at left, blue, dodgerblue); */
            mix-blend-mode: screen;
            box-shadow: 0 2px 10px #222;
        }

        #btn_reserved{
            background: #222;
            mix-blend-mode: screen;
            box-shadow: 0 2px 10px #222;
        }

        #btn_download:hover{
            background: radial-gradient(circle at left, blue, dodgerblue);
            transition: 9.5s ease-in;
            transform: scale(1.1);
        }
        #btn_reserved:hover{
            background: radial-gradient(circle at right, purple, indigo);
            transition: 9.5s ease-in;
            transform: scale(1.1);
        }
        #nav ul li a,
        #nav ul li button{
            font-size: 10px;
        }
        ul{
            list-style-type: none;
            
            display: flex;
            flex-direction: row;
            justify-content: flex-end;
            align-items: center;
        }

        ul li #btn_notif,
        ul li #btn_logout{
            background: orangered;
        }

        ul li #btn_notif:hover,
        ul li #btn_logout:hover{
            background: green;
        }
        
    </style>
</head>
<body onload="startTime()">


    <?php include('./link.php') ; ?>

    <div id="cat" class="col s12 m9 l9">
        <div class="row">

            <div class="col s12 m12 l12 center-align">

                <div id="result">
                </div>

            </div>

        </div>
    </div>

    
    <div id="book">
        <div class="row">
            <div class="col s12 m12 l12 left-align white-text">
                
                <table class="table striped">
                    <thead>
                        <tr class="blue">
                            <th style="padding: 5px 10px;"><header>Notifications</header></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if($check > 0){
                                while($val = $sel->fetch()){
                        ; ?>
                        <tr>
                            <td>
                                <div class="col s7 m7 l7" style="font-size: 12px;"><?php echo $val['message'] ; ?></div>
                                <div class="col s5 m5 l5 right-align">
                                    <span class="green" style="border-radius: 10px; padding: 5px 10px; font-size: 10px">
                                        <?php 
                                        $d = $val['date_added'];
                                        echo $d;
                                        ?>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        <?php }} ; ?>
                    </tbody>
                </table>
                <hr>
            </div>
        </div>
    </div>


    
    <script src="./assets/js/jquery-1.7.2.min.js"></script>
    <script src="./assets/js/materialize.min.js"></script>
    <script src="./assets/fontawesome/js/all.min.js"></script>
    <script>

        $(document).ready(function(){

            $('#search_book').keyup(function(){

                var txt = $(this).val();
                $('#book').hide();

                if(txt != '')
                {
                    $.ajax({
                        url: "fetch.php",
                        method: "get",
                        data: { search_book: txt },
                        dataType: "text",
                        success: function(data){
                            $('#result').html(data);
                        }
                    });
                }
                else
                {
                    $('#result').html('');
                    $('#book').show();
                }
            })

        });

        function myFunction(id) {
            document.getElementById(id).classList.toggle("w3-show");
        }



    </script>
</body>
</html>