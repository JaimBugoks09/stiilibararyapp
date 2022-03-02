<?php 
session_start();
include_once "./connections/travelclass.php";
$con = $lib->openConnection();
$user_id = $_SESSION['user_id'];

$stmt = $con->prepare("SELECT * FROM user AS u
INNER JOIN course AS c
ON c.course_id = u.course WHERE u.user_id = ?");
$stmt->execute([$user_id]);
$f = $stmt->fetch();

$stmt1 = $con->prepare("SELECT * FROM user_log 
WHERE user_id = ?");
$stmt1->execute([$user_id]);
$count = $stmt1->rowCount();

$rb_query = $con->prepare("SELECT * FROM reserve_book AS rb
INNER JOIN book AS b
ON b.book_id = rb.book_id
WHERE user_id = ? AND rb.status = ?");
$rb_query->execute([$user_id, 'RESERVED']);
$rb_check = $rb_query->rowCount();

$bb_query = $con->prepare("SELECT * FROM borrow_book AS bb
INNER JOIN book AS b
ON b.book_id = bb.book_id
WHERE user_id = ? AND borrowed_status = ?");
$bb_query->execute([$user_id, 'borrowed']);
$bb_check = $bb_query->rowCount();

$rb2_query = $con->prepare("SELECT * FROM return_book AS bb
INNER JOIN book AS b
ON b.book_id = bb.book_id
WHERE user_id = ?");
$rb2_query->execute([$user_id]);
$rb2_check = $rb2_query->rowCount();

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

    </style>
</head>
<body>


    <?php include('./link.php') ; ?>

    <div id="cat" class="col s12 m9 l9">
        <div class="row">

            <div class="col s12 m12 l12 center-align">

                <div id="result">
                </div>

                <div id="box" class="container left-align">
                    <h5 class="yellow-text" style="box-shadow: 0 2px 10px #222; padding: 5px 10px">Personal Information</h5>
                    <div class="col s12 m12 l12">
                        <div class="col s4 m4 l4 left-align">Name: </div>
                        <div style="font-size: 10px" class="col s8 m8 l8 right-align"><span class="orange-text" style="padding: 5px 10px"><?php echo $f['firstname']." ".$f['middlename']." ".$f['lastname'] ; ?></span></div>
                    </div>
                    <div class="col s12 m12 l12">
                        <div class="col s4 m4 l4 left-align">Address: </div>
                        <div style="font-size: 10px" class="col s8 m8 l8 right-align"><span class="orange-text" style="padding: 5px 10px"><?php echo $f['address'] ; ?></span></div>
                    </div>
                    <div class="col s12 m12 l12">
                        <div class="col s4 m4 l4 left-align">Gender: </div>
                        <div style="font-size: 10px" class="col s8 m8 l8 right-align"><span class="orange-text" style="padding: 5px 10px"><?php echo $f['gender'] ; ?></span></div>
                    </div>
                    <div class="col s12 m12 l12">
                        <div class="col s4 m4 l4 left-align">Course/Strand: </div>
                        <div style="font-size: 10px" class="col s8 m8 l8 right-align"><span class="orange-text" style="padding: 5px 10px"><?php echo $f['course']." ".$f['section'] ; ?></span></div>
                    </div>
                    <div class="col s12 m12 l12">
                        <div class="col s4 m4 l4 left-align">Contact: </div>
                        <div style="font-size: 10px" class="col s8 m8 l8 right-align">
                            <span class="orange-text" style="padding: 5px 10px">
                            <?php if($f['contact'] ){ echo $f['contact'] ; }else{ echo "None"; }; ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s12 m12 l12 center-align">
                <div id="box" class="container left-align">
                    <h5 class="yellow-text" style="box-shadow: 0 2px 10px #222; padding: 5px 10px">Reserved Books</h5>
                    <table>
                        <tr style="padding: 5px 10px; font-size: 10px">
                            <th class="grey">Book Title</th>
                            <th class="grey">Date</th>
                        </tr>
                        <?php 
                            if($rb_check > 0){
                                while($rb = $rb_query->fetch())
                                {
                                    ?>
                                    <tr style="font-size: 10px">
                                        <td><?php echo $rb['book_title'] ; ?></td>
                                        <td><?php echo $rb['added_at'] ; ?></td>
                                    </tr>
                                    <?php
                                }
                            }else{
                                ?>
                                    <tr style="font-size: 10px">
                                        <td><?php echo 'None'; ?></td>
                                        <td><?php echo 'None'; ?></td>
                                    </tr>
                                <?php
                            }
                        ; ?>
                    </table>

                </div>
            </div>

            <div class="col s12 m12 l12 center-align">
                <div id="box" class="container left-align">
                    <h5 class="yellow-text" style="box-shadow: 0 2px 10px #222; padding: 5px 10px">Borrowed Books</h5>
                    <table>
                        <tr style="padding: 5px 10px; font-size: 10px">
                            <th class="grey">Book Title</th>
                            <th class="grey">Date Borrowed</th>
                            <th class="grey">Date Returned</th>
                            <th class="grey">Status</th>
                            <th class="grey">Penalty</th>
                        </tr>
                        <?php 
                            if($bb_check > 0){
                                while($bb = $bb_query->fetch())
                                {
                                    ?>
                                    <tr style="font-size: 10px;">
                                        <td><?php echo $bb['book_title'] ; ?></td>
                                        <td><?php echo $bb['date_borrowed'] ; ?></td>
                                        <td><?php echo $bb['date_returned'] ; ?></td>
                                        <td><?php echo $bb['borrowed_status'] ; ?></td>
                                        <td><?php echo $bb['book_penalty'] ; ?></td>
                                    </tr>
                                    <?php
                                }
                            }else{
                                
                                ?>
                                    <tr style="font-size: 10px;">
                                        <td><?php echo 'None'; ?></td>
                                        <td><?php echo 'None'; ?></td>
                                        <td><?php echo 'None'; ?></td>
                                        <td><?php echo 'None'; ?></td>
                                        <td><?php echo 'None'; ?></td>
                                    </tr>
                                <?php
                            }
                        ; ?>
                    </table>

                </div>
            </div>

            <div class="col s12 m12 l12 center-align">
                <div id="box" class="container left-align">
                    <h5 class="yellow-text" style="box-shadow: 0 2px 10px #222; padding: 5px 10px">Returned Books</h5>
                    <table>
                        <tr style="padding: 5px 10px; font-size: 10px">
                            <th class="grey">Book Title</th>
                            <th class="grey">Date Borrowed</th>
                            <th class="grey">Date Returned</th>
                            <th class="grey">Due Date</th>
                            <th class="grey">Penalty</th>
                        </tr>
                        <?php 
                            if($rb2_check > 0){
                                while($rb2 = $rb2_query->fetch())
                                {
                                    ?>
                                    <tr style="font-size: 10px;">
                                        <td><?php echo $rb2['book_title'] ; ?></td>
                                        <td><?php echo $rb2['date_borrowed'] ; ?></td>
                                        <td><?php echo $rb2['date_returned'] ; ?></td>
                                        <td><?php echo $rb2['due_date'] ; ?></td>
                                        <td><?php echo $rb2['book_penalty'] ; ?></td>
                                    </tr>
                                    <?php
                                }
                            }else{
                                
                                ?>
                                    <tr style="font-size: 10px;">
                                        <td><?php echo 'None'; ?></td>
                                        <td><?php echo 'None'; ?></td>
                                        <td><?php echo 'None'; ?></td>
                                        <td><?php echo 'None'; ?></td>
                                    </tr>
                                <?php
                            }
                        ; ?>
                    </table>

                </div>
            </div>

            <div class="col s12 m12 l12 center-align">

                <div id="box" class="container left-align">
                    <h5 class="yellow-text" style="box-shadow: 0 2px 10px #222; padding: 5px 10px">Logs</h5>
                    <div class="">
                        <table>
                            <tr>Login Time</tr>
                        </table>
                        <?php 

                        while($row = $stmt1->fetch())
                        {
                            ?>
                                    
                                <tr>
                                    <p style="font-size: 14px;"><span class="white-text orange" style="padding: 5px 10px; border-radius: 10px"><code><?php echo $row['date_log'] ; ?></code></span></p>

                                </tr>                

                            <?php
                        }
                        ; ?>

                    </div>
                </div>

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