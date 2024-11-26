<?php
    $page_title = "Registration Success";
    require_once("../model/connection.php");
?>
    <?php include("../elements/header.php");?>
</head>

<body>
    <?php include("../elements/navbar.php");?>

    <script>
         setTimeout(function(){
            window.location.href = 'login.php';
         }, 5000);
      </script>

    <div class = "basic-wrapper">
        <h2>Registration Success</h2>
        <p>Site will now redirect you to the login page after 5 seconds.</p>
    </div>


</body>
