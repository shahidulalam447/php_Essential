<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD Script</title>
</head>
<body>
<!-- php CRUD Script  -->
<?php
// Class name
class db{
    public $hostname;
    public $username;
    public $password;
    public $db_name;
    public $conn;
    
    // Connect
    //  কন্সট্রাক্ট ফাংশন ক্লাসের মধ্যে অটো এক্সিকিউট হয়।
    public function __construct($hostname, $username, $password, $db_name){          

        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->db_name = $db_name;

        $this->conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->db_name);
        
        if (!$this->conn) {
            echo mysqli_error($this->conn);
        }
        else {
            // echo "Connected!";
        }
    }
    // Insert Data through dynamic
    public function insert($cname, $centrydate){

        $sql = "INSERT INTO category(category_name, category_entrydate) VALUES($cname, $centrydate)";

        if (mysqli_query($this->conn, $sql) == TRUE) {
            echo "Data Inserted";
        }
        else{
            echo mysqli_error($this->conn);
        }
    }
    // Update Data through Static/Manual
    public function update(){
        $sql = "UPDATE category_table SET 
                category_name = 'Electronics',
                category_entrydate = '02-02-2022'
                WHERE category_id = 6 ";
        if(mysqli_query($this->conn,$sql) == TRUE){
            echo "Data Updated!";
        }
        else {
            echo mysqli_error($this->conn);
        }
    }

    // Show Data through dynamic
    public function show($tablename, $columname){

        $sql = "SELECT * FROM $tablename";
        $data = mysqli_query($this->conn, $sql);

        while($row = mysqli_fetch_array($data)){
            echo $data1 = $row[$columname]."<br>";
        }
    }
    // Delete Data through dynamic
    public function delete($tablename, $columname, $cvalue){

        $sql = "DELETE FROM $tablename WHERE $columname = $cvalue";

        if(mysqli_query($this->conn,$sql) == TRUE){
            echo "Data Deleted!";
        }
        else {
            echo mysqli_error($this->conn);
        }
    }
}

// database connection through object create
$database = new db('localhost','root','','store_db');

// insert meethod call Code through object use 
$database->insert('furniture','01-01-2024');
// update meethod call Code through object use 
$database->update();
// show meethod call Code through object use 
$database->show('category_table', 'category_name');
// delete meethod call Code through object use 
$database->delete('category_table', 'category_id',6);



?>
    
</body>
</html>