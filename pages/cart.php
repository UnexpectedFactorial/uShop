<?php
    $page_title = "My Cart";
    require_once("../model/connection.php");

    if(isset($_GET['s'])){
        $s = $_GET['s'];
    }
?>
    <?php include("../elements/header.php");?>
</head>

<body>
    <?php include("../elements/navbar.php");?>
    <?php if(isset($_GET['s'])) : ?>
        <?php if ($s == 'product') echo '<div class="login-status-ok"><b>Cart Cleared!</b></div>'; ?>
        <?php if ($s == 'delete') echo '<div class="login-status-ok"><b>Item Deleted!</b></div>'; ?>
    <?php endif; ?>

    <div class = "basic-wrapper">
        <table class="order-table">
            <tr>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Item Subtotal</th>
                <th>Action</th>
            </tr>
            <?php
                $total = 0;
                    foreach($_SESSION['cart'] as $key => $val){
                        $q = "SELECT * FROM products WHERE prodID = ?";
                        $statement = $db->prepare($q);
                        $statement->execute([$key]);
                        $prodInfo = $statement->fetch();
                        $statement->closeCursor();
                        $subtotal = $val * $prodInfo['prodPrice'];

                        $total += $subtotal;
                        $formattedtotal = number_format($total,2);
                        echo "
                        <tr>
                            <td><a href='product.php?id=$key'>{$prodInfo['prodName']}</a></td>
                            <td>$val</td>
                            <td>$ {$prodInfo['prodPrice']}</td>
                            <td>$$subtotal</td>
                            <td>
                                <form action='../index.php' method='POST'>
                                    <input type='hidden' name='action' value='delete-cart'>
                                    <input type='hidden' name='key' value='$key'>
                                    <input type='submit' value='Delete' class='one-click-buy'>
                                </form>
                            </td>
                        </tr>
                        ";
                    }

                    if(empty($_SESSION['cart'])){
                        echo "<tr><td colspan='5'><b>Cart is empty!</b></td></tr>";
                    }
                    else{
                        echo "<tr><td colspan='5'><b>Total: $$formattedtotal</b></td></tr>";
                    }
                    
                    echo"
                    <tr>
                        <td colspan='3'>
                            <form action='../index.php' method='POST'>
                                <input type='hidden' name='action' value='clear-cart'>
                                <input type='submit' value='Empty Cart' class='one-click-buy'>
                            </form>
                        </td>
                        <td colspan='3'>
                            <form action='../index.php' method='POST'>
                                <input type='hidden' name='action' value='buy'>
                                <input type='hidden' name='price' value='$total'>
                                <input type='hidden' name='userID' value='{$_SESSION['id']}'>
                                <input type='submit' value='Checkout' class='one-click-buy'>
                            </form>
                        </td>
                    </tr>
                    ";


            ?>

        </table>
    </div>


</body>
