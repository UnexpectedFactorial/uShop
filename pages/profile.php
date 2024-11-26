<?php
    $page_title = "My Profile";
    require_once("../model/connection.php");
    include("../elements/header.php");
    
    
    $userID = $_SESSION['id'];
    $q = 'SELECT * FROM users WHERE userID = ?';
    $statement = $db->prepare($q);
    $statement->execute([$userID]);
    $user = $statement->fetch();
    $statement->closeCursor();
    

    $q2 = 'SELECT * FROM orders WHERE userID = ?';
    $statement2 = $db->prepare($q2);
    $statement2->execute([$userID]);
    $orders = $statement2->fetchAll();
    $statement2->closeCursor();

    if(isset($_GET['s'])){
        $s = $_GET['s'];
    }

    
    
?>

<?php if(!isset($_SESSION['id'])){header("Location: error.php?e=noaccount");}?>
    
</head>

<body>
    <?php include("../elements/navbar.php");?>
    <?php if(isset($_GET['s'])) : ?>
        <?php if ($s == 'ordersuccess') echo '<div class="login-status-ok"><b>Your order has been processed!</b></div>'; ?>
    <?php endif; ?>

    <main>
        
        <div class ="user-profile">
            <h1>My Profile</h1>
            <h2>Username: <?php echo $user['userName']?></h2>
            <h3>Name:<?php echo $user['userFName']." ".$user['userLName']?></h3>
            <h3>Address:<?php echo $user['userAddress']?></h3>
        </div>
        <div class="user-orders">
            <h1>My Orders</h1>
            <table class="order-table">
                <tr>
                    <th>orderID</th>
                    <th>Order Time</th>
                    <th>Order Total</th>
                </tr>

                <?php foreach ($orders as $order) : ?>
                    <tr>
                        <td><?php echo $order['orderID']?></td>
                        <td><?php echo $order['orderTime']?></td>
                        <td><?php echo "$ ". number_format($order['orderTotal'],2)?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </main>


    <?php include("../elements/footer.php");?>
</body>
