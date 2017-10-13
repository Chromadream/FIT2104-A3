<html>
<head>
    <title>Famox Search Interface</title>
</head>
<body>
<?php
    if(empty($_POST["cat"]))
    {?>
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
        <td>Maximum Price</td>
        <td><input type="number" name="max_price" placeholder="Maximum Price"></td>
    </tr>
    <tr>
        <td><input type="submit" value="Search"></td>
    </tr>
</table>
</form>
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
<h1>Found Products</h1>
<table border="1">
    <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Purchase Price</td>
        <td>Sale Price</td>
        <td>Country of Origin</td>
    </tr>
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
    echo "</table>";
    }
    else {
        echo "There is no result for the specified search query.<a href='Search.php'><button>Do another search</button></a>";
    }
    }
    else {
        echo "Unable to connect to database. Error is: " . $conn->getConnErr();
    }
    }
    ?>
</body>
</html>