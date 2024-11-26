<?php
    $page_title = "Admin Profile";
    require_once("../model/connection.php");
    include("../elements/header.php");
    

    if($_SESSION['id'] !== 1){
        header("Location: error.php?e=autherror");
    }

    if(isset($_GET['success'])){
        $success = $_GET['success'];
    }

    
    
?>
    
</head>

<body>
    <?php include("../elements/navbar.php");?>
    <?php if(isset($_GET['success'])) : ?>
        <?php if ($success == 'product') echo '<div class="login-status-ok"><b>Item successfully added to the store!</b></div>'; ?>
        <?php if ($success == 'category') echo '<div class="login-status-ok"><b>Category successfully added to the store!</b></div>'; ?>
        <?php if ($success == 'deleteprod') echo '<div class="login-status-ok"><b>Product successfully deleted!</b></div>'; ?>
        <?php if ($success == 'deletecat') echo '<div class="login-status-ok"><b>Category successfully deleted!</b></div>'; ?>
        <?php if ($success == 'settings') echo '<div class="login-status-ok"><b>Site settings successfully changed!</b></div>'; ?>
        <?php if ($success == 'editprod') echo '<div class="login-status-ok"><b>Product details successfully changed!</b></div>'; ?>
    <?php endif; ?>
    <main>
        <div class="admin-panel">
            <a href="../pages/additem.php">
                <div>
                    <h2>Add a store item</h2>
                </div>
            </a>
            <a href="../pages/addcategory.php">                
                <div>
                    <h2>Add a store category</h2>
                </div>
            </a>
            <a href="../pages/tables.php">                
                <div>
                    <h2>See all tables</h2>
                </div>
            </a>
            <a href="../pages/settings.php">                
                <div>
                    <h2>Site Settings</h2>
                </div>
            </a>
        </div>
        
    </main>


    <?php include("../elements/footer.php");?>
</body>
