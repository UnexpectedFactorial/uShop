<?php
    $darkquery = 'SELECT * FROM siteSettings WHERE feature="useDark"';
    $darkstatement = $db->prepare($darkquery);
    $darkstatement->execute();
    $modeSwitch = $darkstatement->fetch();
    $darkstatement->closeCursor();

    session_start();
    if(empty($_SESSION['id'])){
        $login_status = 0;
    }
    else{
        $login_status= 1;
    }

?>

<html lang='en'>

    <head>
        <link rel="icon" type="image/x-icon" href="../assets/favicon.png">
        <meta charset="utf-8" />
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital@1&display=swap" rel="stylesheet"> 
        <title>U-Shop - <?php echo $page_title?></title>
        <?php if($modeSwitch['switch'] == 1): ?>
            <link rel="stylesheet" type="text/css" href="../darktheme.css" />
        <?php elseif($modeSwitch['switch'] == 0): ?>
            <link rel="stylesheet" type="text/css" href="../theme.css" />
        <?php endif; ?>
        
