<div class="navbar">
    <a class="icon" href="../index.php"><img src="../assets/logo.png" alt="site logo" height="50px"></a>

    
    <?php if ($login_status == 0) echo "<a href ='login.php'>Log-in</a>"; ?>
    <?php if ($login_status == 1) echo "<a href ='../index.php?action=logout'>Log-out</a>"; ?>
    <?php if( !empty($_SESSION['cart']) ): ?>
        <a href ='cart.php'>My Cart(<?php echo count($_SESSION['cart'])?>)</a>
    <?php endif; ?>
    <?php if ($login_status == 1) echo "<a href ='profile.php'>Profile</a>"; ?>
    <?php if( isset($_SESSION['id']) ): ?>
        <?php if ($_SESSION['id'] == 1) echo "<a href ='panel.php'>Admin Panel</a>"; ?>
    <?php endif; ?>
    
</div>