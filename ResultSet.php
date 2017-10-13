<?php
/**
 * Created by PhpStorm.
 * User: Jonathan Nicholas
 * Date: 10/10/2017
 * Time: 00:14
 */

class ResultSet
{
    private $_results;
    function __construct($results)
    {
        $this->_results = $results;
    }
    function getNext($dataobject,$counter)
    {
        $row = $this->_results[$counter];
        foreach ($row as $key=>$value)
        {
            $dataobject->$key = $value;
        }
        return $dataobject;
    }
    function rowCount()
    {
        $rowCount = sizeof($this->_results);
        return $rowCount;
    }
}