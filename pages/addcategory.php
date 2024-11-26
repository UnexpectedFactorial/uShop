<?php
    $page_title = "Add Category";

    require_once("../model/connection.php");
    $query = 'SELECT * FROM categories';
    $statement = $db->prepare($query);
    $statement->execute();
    $products = $statement->fetchAll();
    $statement->closeCursor();

?>
    <?php include("../elements/header.php");?>
</head>

<body>
    <?php include("../elements/navbar.php");?>


    <main>
        <div class ="main_wrapper">
            <h1>Add Category</h1>
            <form action="../index.php" method = "post">

            <input type="hidden" name="action" value="add-category">
            <input type="text" name="category" placeholder="Category" class="item-textbox"><br>
            <center><input type="submit" value="Add Category" class="submit-button"></center>

            </form>
        </div>
    </main>

    <?php include("../elements/footer.php");?>
</body>
