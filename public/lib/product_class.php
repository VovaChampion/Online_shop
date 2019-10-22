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
        $stmt = $this->db->prepare('SELECT * FROM products');

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

    // get a product
    // var 1
    public function selectProduct($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM products WHERE id = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    } 

    // var 2
    // public function selectOrder($id)
    // {
    //     $stmt = $this->db->prepare('SELECT o.id, oi.id, t.name_ticket, o.customer_name, oi.valid_date, oi.used_ticket FROM orders_items oi
    //     JOIN orders o ON o.id = oi.order_id
    //     JOIN tickets t ON t.id = oi.ticket_id
    //     WHERE o.id = :id');

    //     $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    //     $stmt->execute();
    //     $result = $stmt->fetchAll();
    //     return $result;
    // } 

    public function selectImages($id)
    {
        $stmt = $this->db->prepare('SELECT image_path FROM images
        WHERE products_id = :id');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        // $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return $result;
    } 

}

?>