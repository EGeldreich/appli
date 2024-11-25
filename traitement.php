<?php
    session_start();

    if(isset($_POST['submit'])){

        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);

        if ($name && $price && $qtt){

            $product = [
                "name" => $name,
                "price" => $price,
                "qtt" => $qtt,
                "total" => $price*$qtt
            ];

            $_SESSION['products'][] = $product;
        }
    }

    if(isset($_GET['action'])){
        $productIndex = $_POST['product_index'];
        switch($_GET['action']){
            case "delete" :
                unset($_SESSION['products'][$productIndex]);
                
            case "deleteAll" :
                $_SESSION['products'] = [];
            case "down-qtt" :
                $_SESSION['products'][$productIndex]['qtt'] -= 1;
            case "up-qtt" :
                $_SESSION['products'][$productIndex]['qtt'] += 1;
        }   
        header('location: recap.php');
        exit();    
    }
    header("location:index.php");