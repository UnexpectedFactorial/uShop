<?php
    $dsn = 'mysql:host=localhost;dbname=ushop_db';
    $username = 'ushop_admin';
    $password = '123';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('connection_error.php');
        exit();
    }
?>