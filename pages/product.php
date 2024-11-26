<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    else{
        header("Location: error.php?e=invalidproduct");
    }

    

    require_once("../model/connection.php");
    $query = 'SELECT prodName FROM products WHERE prodID = ?';
    $statement = $db->prepare($query);
    $statement->execute([$id]);
    $name = $statement->fetchColumn();
    $statement->closeCursor();

    $q = 'SELECT * FROM products WHERE prodID = ?';
    $statement2 = $db->prepare($q);
    $statement2->execute([$id]);
    $products = $statement2->fetch();
    $statement2->closeCursor();

    $q2 = 'SELECT * FROM categories WHERE catID = ?';
    $statement3 = $db->prepare($q2);
    $statement3->execute([$products['catID']]);
    $category = $statement3->fetch();
    $statement3->closeCursor();

    $page_title = $name;
?>
    <?php include("../elements/header.php");?>
    <?php if(!isset($_SESSION['id'])){header("Location: error.php?e=noaccount");}?>
    
</head>

<body>
    <?php include("../elements/navbar.php");?>

    <?php if ($login_status == 1) echo '<div class="login-status-ok"><b>Thank you for logging in.</b></div>'; ?>
    <?php if ($login_status == 0) echo '<div class="login-status"><b>Please log in for the full experience. You will not be able to see products or view profiles.</b></div>'; ?>

    <main>
            <h1 class = "item_title"><?php echo $products['prodName']?></h1>
            <div class="item_page">
                
                <div>
                    <img src="../assets/images/<?php echo $products['prodPhoto']; ?>" class="item_page_image">
                </div>
                <div class="item_page_info">

                        <p>Category: <?php echo $category['catName']?></p>
                        <p>Price: <?php echo "$" . number_format($products['prodPrice'],2)?></p>
                        <p><?php echo $products['prodDes']?></p>
                        <form action="../index.php" method="POST">
                            <input type="hidden" name="action" value="add-to-cart">
                            <input type="hidden" name="productID" value="<?php echo $products['prodID']?>">
                            <input type="hidden" name="price" value="<?php echo $products['prodPrice']?>">
                            <label>Quantity:</label>
                            <select name = "quantity">  
                                <?php for($i = 1; $i <= 10; $i++) : ?>
                                    <option value="<?php echo $i; ?>">
                                        <?php echo $i; ?>
                                    </option>
                                <?php endfor; ?>
                            </select><br><br>
                            <input type="submit" value="Add to Cart" class="buy-button">
                        </form>
                        <form action="../index.php" method="POST">
                            <input type="hidden" name="action" value="buy">
                            <input type="hidden" name="price" value="<?php echo $products['prodPrice']?>">
                            <input type="hidden" name="userID" value="<?php echo $_SESSION['id']?>">
                            <input type="submit" value="One Click Buy" class="one-click-buy">
                        </form>

                </div>

            </div>

 
    </main>

    <?php include("../elements/footer.php");?>
</body>
