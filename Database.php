<?php
/**
 * Created by PhpStorm.
 * User: Jonathan Nicholas
 * Date: 10/12/2017
 * Time: 18:41
 */

class Database
{
    private $_username;
    private $_password;
    private $_db;
    private $_host;
    private $_conn;
    private $_connerr;

    function __construct()
    {
        $this->setParams();
        $this->connDB();
    }

    public function setParams()
    {
        $this->_username="s27923517";
        $this->_password="punyamapunpun";
        $this->_db="s27923517";
        $this->_host='130.194.7.82';
    }

    public function connDB()
    {
        error_reporting(E_ERROR);
        $this->_conn = new mysqli($this->_host,$this->_username,$this->_password,$this->_db);
        error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
        if ($this->_conn->connect_errno)
        {
            $this->_connerr =$this->_conn->connect_error;
        }
    }

    public function getConn()
    {
        return $this->_conn;
    }

    public function getConnErr()
    {
        return $this->_connerr;
    }

    public function checkConn()
    {
        if($this->_connerr)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
}