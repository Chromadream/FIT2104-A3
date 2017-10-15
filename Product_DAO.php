<?php
/**
 * Created by PhpStorm.
 * User: Jonathan Nicholas
 * Date: 10/9/2017
 * Time: 23:50
 */

class Product_DAO
{
    public $product_id;
    public $product_name;
    public $product_purchase_price;
    public $product_sale_price;
    public $product_country_of_origin;
    private $_conn;

    function __construct($conn)
    {
        $this->_conn=$conn;
    }


    public function find_prod($cat,$name,$max_price)
    {
        $sql = "SELECT p.* FROM PRODUCT p, CATEGORY c, PRODUCT_CATEGORY pc 
                  WHERE c.CATEGORY_NAME LIKE ? AND p.product_name LIKE ? AND p.product_sale_price <= ? 
                  AND pc.category_id = c.category_id AND p.product_id = pc.product_id";
        $prepared_sql = mysqli_prepare($this->_conn,$sql);
        $prepared_sql->bind_param('ssd',$cat_search,$name_search,$max_price);
        $cat_search = "%".$cat."%";
        $name_search = "%".$name."%";
        $prepared_sql->execute();
        $result = $prepared_sql->get_result();
        if($result->num_rows > 0)
        {
            $allRows = mysqli_fetch_all($result,MYSQLI_ASSOC);
            include_once('ResultSet.php');
            return new ResultSet($allRows);
        }
    }
}
?>