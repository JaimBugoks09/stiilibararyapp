<?php 
include_once "./connections/travelclass.php";
$con = $lib->openConnection();

$id = $_GET['id'];


$stmt = $con->prepare("SELECT * FROM book WHERE book_id = ?");
$stmt->execute([$id]);
$count = $stmt->rowCount();


; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page | Book</title>
    <link rel="stylesheet" href="./assets/css/materialize.min.css">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col s12 m12 l12">
                <header>
                    <?php 
                    if($count > 0){
                        while($val = $stmt->fetch()){
                        ?>
                        <center>
                            <h4><?php echo $val['book_title'] ; ?></h4>
                        </center>
                        <hr>
                        <div class="col s12 m12 l12" style="text-align: justify;">

                            <h5>Table Of Contents</h5>
                            <br><br><br><br>
                        </div>

                        <script>
                            window.print();
                        </script>
                        <?php
                        }
                    
                    }
                    
                    ; ?>
                </header>
            </div>
        </div>
    </div>
    <script src="./assets/js/jquery-1.7.2.min.js"></script>
    <script src="./assets/js/materialize.min.js"></script>
</body>
</html>