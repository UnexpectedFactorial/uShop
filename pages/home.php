<?php
    $page_title = "Home Page";
    require_once("../model/connection.php");
    $query = 'SELECT * FROM products';
    $statement = $db->prepare($query);
    $statement->execute();
    $products = $statement->fetchAll();
    $statement->closeCursor();

    $q = 'SELECT * FROM categories';
    $statement2 = $db->prepare($q);
    $statement2->execute();
    $categories = $statement2->fetchAll();
    $statement2->closeCursor();


?>
    <?php include("../elements/header.php");?>
</head>

<body>
    <?php include("../elements/navbar.php");?>
    <?php if ($login_status == 1) echo '<div class="login-status-ok"><b>Thank you for logging in. Full Access Granted!</b></div>'; ?>
    <?php if ($login_status == 0) echo '<div class="login-status"><b>Please log in for the full experience. You will not be able to see products or view profiles.</b></div>'; ?>
    <main>
        <div class ="product_wrapper">
            <div>
                <h1> All Products</h1> 
                    <div class="item_list">       
                        <?php foreach ($products as $product) : ?>
                                <a href="product.php?id=<?php echo $product['prodID']; ?>" style = "text-decoration:none; color:black;">
                                    <div class="item_wrapper">
                                            <img src="../assets/images/<?php echo $product['prodPhoto']; ?>"style="width:150px;height:150px;"/>
                                            <h2><?php echo $product['prodName']; ?></h2>
                                            <p><?php echo "$". number_format($product['prodPrice'],2);?></p>

                                    </div>
                                </a>
                        <?php endforeach; ?>
                </div>
            </div>
            <div class = "category_list">
                <h1 style="text-align:center;">Categories</h1>
                
                    
                        <a href="../index.php">All Categories
                    
                    <?php foreach ($categories as $category) : ?>
                        
                            <a href="category.php?id=<?php echo $category['catID']; ?>"><?php echo $category['catName']; ?></a>
                        
                    <?php endforeach; ?>
                
            </div>
        </div>
    </main>

    <?php include("../elements/footer.php");?>
</body>
