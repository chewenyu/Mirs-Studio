<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'lists') or die(mysqli_error($mysqli));

$ID = 0;
$update= false;
$Product = '';
$Tag = '';
$Price = '';
$Stock = '';

if (isset($_POST['Save'])){
    $Product = $_POST['Product'];
    $Tag = $_POST['Tag'];
    $Price = $_POST['Price'];
    $Stock = $_POST['Stock'];

    $mysqli->query("INSERT INTO lists (Product, Tag, Price, Stock) VALUES('$Product', '$Tag', '$Price', '$Stock')") or
            die($mysqli->error);

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    "location: ManageProduct.php";
}

if (isset($_GET['delete'])){
    $ID = $_GET['delete'];
    $mysqli->query("DELETE FROM lists WHERE ID=$ID") or die($mysqli->error());

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    "location: ManageProduct.php";
}

if (isset($_GET['edit'])){
    $ID = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM lists WHERE ID=$ID") or die($mysqli->error());
    
    if (count($result)==1){
        $row = $result->fetch_array();
        $Product = $row['Product'];
        $Tag = $row['Tag'];
        $Price = $row['Price'];
        $Stock = $row['Stock'];
    }
}

if (isset($_POST['Update'])){
    $ID = $_POST['ID'];
    $Product = $_POST['Product'];
    $Tag = $_POST['Tag'];
    $Price = $_POST['Price'];
    $Stock = $_POST['Stock'];

    $result = $mysqli->query("UPDATE lists SET lists = '$Product', Tag = '$Tag', Price='$Price', Stock='$Stock' WHERE ID = $ID") or 
                        die($mysqli->error);

    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";

    "location: ManageProduct.php";
}