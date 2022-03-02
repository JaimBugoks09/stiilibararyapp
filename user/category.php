<?php 
include_once "./connections/travelclass.php";
$con = $lib->openConnection();

$cat_lang = $con->prepare("SELECT * FROM category");
$cat_lang->execute();

$cat_course = $con->prepare("SELECT * FROM course");
$cat_course->execute();

$cat_shelter = $con->prepare("SELECT * FROM shelter");
$cat_shelter->execute();

; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage | Page</title>
    
    <link rel="stylesheet" href="./assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/W3CSS//w3.css">
    <link rel="stylesheet" href="./assets/css/materialize.min.css">
    <link rel="stylesheet" href="./assets/fontawesome/css/all.min.css">
    <style>
        body{
            background: radial-gradient(circle at top, blue, crimson);
            color: white;
        }

        #nav{
            background-blend-mode: screen;
            opacity: 0.8;
        }
        form h5#categ {
            color: yellow;
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
            transition: 0.5s ease-in;
            transform: scale(1.1);
        }

        #container #cont:hover{
            background: green;
            background-blend-mode: screen;
            opacity: 0.9;
            transform: scale(0.99);
        }

        #container #box{
            box-shadow: 0 2px 10px #222;
        }


    </style>
</head>
<body>


    <?php include('./link_categ.php') ; ?>

    <div id="container" class="container">
    <div class="row">
        <div class="col s12 m12 l12 right-align" style="margin-bottom: 20px;">
            <a href="./home.php" class="btn orange white-text"> Show All</a>
        </div>
        <div id="box" style="margin-bottom: 20px;" class="col s12 m12 l12">
            <header class="black lighten-4" style="padding: 5px 10px;">Language</header>
            <?php 
                if($cat_lang->rowCount() > 0)
                {
                    while($val = $cat_lang->fetch())
                    {
                    ?>
                    <div id="cont" class="col s6 m6 l6">
                        <a href="./category_result.php?id=<?php echo $val['category_id'] ?>" class="white-text"><?php echo $val['classname'] ; ?></a>
                    </div>

                    <?php

                    }
                }
            
            ; ?>
        </div>
        
        <div id="box" style="margin-bottom: 20px;" class="col s12 m12 l12">
            <header class="black lighten-4" style="padding: 5px 10px;">Course</header>

            <?php 
                if($cat_course->rowCount() > 0)
                {
                    while($val = $cat_course->fetch())
                    {
                    ?>
                    <div id="cont" class="col s6 m6 l6">
                        <a href="./category_course.php?id=<?php echo $val['course_id'] ?>" class="white-text"><?php echo $val['course'] ; ?></a>
                    </div>

                    <?php

                    }
                }
            
            ; ?>

        </div>
        
        <div id="box" style="margin-bottom: 20px;" class="col s12 m12 l12">
            <header class="black lighten-4" style="padding: 5px 10px;">Shelter</header>
            <?php 
                if($cat_shelter->rowCount() > 0)
                {
                    while($val = $cat_shelter->fetch())
                    {
                    ?>
                    <div id="cont" class="col s6 m6 l6">
                        <a href="./category_shelter.php?id=<?php echo $val['shelter_id'] ?>" class="white-text"><?php echo $val['shelter'] ; ?></a>
                    </div>

                    <?php

                    }
                }
            
            ; ?>
        </div>

    </div>
    </div>
    

    <script defer src="./assets/js/jquery-1.7.2.min.js"></script>
    <script defer src="./assets/js/materialize.min.js"></script>
    <script src="./assets/fontawesome/js/all.min.js"></script>

</body>
</html>