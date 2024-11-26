<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
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
    $categories = $statement3->fetch();
    $statement3->closeCursor();

    $page_title = $name;
?>
    <?php include("../elements/header.php");?>
    <?php if(!isset($_SESSION['id'])){header("Location: error.php?e=noaccount");}?>
    <?php if($_SESSION['id'] !== 1){header("Location: error.php?e=autherror");}?>
</head>

<body>
    <?php include("../elements/navbar.php");?>

    <main>
        <div class ="main_wrapper">
                <h1>Edit Item</h1>
                <h3><?php echo $name ?></h3>
                <form action ="../index.php" method = "post" enctype="multipart/form-data">

                    <input type="hidden" name="action" value="edit-product">
                    <input type="hidden" name="pID" value="<?php echo $products['prodID']?>">
                    
                    <input type="text" name="pName" value="<?php echo $products['prodName']?>" class="item-textbox"required><br>
                    
                    
                    <input type="text" name="pPrice" value="<?php echo $products['prodPrice']?>" class="item-textbox"required><br>
                    <input type="text" name="pDes" value="<?php echo $products['prodDes']?>" class="item-textbox"required><br>
                    <center><input type="submit" value="Edit Item" class="submit-button"></center>

                </form>
            </div>

 
    </main>

    <?php include("../elements/footer.php");?>
</body>
