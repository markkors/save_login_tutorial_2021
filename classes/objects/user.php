<?php


class user
{
    // database connection and table name
    private $conn;
    private $table_name = "users";

    // object properties
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $contact_number;
    public $address;
    public $password;
    public $access_level;
    public $access_code;
    public $status;
    public $created;
    public $modified;

    // session properties
    public $sessionid = null;

    // constructor
    public function __construct(mysqli $db){
        $this->conn = $db;

    }

    public function checklogin ($email,$password) {
        $result = false;
        $sql = "SELECT 
       `id`,
       `firstname`,
       `lastname`,
       `email`,
       `contact_number`,
       `address`,
       `access_level`,
       `access_code`,
       `status`,
       `password`,
       `created`,
       `modified` 
        FROM `{$this->table_name}`
        WHERE `email` = ? AND `status` = 1";
        try {
            $stmt = $this->conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("s", $email);
                if($stmt->execute()) {
                    if($r = $stmt->get_result()) {
                        if($r->num_rows > 0) {
                            while ($row = $r->fetch_object()) {
                                if(password_verify($password,$row->password)) {
                                    $this->id=$row->id;
                                    $this->firstname = $row->firstname;
                                    $this->lastname = $row->lastname;
                                    $this->email = $row->email;
                                    $this->contact_number = $row->contact_number;
                                    $this->address = $row->address;
                                    $this->access_level = $row->access_level;
                                    $this->access_code = $row->access_code;
                                    $this->status = $row->status;
                                    $this->password = $row->password;
                                    $this->created = $row->created;
                                    $this->modified = $row->modified;
                                    $result = true;
                                }
                                break; // only one record
                            }
                        }
                    }
                }
            }
        }
        catch (mysqli_sql_exception $e)
        {
            $result = false;
        }
        return $result;
    }

    public function adduser($firstname=null,
                            $lastname=null,
                            $email,
                            $contact_number=null,
                            $address=null,
                            $password) {

        $this->firstname = $firstname;
        $this->lastname= $lastname;
        $this->email = $email;
        $this->contact_number=$contact_number;
        $this->address = $address;
        $this->password = $password;
        $this->created = date("Y-m-d H:i:s");
        $this->status = 0; // default not active
        $this->access_code = uniqid();
        $result = false;

        $sql = "INSERT INTO `{$this->table_name}` 
            (`firstname`,`lastname`,`email`,`contact_number`,`address`,`password`,`created`,`status`,`access_code`) 
            VALUES (?,?,?,?,?,?,?,?,?)";

        try {
            $stmt = $this->conn->prepare($sql);
            if($stmt) {
                $stmt->bind_param("sssssssss",
                    $this->firstname,
                    $this->lastname,
                    $this->email,
                    $this->contact_number,
                    $this->address,
                    password_hash($this->password,PASSWORD_DEFAULT),
                    $this->created,
                    $this->status,
                    $this->access_code
                );
                if($stmt->execute()) {
                    $this->id=$stmt->insert_id;
                    $result = true;
                }
            }
        } catch (mysqli_sql_exception $e) {
            $result = false;
        }
        return $result;
    }

    /***
     * Update current user
     */
    public function update() {

        $result = false;
        $sql = "UPDATE `{$this->table_name}` 
        SET `firstname` = ?,
       `lastname` = ?,
       `email` = ?,
       `contact_number` = ?,
       `address` = ?,
       `access_level` = ?,
       `access_code` = ?,
       `status` = ?,
       `password` = ? 
       WHERE `id` = ?";

        try {
            $stmt = $this->conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("ssssssssss",
            $this->firstname,
             $this->lastname,
                  $this->email,
                  $this->contact_number,
                  $this->address,
                  $this->access_level,
                  $this->access_code,
                  $this->status,
                  $this->password,
                  $this->id
                );
                if($stmt->execute()) {
                    $result = true;
                }
            }
        }
        catch (mysqli_sql_exception $e) {
            $result = false;
        }
        return $result;
    }

    /***
     * Get user with id
     * @param $id
     * @return bool
     */
    public function getuser($id) {
        $result = false;
        $sql = "SELECT 
       `id`,
       `firstname`,
       `lastname`,
       `email`,
       `contact_number`,
       `address`,
       `access_level`,
       `access_code`,
       `status`,
       `password`,
       `created`,
       `modified` 
        FROM `{$this->table_name}`
        WHERE `id` = ?";

        try {
            $stmt = $this->conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("s",$id);
                if($stmt->execute()) {
                    $r = $stmt->get_result();
                    if($r->num_rows > 0) {
                        while ($row = $r->fetch_object()) {
                            $this->id=$row->id;
                            $this->firstname = $row->firstname;
                            $this->lastname = $row->lastname;
                            $this->email = $row->email;
                            $this->contact_number = $row->contact_number;
                            $this->address = $row->address;
                            $this->access_level = $row->access_level;
                            $this->access_code = $row->access_code;
                            $this->status = $row->status;
                            $this->password = $row->password;
                            $this->created = $row->created;
                            $this->modified = $row->modified;
                            $result = true;
                            break;
                        }
                    }
                }
            }
        }
        catch (mysqli_sql_exception $e) {
            $result = false;
        }


        return $result;
    }

    /***
     * @return false|string
     */
    public function getAllUsers() {
        $sql = "SELECT 
       `id`,
       `firstname`,
       `lastname`,
       `email`,
       `contact_number`,
       `address`,
       `access_level`,
       `access_code`,
       `status`,
       `password`,
       `created`,
       `modified` 
        FROM `{$this->table_name}`";
        $collection['users'] = [];
        $result =  false;
        try {
            $r = $this->conn->query($sql);
                if($r->num_rows > 0) {
                    while ($row = $r->fetch_object()) {
                        $item=[
                            "id"=>$row->id,
                            "firstname"=> $row->firstname,
                            "lastname" => $row->lastname,
                            "email" => $row->email,
                            "contact_number" => $row->contact_number,
                            "address" => $row->address,
                            "access_level" => $row->access_level,
                            "access_code" => $row->access_code,
                            "status" => $row->status,
                            "password" => $row->password,
                            "created" => $row->created,
                            "modified" => $row->modified
                            ];
                            array_push($collection['users'],$item);
                        }
                        // set user data in json format
                        $result = json_encode($collection);
                    }
        }
        catch (mysqli_sql_exception $e) {
            var_dump($e);
            $result = false;
        }
        return $result;
    }

}