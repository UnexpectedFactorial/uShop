<?php
    $page_title = "Add Item";
    require_once("../model/connection.php");
    $query = 'SELECT * FROM categories';
    $statement = $db->prepare($query);
    $statement->execute();
    $categories = $statement->fetchAll();
    $statement->closeCursor();

    if(isset($_GET['error'])){
        $error = $_GET['error'];
    }

?>
    <?php include("../elements/header.php");?>
    
</head>

<body>
    <?php include("../elements/navbar.php");?>

    <?php if(isset($_GET['error'])) : ?>
        <?php if ($error == 'size') echo '<div class="login-status"><b>Picture exceeds file size! 2MB file limit</b></div>'; ?>
        <?php if ($error == 'upload') echo '<div class="login-status"><b>Something went wrong in the upload process!</b></div>'; ?>
        <?php if ($error == 'filetype') echo '<div class="login-status"><b>Unsupported File Type!</b></div>'; ?>
    <?php endif; ?>

    <main>
        <div class ="main_wrapper">
            <h1>Add Item</h1>
            <form action ="../index.php" method = "post" enctype="multipart/form-data">

                <input type="hidden" name="action" value="add_product">
                
                <input type="text" name="pName" placeholder="Product Name" class="item-textbox"required><br>
                
                
                <input type="text" name="pPrice" placeholder="Price (No Dollar Sign Needed)" class="item-textbox"required><br>
                <input type="text" name="pDes" placeholder="Product Description" class="item-textbox"required><br>

                <input type="file" name="file"required accept=".png,.jpg,.jpeg">
                <br>
                <select name="category" id="category">
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?php echo $category['catID']?>"><?php echo $category['catName']?></option>
                    <?php endforeach; ?>
                </select><br>
                <center><input type="submit" value="Add Item" class="submit-button"></center>

            </form>
        </div>
    </main>

    <?php include("../elements/footer.php");?>
</body>
