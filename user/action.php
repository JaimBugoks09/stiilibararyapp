<?php 
include_once "./connections/travelclass.php";
$con = $lib->openConnection();

session_start();
$user_id = $_SESSION['user_id'];
$get_id = $_GET['id'];


$stmt = $con->prepare("SELECT * FROM book AS b
INNER JOIN category AS c
ON b.category_id = c.category_id WHERE b.book_id = ?");
$stmt->execute([$get_id]);

$stmt01 = $con->prepare("SELECT * FROM reserve_book AS rb
INNER JOIN notification AS n
ON n.user_id = rb.user_id AND n.book_id = rb.book_id
WHERE rb.book_id = ? AND rb.user_id = ? AND n.status = ?");
$stmt01->execute([$get_id, $user_id, 'ALLOWED']);

$s01_count = $stmt01->rowCount();

$f = $stmt->fetch();

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
            overflow: hidden;
        }

        #box{
            background: #222;
            color: #fff;
            background-blend-mode: screen;
            opacity: 0.9;
            border-radius: 20px;
            padding: 10px 20px;
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
            width: 150px;
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
            background: radial-gradient(circle at right, #f2f2f2, dodgerblue);
            transform: scale(1.1);
            color: white;
        }

        #cat{
            background: radial-gradient(circle at top, indigo, dodgerblue);
            color: white;
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
        
        .success{
            position: fixed;
            top: 5px;
            right: 2px;
            left: 10px;
            background: radial-gradient(circle at left center, limegreen, white);
            padding: 20px 20px;
            border-radius: 5px;
            border-left: 6px solid orange;
        }

        .check{
            position: absolute;
            top: 50%;
            left: 20px;
            transform: translateY(-50%);
            font-size: 30px;
            color: orangered;
        }

        .msg {
            font-size: 13px;
            color: white;
            text-shadow: 2px 2px #222;
            margin: 0 20px;
            user-select: none;
        }

        .crose {
            padding: 12px 18px;
            background: orangered;
            font-size: 30px;
            color: orange;
            position: absolute;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            cursor: pointer;
            transition: .3s;
        }

        .crose:hover {
            background-color: palegoldenrod;
        }

        .success.show {
            animation: show_slide 1s ease forwards;
        }

        @keyframes show_slide {
            0%{
                transform: translateX(80%);
            }
            40%{
                transform: translateX(-8%);
            }
            80%{
                transform: translateX(0%);
            }
            100%{
                transform: translateX(-8px);
            }
        }

        .success.hide {
            animation: hide_slide 1s ease forwards;
        }

        @keyframes hide_slide {
            0%{
                transform: translateX(-8px);
            }
            40%{
                transform: translateX(0%);
            }
            80%{
                transform: translateX(-8%);
            }
            100%{
                transform: translateX(80%);
            }
        }

        
    </style>
</head>
<body onload="startTime()">
    <?php include('./link.php') ; ?>
    
    <!-- <div id="txt" class="black white-text" style="padding: 10px 20px; text-align: right; margin-top: -20px; background-blend-mode: screen; opacity: 0.9">
        Timeout : <span id="countdown"></span></span>
    </div> -->

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
            <div class="col s12 m12 l12">
                <div id="box" class="col s12 m12 l12">
                    <div class="col s12 m12 l12 center-align" style="margin-bottom: 20px; border-bottom: 2px solid orange; padding-bottom: 10px">                            
                        <img src="../library_system/admin/upload/<?php echo $f['book_image'] ?>" alt="" width="300" height="300" style="box-shadow: inset 0 4px 20px #000, inset 0 2px 10px #000; border: 20px groove dodgerblue; border-radius: 10%;">
                    </div>
                    <h3 class="blue-text"><b><?php echo $f['book_title'] ; ?></b></h3>
                    <div class="container">
                    <p style="text-align: justify; text-indent: 40px">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deleniti rerum modi ipsa incidunt fugit earum laudantium autem molestiae nostrum distinctio suscipit temporibus id tempora omnis, enim facere iusto aut maiores?</p>
                    </div>
                    <br>
                    <div class="col s12 m12 l12"><b>Author</b>: <span class="orange-text"><?php echo $f['author'] ; ?></span></div>
                    <div class="col s12 m12 l12"><b>Subject</b>: <span class="orange-text"><?php echo $f['classname'] ; ?></span></div>
                    <div class="col s12 m12 l12"><b>Publisher Name</b>: <span class="orange-text"><?php echo $f['publisher_name'] ; ?></span></div>
                    <div class="col s12 m12 l12"><b>Book Published</b>: <span class="orange-text"><?php echo $f['book_pub'] ; ?></span></div>
                    <div class="col s12 m12 l12"><b>ISBN</b>: <span class="orange-text"><?php echo $f['isbn'] ; ?></span></div>
                    <div class="col s12 m12 l12"><b>Copies</b>: <span class="orange-text"><?php echo $f['book_copies'] ; ?></span></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m12 l12 center-align">

                <form action="" method="post">
                    <!-- <div class="input-field col s12 m6 l6 center-align">
                        <a href="./download_book.php?id=<?php echo $_GET['id']; ?>" id="btn_download" name="btn_download" class="btn pulse" style="border-left: 10px solid white; border-right: 10px solid white;border-radius: 10px;width: 250px; height: 80px; font-size: 24px; padding: 20px 20px 20px 20px">DOWNLOAD</a>
                    </div> -->
                    <div class="input-field col s12 m6 l6 center-align">
                        <a href="./view_book.php?id=<?php echo $_GET['id']; ?>" id="btn_download" name="btn_download" class="btn pulse" style="border-left: 10px solid white; border-right: 10px solid white;border-radius: 10px;width: 250px; height: 80px; font-size: 24px; padding: 20px 20px 20px 20px">VIEW</a>
                    </div>
                    <div class="input-field col s12 m6 l6 center-align">
                        <a href="./reserved.php?id=<?php echo $_GET['id']; ?>" id="btn_reserved" name="btn_reserved" class="btn" style="border-left: 10px solid white; border-right: 10px solid white;border-radius: 10px;width: 250px; height: 80px; font-size: 24px; padding: 20px 20px 20px 20px">RESERVED</a>
                    </div>
                    <div class="input-field"></div>
                </form>

            </div>
        </div>
    </div>

    <div class="col s12 m6 l6 success">
    <div class="w3-container green lighten-4 pulse" style="box-shadow: inset 0 2px 10px #222, inset 0 4px 20px green; border-radius: 10px;">
    <span id="close" class="btn red" style="float: right;">&times;</span>
    <h3>Note!</h3>
    <p>You only have 1 day to get the book before the expiration of your reservation. Thank You.</p>
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

            $('#close').on('click', function(){
                $('.success').removeClass('show');
                $('.success').addClass('hide').fadeIn('slow');
            });

            <?php if($s01_count == 0){ ?>
                $('.success').removeClass('show');
                $('.success').addClass('hide');
            <?php }else{ ?>
                $('.success').addClass('show');
                $('.success').removeClass('hide');
            <?php } ?>

        });

        function myFunction(id) {
            document.getElementById(id).classList.toggle("w3-show");
        }



    </script>
</body>
</html>