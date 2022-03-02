<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {           
            background-color: #222;
            width: 100%;
            height: 100vh;
        }
        
        .loader_bg {
            position: fixed;
            z-index: 999999;
            width: 100%;
            height: 100%;
        }
        
        .loader {
            border: 0 solid transparent;
            position: absolute;
            width: 150px;
            height: 150px;
            top: calc(50vh - 90px);
            left: calc(50vw - 90px);
            border-radius: 50%;
        }
        
        .loader:before{
            content: '';
            border: 1em solid dodgerblue;
            border-radius: 50%;
            width: inherit;
            height: inherit;
            position: absolute;
            top: 0;
            left: 0;
            animation: loader 2s linear infinite;
            opacity: 0;
        }
        .loader:after {
            content: '';
            border: 1em solid white;
            border-radius: 50%;
            width: inherit;
            height: inherit;
            position: absolute;
            top: 0;
            left: 0;
            animation: loader 2s linear infinite;
            opacity: 0;
        }
        
        .loader:before {
            animation-delay: .5s;
        }
        
        @keyframes loader {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            50% {
                opacity: 1;
            }
            100% {
                transform: scale(1);
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <img src="./assets/img/stii_logo.jpg" width="100" height="100" 
    style="border-radius: 50%; position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);z-index:999">
    <div class="loader_bg"><span class="loader"></span></div>

    <script>
        setInterval(function(){
            location.href = "./login.php";
        }, 5000)
    </script>

</body>

</html>