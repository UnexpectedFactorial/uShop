<?php
    $page_title = "Site Settings";
    require_once("../model/connection.php");
?>
    <?php include("../elements/header.php");?>
</head>

<body>
    <?php include("../elements/navbar.php");?>

    <div class = "basic-wrapper">
        <h2>Site Settings</h2>
        <form action ="../index.php" method = "post">
            <input type="hidden" name="action" value="change-settings">
            <input type="hidden" name="setting" value="useDark">
            <?php if($modeSwitch['switch'] == 1): ?>
                <select name="darkModeSwitch" id="darkModeSwitch">
                    <option value="1" selected>Dark Mode On</option>
                    <option value="0">Dark Mode Off</option>
                    
                </select><br>
            <?php elseif($modeSwitch['switch'] == 0): ?>
                <select name="darkModeSwitch" id="darkModeSwitch">
                
                    <option value="0" selected>Dark Mode Off</option>
                    <option value="1">Dark Mode On</option>
                </select><br>
            <?php endif; ?>

            <center><input type="submit" value="Save Changes" class = "submit-button" style="margin-bottom:15px;"><br></center>
        </form>
    </div>


</body>
