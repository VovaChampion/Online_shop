<?php

class Order 
{
    private $db;

    public function __construct() 
    {
        $this->db = new Db();
        $this->db = $this->db->connect();
    }

    // get last order id (max)
    public function getLastOrderId()
    {
        $stmt = $this->db->prepare('SELECT MAX(id) FROM batman.order');
        $stmt->execute();

        $id = $stmt->fetchColumn();
        return $id;
    }

    // public function countDays($new_date)
    // {
    //     $date = new DateTime ($new_date);
    //     $today = new DateTime (date("Y-m-d"));

    //     if($today > $date) {
    //         echo "The ticket is not valid";
    //     } elseif ($today == $date){
    //         echo "Today last day";
    //     } else {
    //         $days = $today->diff($date); 
    //         echo $days->format('%a days');
    //     }       
    // }


    public function createOrder($user_first_name,$user_last_name,$user_email,$user_address,$my_array)
    {
        $date = date('Y-m-d');
        $shipping_date = date('Y-m-d', strtotime(' + 5 days'));

        $stmt = $this->db->prepare('INSERT INTO batman.order (first_name, last_name, email, address, order_date) 
        VALUES (:first_name, :last_name, :email, :address, :order_date);');

        $stmt->execute([
            ':first_name' => $user_first_name, 
            ':last_name' => $user_last_name,
            ':email' => $user_email, 
            ':address' => $user_address,
            ':order_date' => $date
        ]);
        
        $id_order = $this->db->lastInsertId(); 

        foreach($my_array as $key => $value)
        {
            $stmt = $this->db->prepare('INSERT INTO batman.order_items (order_id, product_id, shipping_date) 
            VALUES (:order_id, :product_id, :shipping_date);');
            $stmt->execute([
				':order_id' => $id_order,
                ':product_id' => $value,
                ':shipping_date' => $shipping_date,
			]);
        }
        header("Location:confirm_order.php");
    }
}
?>