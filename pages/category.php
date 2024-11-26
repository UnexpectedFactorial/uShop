<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }

    $page_title = "Category Search";
    require_once("../model/connection.php");
    $query = 'SELECT * FROM products WHERE catID = ?';
    $statement = $db->prepare($query);
    $statement->execute([$id]);
    $products = $statement->fetchAll();
    $statement->closeCursor();

    $q = 'SELECT * FROM categories';
    $statement2 = $db->prepare($q);
    $statement2->execute();
    $categories = $statement2->fetchAll();
    $statement2->closeCursor();

    $q2 = 'SELECT * FROM categories WHERE catID = ?';
    $statement3 = $db->prepare($q2);
    $statement3->execute([$id]);
    $catName = $statement3->fetchAll();
    $statement3->closeCursor();


?>
    <?php include("../elements/header.php");?>
</head>

<body>
    <?php include("../elements/navbar.php");?>

    <?php if ($login_status == 1) echo '<div class="login-status-ok"><b>Thank you for logging in.</b></div>'; ?>
    <?php if ($login_status == 0) echo '<div class="login-status"><b>Please log in for the full experience. You will not be able to see products or view profiles.</b></div>'; ?>

    <main>
        <div class ="product_wrapper">
            <div>
                <?php foreach ($catName as $Name) : ?>
                    <h1> <?php echo $Name['catName']?> </h1>    
                <?php endforeach; ?>
                 <div class="item_list">       
                    <?php foreach ($products as $product) : ?>
                            <a href="product.php?id=<?php echo $product['prodID']; ?>" style = "text-decoration:none; color:black;">
                                <div class="item_wrapper">
                                    <img src="../assets/images/<?php echo $product['prodPhoto']; ?>"style="width:150px;height:150px;"/>
                                        <h2><?php echo $product['prodName']; ?></h2>
                                        <p><?php echo "$". $product['prodPrice'];?></p>

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
