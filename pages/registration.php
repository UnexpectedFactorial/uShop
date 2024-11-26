<?php
    $page_title = "Registration";
    require_once("../model/connection.php");
    if(isset($_GET['error'])){
        $error = $_GET['error'];
    }
?>
    <?php include("../elements/header.php");?>
</head>

<body>
    <?php include("../elements/navbar.php");?>

    <?php if(isset($_GET['error'])) : ?>
        <?php if ($error == 'blank') echo '<div class="login-status"><b>Blank field Detected!</b></div>'; ?>
        <?php if ($error == 'duplicate') echo '<div class="login-status"><b>Username has already been taken!</b></div>'; ?>
    <?php endif; ?>

    <div class = "basic-wrapper">
        <h2>Registration</h2>
        <form action ="../index.php" method = "post">
            <input type="hidden" name="action" value="process_reg">
            <input type="text" name="uName" placeholder="Username" class="item-textbox" required><br>
            <input type="text" name="fName" placeholder="First Name" class="item-textbox" required><br>
            <input type="text" name="lName" placeholder="Last Name" class="item-textbox" required><br>
            <input type="text" name="password"placeholder="Password" class="item-textbox" required><br>
            <input type="text" name="address"placeholder="Address" class="item-textbox" required><br>
            <center><input type="submit" value="Register" class = "submit-button" style="margin-bottom:15px;"><br></center>
        </form>
    </div>


</body>
