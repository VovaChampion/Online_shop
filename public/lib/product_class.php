<?php

class Product 
{
    private $db;

    public function __construct() 
    {
        $this->db = new Db();
        $this->db = $this->db->connect();
    }

    // get all products
    public function getProducts() 
    {
        $stmt = $this->db->prepare('SELECT product_name, price, description, image_path FROM products');

        if($stmt->execute()){
            if($stmt->rowCount()>0){
                while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
                {
                    $data[] = $row;
                }
                return $data;
            }
        }
    }

}

?>