<?php
    $page_title = "Log In";
    require_once("../model/connection.php");

    if(isset($_GET['error'])){
        $success = $_GET['error'];
    }
?>
    <?php include("../elements/header.php");?>

    
</head>

<body>
    <?php include("../elements/navbar.php");?>

    <?php if(isset($_GET['error'])) : ?>
        <?php if ($success == 'wrong') echo '<div class="login-status"><b>Incorrect Login Info Provided</b></div>'; ?>
    <?php endif; ?>

    <div class="login">
        <h2>Log In</h2>
        <form action ="../index.php" method = "post">
            <input type="hidden" name="action" value="login">
            <input type="text" name="uName" placeholder="Username" class="item-textbox" required><br>
            <input type="password" name="password" placeholder="Password" class="item-textbox" required><br>
            <center>
                <input type="submit" value="Log In" class = "submit-button"><br>
            
                <a href="registration.php">No account? Click me.</a>
            </center>
        </form>
    </div>


</body>
