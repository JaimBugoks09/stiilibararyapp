<header class="blue left-align" style="padding: 20px 20px; color:white; font-size: 20px; font-weight: 800;border-bottom:10px solid #f2f2f2">
    <img src="./assets/img/stii_logo.jpg" width="100" height="100"> 
    <span style="margin-left: 10px;">Welcome To STII Library App</span>
    <span></span>
</header>
<div class="row">
<div id="nav" class="col s12 m12 l12 black">
<form action="" method="post" style="display: flex; justify-content: space-between; align-items: center;">
<button id="categ" name="categ" style="background: none; border: none"><h5 id="categ"><b>&times;</b></h5></button>
<ul>
    <li id="input-search" style="background: #222; padding: 0 10px; margin-right: 5px;"><input type="text" id="search_book" class="white-text" placeholder="Search ..."></li>
    <li><a href="./home.php" class="btn blue"><i class="fa fa-home"></i> </a></li>
    <li><button name="btn_notifs" id="btn_reserved" class="btn waves-ripple"> <i class="fa fa-bell"></i> </button></li>
    <li><button name="btn_reserved" id="btn_reserved" class="btn waves-ripple"><i class="fa fa-book"></i> </button></li>
    <li><button name="btn_logout" id="btn_reserved" class="btn waves-ripple">LOGOUT</button></li>
</ul>
</form>
</div>
</div>

<?php 

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
        window.location.href = "./home.php";
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
