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
                        <p style="text-indent: 20px;">
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quidem beatae sunt cumque eum debitis quae dolores sed maxime animi quo, ea voluptas a aliquam doloribus, explicabo expedita unde asperiores soluta pariatur quam ducimus veritatis eveniet voluptate. Exercitationem cumque corporis nemo dignissimos magnam, quas, voluptatum molestiae possimus corrupti laborum debitis eligendi, odit pariatur voluptate! Provident quam ratione, facilis eum deleniti rem, autem voluptate neque quae itaque minima ut atque! Nisi pariatur provident cupiditate recusandae odit ipsam, ullam, sequi tenetur, quia molestiae earum quibusdam qui asperiores voluptas repellat mollitia nihil fuga dolore aut alias autem quis a commodi? Amet quo itaque maxime.
                            </p>
                            
                            <p style="text-indent: 20px;">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Modi sit enim, perspiciatis a odio quod nesciunt quos ducimus totam eligendi fugiat velit nihil quo fugit, minus et incidunt facere autem facilis amet doloremque! Cumque excepturi eos iure deserunt perferendis, quos ratione temporibus natus fugiat maxime laudantium sunt odit voluptates consectetur.
                                <div style="text-indent: 20px;">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias sunt ipsam dicta ex aut dolorem! Ab ipsam vel ad modi ex hic excepturi voluptatem autem obcaecati voluptates similique quia nisi adipisci cum aliquid vero, recusandae dolor alias omnis. Quae velit sunt tempora obcaecati cupiditate expedita ullam nisi, ipsam laborum consequatur.
                                </div>
                                <div style="text-indent: 20px;">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias sunt ipsam dicta ex aut dolorem! Ab ipsam vel ad modi ex hic excepturi voluptatem autem obcaecati voluptates similique quia nisi adipisci cum aliquid vero, recusandae dolor alias omnis. Quae velit sunt tempora obcaecati cupiditate expedita ullam nisi, ipsam laborum consequatur.
                                </div>
                            </p>
                            
                            <br><br><br><br>
                            <hr>
                            <div id="footer" class="center-align">Copyright &copy; <?php echo $val['copyright_year'] ; ?></div>
                        </div>

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