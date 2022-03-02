<?php 
session_start();
include_once "./connections/travelclass.php";
$con = $lib->openConnection();
$user_id = $_SESSION['user_id'];

$stmt = $con->prepare("SELECT * FROM user AS u
INNER JOIN course AS c
ON u.course = c.course_id WHERE u.user_id = ?");
$stmt->execute([$user_id]);

$f = $stmt->fetch();

if(isset($_POST['btn_logout']))
{
    unset($_SESSION);
    ?>
    <script>
        window.location.href = "./index.php";
    </script>
    <?php
}

if(isset($_POST['btn_notifs']))
{
    ?>
    <script>
        window.location.href = "./notification.php";
    </script>
    <?php
}

if(isset($_POST['categ']))
{
    ?>
    <script>
        window.location.href = "./category.php";
    </script>
    <?php
}


if(isset($_POST['btn_reserved']))
{
    ?>
    <script>
        window.location.href = "./reserved_books.php";
    </script>
    <?php
}


; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage | Accountz</title>
    <script defer src="./assets/js/jquery-1.7.2.min.js"></script>
    <link rel="stylesheet" href="./assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/W3CSS//w3.css">
    <link rel="stylesheet" href="./assets/css/materialize.min.css">
    <style>
        body{
            background: radial-gradient(circle at top, indigo, dodgerblue);
            color: white;
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
        ul{
            list-style-type: none;
            display: flex;
            flex-direction: row;
            justify-content: flex-end;
            align-items: center;
        }

        #nav ul li a,
        #nav ul li button{
            font-size: 10px;
        }


        #cont:hover{
            transition: 0.5s ease-in;
            background: radial-gradient(circle at right, #f2f2f2, blue);
            transform: scale(0.98);
            color: white;
        }

        #cont:hover a{
            color: white;
        }
        #cont:hover #remarks{
            color: white;
        }

        #btn_reserved{
            background: #222;
            mix-blend-mode: screen;
            box-shadow: 0 2px 10px #222;
        }

        #btn_reserved:hover{
            background: radial-gradient(circle at right, purple, indigo);
            transition: 9.5s ease-in;
            transform: scale(1.1);
        }

        .profile{
            padding: 20px 10px;
        }

        .profile img{
            border-radius: 50%;
            border: 10px groove dodgerblue;
        }

        #container{
            position: relative;
        }

        #top{
            height: 100%;
            height: 20vh;
            background: white;
        }

        #bottom{
            margin-top: -100px;
            z-index: 999999;
        }

        #top{
            background: url("./assets/img/bg.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            background-position: center center;
        }

        .profile{
            position: relative;
        }

        #btn_update{
            position: absolute;
            bottom: 20px;
            right: 15%;
        }

    </style>
</head>
<body>


    <?php include('./link.php') ; ?>

    <div id="cat" class="col s12 m9 l9">
        <div class="row">

            <div class="col s12 m12 l12 center-align">

                <div id="result">
                </div>

                <div id="container" class="container center-align">
                    <div id="top"></div>
                    <div id="bottom">
                        <span class="profile">
                            
                            <img src="../library_system/admin/upload/male_pic04.jpeg" width="150" height="150">
                            <a href="./upload_file.php" id="btn_update" style="color: white;border-radius: 50%; border: 2px solid white; padding: 4px 8px;" class="black"><i class="fa fa-user"></i></a>
                        
                        </span>
                        <div id="name">
                            <h5>
                                <?php echo $f['firstname']." ".$f['middlename']." ".$f['lastname'] ; ?>
                            </h5>
                        </div>
                        <div id="course" style="opacity: 0.9; color: #f2f2f2"><?php echo $f['course'] ; ?></div>
                        <div class="col s12 m12 l12">
                            <div>
                                <h6>Address: <span class="orange-text"><?php echo $f['address'] ; ?></span></h6>
                                <br>
                                <a href="./account_details.php"style="color: blue; background:white; border-radius: 10px; padding: 5px 10px">See more ...</a>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        
                        <div class="center-align">
                            <a href="./message.php?id=<?php echo $user_id; ?>" name="btn_comment" class="btn white blue-text"><i class="fa fa-comment"></i> Create Message</a>
                        </div>
                    </div>
                </div>

                <br>
                <br>
                <br>

                <!-- <div id="division" class="col s12 m12 l12">
                    <table>
                        <tr>
                            <td style="background: red; color: white-text">Title Here</td>
                            <td>Content</td>
                        </tr>
                        <tr>
                            <td style="background: red; color: white-text">Title Here</td>
                            <td>Content</td>
                        </tr>
                        <tr>
                            <td style="background: red; color: white-text">Title Here</td>
                            <td>Content</td>
                        </tr>
                        <tr>
                            <td style="background: red; color: white-text">Title Here</td>
                            <td>Content</td>
                        </tr>
                        <tr>
                            <td style="background: red; color: white-text">Title Here</td>
                            <td>Content</td>
                        </tr>
                    </table>
                </div> -->

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