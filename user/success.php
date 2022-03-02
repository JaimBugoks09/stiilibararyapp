<?php 
$get_id = $_GET['b_id'];


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

    <div style="display: block;" class="w3-modal w3-animate-zoom w3-center">
        <div class="w3-modal-content w3-card-8">
            <header class="w3-container w3-green"> 
                <h2>Success</h2>
            </header>
            <div class="w3-container">
                <br><br>
                <h3>Just wait for few moment ...</h3>
                <br><br>
            </div>
            <footer class="w3-container w3-green">
                <br>
                <a href="./action.php?id=<?php echo $get_id; ?>" class="w3-btn w3-white">OK</a>
                <br><br>
            </footer>
        </div>
    </div>
    
</body>
</html>