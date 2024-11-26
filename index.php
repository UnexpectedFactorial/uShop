<?php
    $lifetime = 60*60*24*14;
    session_set_cookie_params($lifetime);
    if(session_status()== PHP_SESSION_NONE){
        session_start();
    }

    require_once ('model/connection.php');
    require_once ('model/functions.php');
    

    $action = filter_input(INPUT_POST, 'action');

    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }
    
    $rUserName = filter_input(INPUT_POST, 'action');


    switch($action){
        case 'process_reg':

            $UserName = filter_input(INPUT_POST, 'uName');
            $FirstName = ucfirst(filter_input(INPUT_POST, 'fName'));
            $LastName = ucfirst(filter_input(INPUT_POST, 'lName'));
            $Address = filter_input(INPUT_POST, 'address');
            $Password = filter_input(INPUT_POST, 'password');
            

            insert_account($db,$UserName,$FirstName,$LastName,$Address,$Password);
            
            break;

        case 'add_product':

            $prodName = filter_input(INPUT_POST, 'pName');
            $catID = filter_input(INPUT_POST, 'category');
            $prodPrice = filter_input(INPUT_POST, 'pPrice');
            $prodDesc = filter_input(INPUT_POST, 'pDes');

            $file = $_FILES['file'];
            $fileName = $_FILES['file']['name'];
            $fileTmpName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileError = $_FILES['file']['error'];
            $fileType = $_FILES['file']['type'];
            $fileEXT = explode('.', $fileName);
            $fileACTE = strtolower(end($fileEXT));
            $allowed = array('png','jpg','jpeg');

            if (in_array($fileACTE, $allowed)){ 
                if($fileError === 0){ 
                    if($fileSize < 2000000){ 

                        $fileNameNew = uniqid('',true).".".$fileACTE;
                        $fileLocation = getcwd().'/assets/images/'.$fileNameNew;
                        move_uploaded_file($fileTmpName, $fileLocation);

                        add_product($db,$catID,$prodName,$prodPrice,$prodDesc,$fileNameNew);

                        header("Location: ./pages/panel.php?success=product");
                    }
                    else{
                        header("Location: ./pages/additem.php?error=size");
                    }
                    
                }
                else{
                    header("Location: ./pages/additem.php?error=upload");
                }
                
            }
            else{
                header("Location: ./pages/additem.php?error=filetype");
            }

            
        
            break;

        case 'edit-product':
            $prodID = filter_input(INPUT_POST, 'pID');
            $prodName = filter_input(INPUT_POST, 'pName');
            $prodPrice = filter_input(INPUT_POST, 'pPrice');
            $prodDesc = filter_input(INPUT_POST, 'pDes');

            update_product($db,$prodName,$prodPrice,$prodDesc,$prodID);
            header("Location: ./pages/panel.php?success=editprod");
            break;
            
        case 'delete-product':
            $prodID = filter_input(INPUT_POST, 'prodID');
            delete_product($db,$prodID);
            header("Location: ./pages/panel.php?success=deleteprod");
            break;
            
        case 'add-category':

            
            $category = filter_input(INPUT_POST, 'category');
            

            add_category($db,$category);
            header("Location: ./pages/panel.php?success=category");
            
            break;
        
        case 'delete-category':
            $prodID = filter_input(INPUT_POST, 'catID');
            delete_category($db,$prodID);
            header("Location: ./pages/panel.php?success=deletecat");
            break;
                    
        case 'login':
            $UserName = filter_input(INPUT_POST, 'uName');
            $Password = filter_input(INPUT_POST, 'password');
            if(login($db,$UserName,$Password)== true){
                
                header("Location: ./index.php");
            }

            
            else{
                header("Location: ./pages/login.php?error=wrong");
            }

            break;
        case 'logout':
            unset($_SESSION['id']);
            session_destroy();
            $_SESSION=NULL;
            header("Location: ./index.php");
            
            break;  
        case 'buy':
                $prodPrice = filter_input(INPUT_POST, 'price');
                $uID = filter_input(INPUT_POST, 'userID');
                
                order_product($db,$uID,$prodPrice);

                if(!empty($_SESSION['cart'])){
                    $_SESSION['cart'] = [];
                }
                header("Location: ./pages/profile.php?s=ordersuccess");
            break;
            
        case 'change-settings':
            $setting = filter_input(INPUT_POST, 'setting');
            $darkModeSwitch = filter_input(INPUT_POST, 'darkModeSwitch');
            change_setting($db,$setting,$darkModeSwitch);
            header("Location: ./pages/panel.php?success=settings");
            break;

        case 'add-to-cart':
            $product = filter_input(INPUT_POST, 'productID');
            $quantity = filter_input(INPUT_POST, 'quantity');
            $price = filter_input(INPUT_POST,'prodPrice');

            if($quantity > 0){
                if(isset($_SESSION['cart'][$product])){
                    $_SESSION['cart'][$product] += $quantity;
                }
                else{
                    $_SESSION['cart'][$product] = $quantity;
                }
            }

            header("Location: ./pages/cart.php");
            break;

        case 'clear-cart':
            $_SESSION['cart'] = [];
            header("Location: ./pages/cart.php?s=clear");
            break;
        
        case 'delete-cart':
            $key = filter_input(INPUT_POST, 'key');
            unset($_SESSION['cart'][$key]);
            header("Location: ./pages/cart.php?s=delete");
            break;

        default:
            header("Location: ./pages/home.php");
            break;
    }

?>