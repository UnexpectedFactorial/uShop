<?php
    $page_title = "Home Page";

?>
    <?php include("../elements/header.php");?>
</head>

<body>
    <?php include("../elements/navbar.php");?>
    <main>
        <h1>Database Error Occured</h1>
        <p>Please contact the site administrator with the following information.</p>
        <p>Error:</p>
        <p><?php echo $error_message?></p>
    </main>
    <?php include("../elements/footer.php");?>
</body>