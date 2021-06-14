<?php


class database
{

    // specify your own database credentials
    private $host = "192.168.178.201";
    private $db_name = "save_login";
    private $username = "save_login_user";
    private $password = "save_login_password";
    public $conn;

    function __construct() {
        // OR Method 2:
        mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR);
        $this->getConnection();
    }

    // get the database connection
    public function getConnection() : mysqli {
            static $mycon;
            $this->conn = $mycon;
            if(!isset($this->conn)) {
                try {
                    $this->conn = new MySQLi($this->host,$this->username,$this->password,$this->db_name);
                } catch(mysqli_sql_exception $exception){
                    echo "Connection error: " . $exception->getMessage();
                }
            }
            return $this->conn;
    }
}