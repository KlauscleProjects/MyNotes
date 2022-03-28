<?php

/**
 * PDO Dabatase Class
 * connect to database
 * create prepared statements
 * bind values
 * return rows and results
 */

class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASSWORD;
    private $dbname = DB_NAME;

    private $dbh;
    private $stmnt;

    private $error;

    public function __construct()
    {
        //set DSN
        $dsn = "mysql:host={$this->host};dbname={$this->dbname}";

        $option = array(
            PDO::ATTR_PERSISTENT => true, //check if theres already established connection
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        //crete PDO instance
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $option);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    //prepare statement with query
    public function query($sql)
    {
        $this->stmnt = $this->dbh->prepare($sql);
    }

    //bind values
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
        }
        $this->stmnt->bindValue($param, $value, $type);
    }

    //execute the prepared statement
    public function execute()
    {
        return $this->stmnt->execute();
    }

    //get result set as array of objects
    public function resultSet()
    {
        $this->execute();
        return $this->stmnt->fetchAll(PDO::FETCH_OBJ);
    }

    //get single record as object
    public function singleRow()
    {
        $this->execute();
        return $this->stmnt->fetch(PDO::FETCH_OBJ);
    }

    //get row count
    public function rowCount()
    {
        return $this->stmnt->rowCount();
    }
}
