<?php 
$id = $_GET['id'];
include_once "./connections/travelclass.php";
$con = $lib->openConnection();

session_start();
        
$user_id = $_SESSION['user_id'];



; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage | Page</title>
    
    <link rel="stylesheet" href="./assets/css/W3CSS//w3.css">
    <link rel="stylesheet" href="./assets/css/materialize.min.css">

</head>
<body>

    <?php 
    
        $stmt01 = $con->prepare("SELECT * FROM user WHERE user_id = ?");
        $stmt01->execute([$user_id]);
        $val = $stmt01->fetch();

        $stmt011 = $con->prepare("SELECT * FROM book WHERE book_id = ?");
        $stmt011->execute([$id]);


        if($stmt011->rowCount() > 0){

            $f = $stmt011->fetch();


            if($f['remarks'] == 'Available'){

                if($f['book_copies'] > 0){

                    $check_user = $con->prepare("SELECT * FROM reserve_book WHERE book_id = ? AND user_id = ?");
                    $check_user->execute([$id, $user_id]);

                    if($check_user->rowCount() > 0){

                        ?>
                        <script>
                            window.location.href = "./failed.php?status=already_reserved&b_id=<?php echo $id; ?>";
                        </script>
                        <?php

                    }else{

                        $message = $val['firstname']." ".$val['middlename']." ".$val['lastname']." reserve a book entitled ".$f['book_title'];
                        $status = "";
                
                        $query = $con->prepare("INSERT INTO notification(`user_id`,`message`,`book_id`,`status`) VALUES(?,?,?,?)");
                        $query->execute([$user_id, $message, $id, $status]);
    
                        $query01 = $con->prepare("INSERT INTO reserve_book(`user_id`,`book_id`,`status`) VALUES(?,?,?)");
                        $query01->execute([$user_id, $id, $status]);
    
                        ?>
                        <script>
                            window.location.href = "./success.php?b_id=<?php echo $id;  ?>";
                        </script>
                        <?php

                    }

                }else{
                    ?>
                    <script>
                        window.location.href = "./failed.php?status=out_of_copy&b_id=<?php echo $id; ?>";
                    </script>
                    <?php
                }
            }
            
            if($f['remarks'] == 'Not Available'){
                ?>
                <script>
                    window.location.href = "./failed.php?status=not_available&b_id=<?php echo $id; ?>";
                </script>
                <?php
            }
        }else{
            ?>
            <script>
                window.location.href = "./home.php";
            </script>
            <?php
        }
    
    ; ?>


    <script src="./assets/js/jquery-1.7.2.min.js"></script>
    <script src="./assets/js/materialize.min.js"></script>
</body>
</html>