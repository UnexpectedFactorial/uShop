<?php
    $page_title = "Error!";
    require_once("../model/connection.php");

    if(isset($_GET['e'])){
        $e = $_GET['e'];
    }
?>
    <?php include("../elements/header.php");?>
</head>

<body>
    <?php include("../elements/navbar.php");?>

    <script>
         setTimeout(function(){
            window.location.href = 'home.php';
         }, 5000);
      </script>

    <div class = "basic-wrapper">
    <?php if(isset($_GET['e'])) : ?>
        <?php if ($e == 'noaccount') echo '<h2>No Account Detected! Please log in!</h2>'; ?>
        <?php if ($e == 'autherror') echo '<h2>Nonauthorized Access Detected!</h2>'; ?>

    <?php else:?>
        <h2>Unknown Error Detected</h2>
    <?php endif; ?>
        
        <p>Site will now redirect you to the home page after 5 seconds.</p>
    </div>


</body>
