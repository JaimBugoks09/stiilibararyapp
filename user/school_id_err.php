<?php 
$status = $_GET['status'];

; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/W3CSS/w3.min.css">
    <title>Document</title>
</head>
<body>

    <?php if($status == 'not_valid'){ ; ?>
        <div style="display: block;" id="id01" class="w3-modal w3-animate-zoom w3-center">
            <div class="w3-modal-content w3-card-8">
                <header class="w3-container w3-red"> 
                    <h2>Failed!</h2>
                </header>
                <div class="w3-container">
                    <br><br><br>
                    <h3>School ID is not valid <br> ID must be less than or equal to 6 digits !!!</h3>
                    <br><br><br>
                </div>
                <footer class="w3-container w3-red">
                    <br>
                    <a href="./login.php" class="w3-btn w3-white">OK</a>
                    <br><br>
                </footer>
            </div>
        </div>
    <?php }elseif($status == 'not_found'){  ; ?>
        <div style="display: block;" id="id01" class="w3-modal w3-animate-zoom w3-center">
            <div class="w3-modal-content w3-card-8">
                <header class="w3-container w3-red"> 
                    <h2>Failed!</h2>
                </header>
                <div class="w3-container">
                    <br><br><br>
                    <h3>School ID is not matched!!! <br> Please Try Again.</h3>
                    <br><br><br>
                </div>
                <footer class="w3-container w3-red">
                    <br>
                    <a href="./login.php" class="w3-btn w3-white">OK</a>
                    <br><br>
                </footer>
            </div>
        </div>
    <?php } ; ?>

    
</body>
</html>