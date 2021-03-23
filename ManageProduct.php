<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Manage Product-Mir's Studio</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <style>
            body{
                background-color: #f1f2f6;
                background-image: linear-gradient(315deg, #f1f2f6 0%, #c9c6c6 74%);
                font-family: Yu Gothic UI;
            }
            th{
                background-color: #7F8C8D;
                color: #fffcfc;
            }
            tr:hover{
                background-color: #f5f5f5;
            }
        </style>
    </head>

    <body>
        <?php require_once 'process.php'; ?>

        <?php
        if(isset($_SESSION['message'])): ?>

        <div class="alert alert-<?=$_SESSION['msg_type']?>">
            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div>

        <?php endif; ?>

        <div class="container">
        <?php
            $mysqli = new mysqli('localhost', 'root', '', 'lists') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM lists") or die($mysqli->error);
            $count = mysqli_num_rows($result);
        ?>

        <div class="row justify-content-center">
            <table class="table">
                <thread>
                    <tr>
                        <th>Product</th>
                        <th>Tag</th>
                        <th>Prices</th>
                        <th>Stock</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thread>
        <?php
            while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['Product']; ?></td>
                    <td><?php echo $row['Tag']; ?></td>
                    <td><?php echo $row['Price']; ?></td>
                    <td><?php echo $row['Stock']; ?></td>
                    <td>
                        <a href="ManageProduct.php?edit=<?php echo $row['ID']; ?>"
                            class="btn btn-info">Edit</a>
                        <a href="process.php?delete=<?php echo $row['ID']; ?>"
                            class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </table>
        </div>

        <?php 
            function pre_r( $array ){
                echo '<pre>';
                print_r($array);
                echo'</pre>';
            }
        ?>

        <div class="row justify-content-between">
        <form action="process.php" method="POST">
            <input type="hidden" name="ID" value="<?php echo $ID; ?>">
            <div class="form-group">
            <label>Product</label>
            <input type="text" name="Product" class="form-control" value="<?php echo $Product;?>" placeholder="Enter Product Name">
            </div>

            <div class="form-group">
            <label>Tag</label>
            <input type="text" name="Tag" class="form-control" value="<?php echo $Tag; ?>" placeholder="Enter tag">
            </div>
            
            <div class="form-group">
            <label>Price</label>
            <input type="text" name="Price" class="form-control" value="<?php echo $Price; ?>">
            </div>
            
            <div class="form-group">
            <label>Stock</label>
            <input type="text" name="Stock" class="form-control" value="<?php echo $Stock; ?>">
            </div class="form-group">

            <?php 
                if ($update==true):
            ?>
                <button type="submit" class="btn btn-info" name="Update">Update</button>
            <?php else: ?>
                <button type="submit" class="btn btn-primary" name="Save">Save</button>
            <?php endif; ?>
            </div>
        </form>
        </div>
        </div>
    </body>
</html>