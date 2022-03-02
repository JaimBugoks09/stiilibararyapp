<?php 
include_once "./connections/travelclass.php";
$con = $lib->openConnection();

$get_id = $_GET['id'];

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


    </style>
</head>
<body>


    <?php include('./link.php') ; ?>

        <div id="cat" class="col s12 m9 l9">
                <div class="row">

                    <div class="col s12 m12 l12 center-align">

                        <div id="result"></div>

                        <div id="book" class="w3-container city">
                            <?php 
                                $stmt = $con->prepare("SELECT * FROM book WHERE shelter_id = $get_id");
                                $stmt->execute();
                                $count = $stmt->rowCount();

                                if($count > 0)
                                {
                                    while($row = $stmt->fetch())
                                    {
                                        ?>
                                            <div id="cont" class="box col s12 m12 l12 left-align" style="box-shadow: 0 2px 10px #222; border-radius: 10px;padding:20px 10px;margin: 10px">

                                                <div class="col s7 m8 l8 left-align">
                                                    <a href="./action.php?id=<?php echo $row['book_id'] ?>">
                                                        <div class="col s5 m5 l5">
                                                            <img src="../library_system/admin/upload/<?php echo $row['book_image'] ?>" style="border:2px solid dodgerblue;width:60px; height: 60px">
                                                        </div>
                                                        <div class="col s7 m7 l7 left-align">  
                                                            <span style="font-size: 12px; color: #fff"><p><?php echo " ".$row['book_title'] ; ?></p></span>
                                                        </div>
                                                    </a>
                                                    <br><br>
                                                    <div class="col s12 m12 l12 left-align">
                                                        <b><span style="font-size: 12px;"><?php echo "Book | ".$row['book_pub'] ; ?></span></b>
                                                    </div>
                                                </div>
                                                <div class="col s5 m4 l4 right-align">
                                                    <div class="col s12 m12 l12">
                                                    <?php 

                                                        if($row['remarks'] == "Available"){
                                                            ?>
                                                            <span id="remarks" style="color: lime; font-weight: 800"><?php echo $row['remarks'] ; ?></span>
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <span id="remarks" style="color: red; font-weight: 800"><?php echo $row['remarks'] ; ?></span>
                                                            <?php
                                                        }

                                                    ; ?>
                                                    </div>
                                                    <br><br><br><br>
                                                    <div class="col s12 m12 l12">
                                                        <span class="orange white-text" 
                                                            style="font-size: 12px; padding: 10px 10px">Copies: <?php echo $row['book_copies'] ; ?></span>
                                                    </div>
                                                </div>
                                                
                                            </div>

                                        <?php
                                    }
                                }else{
                                    echo "<div class='section'>No results found!</div>";
                                }
                            ; ?>
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
                    url: "fetch_shelter.php?id=<?php echo $get_id; ?>",
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