<!DOCTYPE html>
<html lang="en">
<head>
    <title>Famox Search Interface</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>
<?php
    if(empty($_POST["cat"]))
    {?>
<div class="container-fluid">
    <h1>Search A Product</h1>
    <form method="post" action="Search.php">
<table>
    <tr>
        <td>Category</td>
        <td><input type="text" name="cat" placeholder="Category Name"></td>
    </tr>
    <tr>
        <td>Name</td>
        <td><input type="text" name="name" placeholder="Product Name"></td>
    </tr>
    <tr>
        <td>Maximum Sale Price</td>
        <td><input type="number" name="max_price" placeholder="Maximum Sale Price"></td>
    </tr>
    <tr>
        <td><input type="submit" value="Search" class='btn btn-primary'></td>
    </tr>
</table>
</form>
</div>
    <?php }
    else
{
require_once("Database.php");
$conn = new Database();
if ($conn->checkConn())
{
require_once("Product_DAO.php");
$prod = new Product_DAO($conn->getConn());
            if($result = $prod->find_prod($_POST["cat"], $_POST["name"], $_POST["max_price"]))
            {?>

<div class="container-fluid">
    <h1>Found Products</h1>
<table class="table table-striped">
    <thead class="thead-inverse">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Purchase Price</th>
        <th>Sale Price</th>
        <th>Country of Origin</th>
    </tr>
    </thead>
    <tbody>
    <?php for ($i = 0; $i < $result->rowCount(); $i++) {
        $currentRow = $result->getNext(new Product_DAO($conn->getConn()), $i); ?>
        <tr>
            <td><?php echo $currentRow->product_id; ?></td>
            <td><?php echo $currentRow->product_name; ?></td>
            <td><?php echo $currentRow->product_purchase_price; ?></td>
            <td><?php echo $currentRow->product_sale_price; ?></td>
            <td><?php echo $currentRow->product_country_of_origin; ?></td>
        </tr>
    <?php }
    echo "</tbody></table>";
    echo "<br/> <a href='Search.php'><button type='button' class='btn btn-primary'>Do another search</button></a></div>";
    }
    else {
        echo "There is no result for the specified search query.<br/><a href='Search.php'><button type='button' class='btn btn-primary'>Do another search</button></a>";
    }
    }
    else {
        echo "Unable to connect to database. Error is: " . $conn->getConnErr();
    }
    }
    ?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>
</html>