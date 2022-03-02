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
    <link rel="stylesheet" href="./assets/css/W3CSS/w3.min.css">
    <title>Document</title>
</head>
<body>

        <form action="upload_file.php?id=<?php echo $get_id; ?>" method="post" enctype="multipart/form-data" id="id01" style="display: block;" class="w3-modal w3-animate-zoom w3-center">
            <div id="create" class="w3-modal-content w3-card-8">
                <header class="w3-container w3-indigo"> 
                    <!-- <div class="w3-right"><a href="./account.php" class="w3-btn w3-red" style="margin-right: -15px;">&times;</a></div> -->
                    <h2>Create Message</h2>
                </header>
                <div class="w3-container">
                    <br><br><br>
                    Select image to upload:
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <br><br><br>
                    <textarea name="msg" style="padding: 5px 10px; border-radius: 4px" placeholder="Create message here ..."></textarea>
                    <br><br><br>
                </div>
                <footer class="w3-container w3-indigo">
                    <br>
                    <a href="./account.php" class="w3-btn w3-red" style="width: 150px;">CANCEL</a>
                    <button name="btn_msg" class="w3-btn w3-white" style="width: 150px;">SEND</button>
                    <br><br>
                </footer>
            </div>

        </form>

        <div id="id01" style="display: block;" class="w3-modal w3-animate-top w3-center">
            <div class="w3-modal-content w3-card-8" id="success" style="display: none;">
                <header class="w3-container w3-green"> 
                    <!-- <div class="w3-right"><a href="./account.php" class="w3-btn w3-red" style="margin-right: -15px;">&times;</a></div> -->
                    <h2>Success</h2>
                </header>
                <div class="w3-container">
                    <br><br><br>
                        <h3>Your message is successfully sent.</h3>
                    <br><br><br>
                </div>
                <footer class="w3-container w3-green">
                    <br>
                    <a href="./account.php" class="w3-btn w3-white" style="width: 150px;">OK</a>
                    <br><br>
                </footer>
            </div>
        </div>

        <?php 
            // if(isset($_POST['btn_msg'])){

            // }
        
        
        ; ?>


    
</body>
</html>