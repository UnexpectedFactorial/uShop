<?php

    function insert_account(PDO $db,$userName, $fName,$lName,$address,$password){
        $usernameCheck = 'SELECT 1 FROM users WHERE userName = ?';
        $uCheck = $db->prepare($usernameCheck);
        $uCheck->execute([$userName]);
        $check = $uCheck->fetchColumn();

        if (!$check){
            if (reg_verify($userName, $fName,$lName,$address,$password)== true){
                $query = 'INSERT INTO users (userName,userFName,userLName,userAddress,userPass) VALUES (:userName,:fName,:lName,:address,:password)';
                //$salt = password_hash($password, PASSWORD_DEFAULT);
                $statement = $db->prepare($query);
                $statement->bindValue(':userName',$userName);
                $statement->bindValue(':fName',$fName);
                $statement->bindValue(':lName',$lName);
                $statement->bindValue(':address',$address);
                $statement->bindValue(':password',$password);
                $statement->execute();
                $statement->closeCursor();
                header("Location: ./pages/registrationsucess.php");
            }
            else{
                header("Location: ./pages/registration.php?error=blank");
            }
        }
        else{
            header("Location: ./pages/registration.php?error=duplicate");
        }
        $check->closeCursor();
    }

    function reg_verify($userName, $fName,$lName,$address,$password){
        if(empty($userName) || empty($fName) ||empty($lName) ||empty($address) ||empty($password)){
            return false;
        }
        else{
            return true;
        }
    }


    function login(PDO $db,$UserName,$Password){
        $query = 'SELECT * FROM users WHERE userName = ? AND userPass = ?';
        $login = $db->prepare($query);
        $login->execute([$UserName,$Password]);
        $check = $login->fetch();
        $login->closeCursor();
        //session_start();
        if($check){
            $_SESSION['id'] =  $check['userID'];
            $_SESSION['cart'] = [];
            return true;
            
        }
        else{

            return false;
        }
        
    }

    function login_verify($userName,$password){
        if(empty($userName) ||empty($password)){
            return false;
        }
        else{
            return true;
        }
    }

    function add_product(PDO $db,$catID,$prodName,$prodPrice,$prodDesc,$prodImg){
        $query = 'INSERT INTO products (catID,prodName,prodPrice,prodDes,prodPhoto) VALUES (?,?,?,?,?)';
        $insert = $db->prepare($query);
        $insert->execute([$catID,$prodName,$prodPrice,$prodDesc,$prodImg]);
        $insert->closeCursor();
    }
    
    function add_category(PDO $db,$catName){
        $query = 'INSERT INTO categories (catName) VALUES (?)';
        $insert = $db->prepare($query);
        $insert->execute([$catName]);
        $insert->closeCursor();
    }

    function order_product(PDO $db,$uID,$prodPrice){
        date_default_timezone_set('America/Vancouver');
        $date = date("Y-m-d H:i:s");
        $query = 'INSERT INTO orders (userID,orderTime,orderTotal) VALUES (?,?,?)';
        $insert = $db->prepare($query);
        $insert->execute([$uID,$date,$prodPrice]);
        $insert->closeCursor();
    }

    function change_setting(PDO $db,$setting,$switch){
        $query = 'UPDATE siteSettings SET switch = ? WHERE feature = ?';
        $insert = $db->prepare($query);
        $insert->execute([$switch,$setting]);
        $insert->closeCursor();
    }

    function delete_product(PDO $db,$pID){
        $query = 'DELETE FROM products WHERE prodID = ?';
        $insert = $db->prepare($query);
        $insert->execute([$pID]);
        $insert->closeCursor();
    }

    function delete_category(PDO $db,$cID){
        $query = 'DELETE FROM categories WHERE catID = ?';
        $insert = $db->prepare($query);
        $insert->execute([$cID]);
        $insert->closeCursor();
    }

    function update_product(PDO $db,$prodName,$prodPrice,$prodDesc,$prodID){
        $query = 'UPDATE products SET prodName = ?,prodPrice = ?,prodDes = ? WHERE prodID = ?';
        $insert = $db->prepare($query);
        $insert->execute([$prodName,$prodPrice,$prodDesc,$prodID]);
        $insert->closeCursor();
    }
?>