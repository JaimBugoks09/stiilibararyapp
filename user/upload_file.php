<?php
include_once "./connections/travelclass.php";
$con = $lib->openConnection();
$target_dir = "./uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

$get_id = $_GET['id'];
// Check if image file is a actual image or fake image
if(isset($_POST["btn_msg"])) {

    $msg = $_POST['msg'];

    if(!empty($msg)){

        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

        if($check !== false) {
            // echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            // echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists."; 
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $file = basename($_FILES["fileToUpload"]["name"]);        
                $stmt = $con->prepare("INSERT INTO user_messages(`u_id`,`message`,`file`) VALUES(?,?,?)");
                $check = $stmt->execute([$get_id, $msg, $file]);
        
                if($check){
                    ?>
                    <script>
                        document.getElementById("create").style.display = "none";
                        document.getElementById("success").style.display = "block";
                    </script>
                    <?php
                }else{
        
                    ?>
                    <script>
                        window.location.href = "./failed.php?b_id=<?php echo $get_id; ?>&status=failed_msg";
                    </script>
                    <?php
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }


    }else{
        ?>
        <script>
            window.location.href = "./failed.php?b_id=<?php echo $get_id; ?>&status=failed_msg";
        </script>
        <?php
    }

}
?> 
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
<div id="id01" style="display: block;" class="w3-modal w3-animate-top w3-center">
            <div class="w3-modal-content w3-card-8" id="success" style="display: block;">
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
</body>
</html>