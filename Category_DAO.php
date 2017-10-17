<?php
/**
 * Created by PhpStorm.
 * User: Jonathan Nicholas
 * Date: 10/17/2017
 * Time: 18:52
 */

class Category_DAO
{
    public $category_id;
    public $category_name;
    private $_conn;

    function __construct($conn)
    {
        $this->_conn=$conn;
    }

    public function returnCat()
    {
        $sql = "SELECT * from CATEGORY";
        $prepared_sql = mysqli_prepare($this->_conn,$sql);
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