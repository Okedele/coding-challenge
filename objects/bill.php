<?php
class Bill{
  
    // database connection and table name
    private $conn;
    private $table_name = "bill";
  
    // object properties
    public $id;
    public $username;
    public $mobile_number;
    public $amount_to_bill;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // create product
    function create(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                username=:username, mobile_number=:mobile_number, amount_to_bill=:amount_to_bill";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->mobile_number=htmlspecialchars(strip_tags($this->mobile_number));
        $this->amount_to_bill=htmlspecialchars(strip_tags($this->amount_to_bill));
    
        // bind values
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":mobile_number", $this->mobile_number);
        $stmt->bindParam(":amount_to_bill", $this->amount_to_bill);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }
}
?>