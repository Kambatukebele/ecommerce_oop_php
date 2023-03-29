<?php

class Database
{
    /**
     * Connection to the database
     */

    public static $con;

    public function __construct()
    {
        $DB_TYPE = DB_TYPE;
        $DB_HOST = DB_HOST;
        $DB_NAME = DB_NAME;

        try {

            $string = "{$DB_TYPE}:host={$DB_HOST};dbname={$DB_NAME}";

            self::$con = new PDO($string, DB_USER, DB_PASS);
        } catch (PDOException $e) {

            die($e->getMessage());
        }
    }

    public static function getInstance()
    {

        if (self::$con) {

            return self::$con;
        }

        return $instance = new self();
    }

    /**
     * Reading to the database; 
     */

    public function read($query, $data = [])
    {
        $stm = self::$con->prepare($query);
        $result = $stm->execute($data);

        $data = $stm->fetchAll(PDO::FETCH_OBJ);

        if (is_array($data) && !empty($data)) {
            return $data;
        }
        return false;
    }

    /**
     * Writing to the database; 
     */

    public function write($query, $data = [])
    {
        $stm = self::$con->prepare($query);
        $result = $stm->execute($data);

        if ($result) {
            return true;
        }

        return false;
    }
}
