<?php
    $page_title = "Database Tables";
    
    require_once("../model/connection.php");
    include("../elements/header.php");

    if($_SESSION['id'] !== 1){
        header("Location: error.php?e=autherror");
    }

    $userID = $_SESSION['id'];
    
    $q = 'SELECT * FROM products';
    $statement = $db->prepare($q);
    $statement->execute();
    $products = $statement->fetchAll();
    $statement->closeCursor();

    

    $q2 = 'SELECT * FROM orders';
    $statement2 = $db->prepare($q2);
    $statement2->execute();
    $orders = $statement2->fetchAll();
    $statement2->closeCursor();

    $q3 = 'SELECT * FROM users';
    $statement3 = $db->prepare($q3);
    $statement3->execute();
    $users = $statement3->fetchAll();
    $statement3->closeCursor();
    
    $q4 = 'SELECT * FROM categories';
    $statement4 = $db->prepare($q4);
    $statement4->execute();
    $categories = $statement4->fetchAll();
    $statement4->closeCursor();
?>
    
</head>

<body>
    <?php include("../elements/navbar.php");?>

    <main>
        
        <div class="user-orders">
            <h1>All Tables</h1>

            <h2>Users</h2>
            <table class="order-table">
                <tr>
                    <th>UserID</th>
                    <th>Username</th>
                    <th>User First Name</th>
                    <th>User Last Name</th>
                    <th>User Address</th>
                </tr>

                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?php echo $user['userID']?></td>
                        <td><?php echo $user['userName']?></td>
                        <td><?php echo $user['userFName']?></td>
                        <td><?php echo $user['userLName']?></td>
                        <td><?php echo $user['userAddress']?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <h2>Products</h2>            
            <table class="order-table">
                <tr>
                    <th>Product ID</th>
                    <th>Category ID</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Description</th>
                    <th>Product Photo Name</th>
                    <th>Action Button</th>
                </tr>

                <?php foreach ($products as $product) : ?>
                    <?php $formatted = number_format($product['prodPrice'],2);?>

                    <tr>
                        <td><?php echo $product['prodID']?></td>
                        <td><?php echo $product['catID']?></td>
                        <td><?php echo $product['prodName']?></td>
                        <td><?php echo $formatted?></td>
                        <td><?php echo $product['prodDes']?></td>
                        <td><a href="../assets/images/<?php echo $product['prodPhoto']?>"><?php echo $product['prodPhoto']?></a></td>
                        <td>
                            <form action="../index.php" method="post">
                                <input type="hidden" name = "action" value="delete-product">
                                <input type="hidden" name = "prodID" value="<?php echo $product['prodID']?>">
                                <input type="submit" value="Delete" class="submit-button-no-ani">
                            </form>

                            <a href="edit.php?id=<?php echo $product['prodID']?>">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <h2>Categories</h2>
            <h4>WARNING- MAKE SURE ALL PRODUCTS ARE DELETED IN A CATEGORY BEFORE DELETING. IGNORING THIS WARNING COULD LEAD TO ORPHANED ITEMS</h4>            
            <table class="order-table">
                <tr>
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>Action Button</th>
                </tr>

                <?php foreach ($categories as $category) : ?>
                    <tr>
                        <td><?php echo $category['catID']?></td>
                        <td><?php echo $category['catName']?></td>
                        <td>
                            <form action="../index.php" method="post">
                                <input type="hidden" name = "action" value="delete-category">
                                <input type="hidden" name = "catID" value="<?php echo $category['catID']?>">
                                <input type="submit" value="Delete" class="submit-button-no-ani">
                            </form>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </table>

            <h2>Orders</h2>            
            <table class="order-table">
                <tr>
                    <th>orderID</th>
                    <th>Buyer ID</th>
                    <th>Order Time</th>
                    <th>Order Total</th>
                </tr>

                <?php foreach ($orders as $order) : ?>
                    <tr>
                        <td><?php echo $order['orderID']?></td>
                        <td><?php echo $order['userID']?></td>
                        <td><?php echo $order['orderTime']?></td>
                        <td><?php echo "$ ". number_format($order['orderTotal'],2)?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </main>


    <?php include("../elements/footer.php");?>
</body>
