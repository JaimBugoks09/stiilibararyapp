<?php 
include_once "./connections/travelclass.php";
$con = $lib->openConnection();

session_start();
$user_id = $_SESSION['user_id'];

$stmt = $con->prepare("SELECT rb.status, b.book_title, b.book_image, b.book_id FROM reserve_book AS rb
INNER JOIN book AS b
ON rb.book_id = b.book_id
WHERE rb.user_id = ?");
$stmt->execute([$user_id]);

$check = $stmt->rowCount();

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

        table thead tr th{
            padding: 0 10px;
            text-align: center;
        }

        table tbody tr td{
            background: #000;
            background-blend-mode: screen;
            opacity: 0.9;
            color: #fff;
            text-align: center;
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
            <div class="col s12 m12 l12">
                <table class="table striped">
                    <thead class="blue white-text">
                        <tr>
                            <th>No.</th>
                            <th></th>
                            <th>Book Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $num = 1;
                            if($check > 0){
                                while($val = $stmt->fetch()){
                        ; ?>
                        <tr style="font-size: 12px;">
                            <td><?php echo $num ; ?></td>
                            <td><img style="border-radius: 50%; border: 2px solid dodgerblue" src="../library_system/admin/upload/<?php echo $val['book_image'] ; ?>" width="30" height="30"></td>
                            <td class="left-align"><?php echo $val['book_title'] ; ?></td>
                            <td>
                                <?php if($val['status'] == "RESERVED"){ ; ?>
                                <a href="#" name="btn_open" class="btn green">✔</a>
                                <?php }else{ ; ?>
                                <button disabled class="btn grey">Pending...</button>
                                <?php } ; ?>
                            </td>
                        </tr>
                        <?php $num++; }} ; ?>
                    </tbody>
                </table>
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