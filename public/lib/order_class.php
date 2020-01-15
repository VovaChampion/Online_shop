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

    // // create a new order
    // public function createOrder($name,$email,$phone)
    // {
    //     $date = date('Y-m-d H:i:s');
    //     $amount = 99;
        
    //     $stmt = $this->db->prepare('INSERT INTO orders (name, email, phone, amount, date) 
    //     VALUES (:name, :email, :phone, :amount, :date);');
        
    //     $stmt->execute([
    //         ':name' => $name, 
    //         ':email' => $email,
    //         ':phone' => $phone, 
    //         ':amount' => $amount,
    //         ':date' => $date
    //     ]);

    //     // $id_order = $this->db->lastInsertId(); 
    //     // return $id_order;
        
    //     header("Location:confirm.php");
    // }

    public function sendStripe($user_first_name,$user_last_name,$user_email,$user_address,$my_array,$total_amount)
    {
        require_once('../vendor/stripe/stripe-php/init.php');
        \Stripe\Stripe::setApiKey('sk_test_Y5Fm9BboJjOtQwUFG4N7AzTk'); //YOUR_STRIPE_SECRET_KEY

        $token = (isset($_POST['stripeToken'])) ? $_POST['stripeToken'] : null;

        // $name_last = "Bryant";
        // $address = "Odenplan";
        $state = "Stockholm";
        $zip = "12050";
        $country = "Sweden";
        $phone = "0732223344";
        $user_info = [
            'First Name' => $user_first_name,
            'Last Name' => $user_last_name,
            'Address' => $user_address,
            'State' => $state,
            'Zip Code' => $zip,
            'Country' => $country,
            'Phone' => $phone,
            'Amount' => $total_amount
        ];

        //$customer_id = 'cus_F9f2G6ZrRU7K8L';
        if (isset($customer_id)) 
        {
            try {
                // Use Stripe's library to make requests...
                $customer = \Stripe\Customer::retrieve($customer_id);
            } catch (\Stripe\Error\Card $e) {
                // Since it's a decline, \Stripe\Error\Card will be caught
                $body = $e->getJsonBody();
                $err  = $body['error'];

                $msg = "<div class='alert alert-danger'><ul>";
                $msg .= "<li>Status is: " . $e->getHttpStatus();" </li>";
                // $msg .= "<li>Type is: " . $err['type'];" </li>";
                // $msg .= "<li>Code is: " . $err['code'];" </li>";
                // $msg .= "<li>Param is: " . $err['param'];" </li>"; 
                $msg .= "<li>Message is: " . $err['message'];" </li>";      
                $msg .= "</ul></div>";
                echo $msg;

            } catch (\Stripe\Error\RateLimit $e) {
                // Too many requests made to the API too quickly
            } catch (\Stripe\Error\InvalidRequest $e) {
                // Invalid parameters were supplied to Stripe's API
            } catch (\Stripe\Error\Authentication $e) {
                // Authentication with Stripe's API failed
                // (maybe you changed API keys recently)
            } catch (\Stripe\Error\ApiConnection $e) {
                // Network communication with Stripe failed
            } catch (\Stripe\Error\Base $e) {
                // Display a very generic error to the user, and maybe send
                // yourself an email
            } catch (Exception $e) {
                // Something else happened, completely unrelated to Stripe
            }
        } else {
            try {
                // Use Stripe's library to make requests...
                $customer = \Stripe\Customer::create(array(
                    'email' => $user_email,
                    'source' => $token,
                    'metadata' => $user_info,
                ));
            } catch (\Stripe\Error\Card $e) {
                // Since it's a decline, \Stripe\Error\Card will be caught
                $body = $e->getJsonBody();
                $err  = $body['error'];

                $msg = "<div class='alert alert-danger'><ul>";
                $msg .= "<li>Status is: " . $e->getHttpStatus();" </li>";
                // $msg .= "<li>Type is: " . $err['type'];" </li>";
                // $msg .= "<li>Code is: " . $err['code'];" </li>";
                // $msg .= "<li>Param is: " . $err['param'];" </li>"; 
                $msg .= "<li>Message is: " . $err['message'];" </li>";      
                $msg .= "</ul></div>";
                
                echo $msg;

            } catch (\Stripe\Error\RateLimit $e) {
                // Too many requests made to the API too quickly
            } catch (\Stripe\Error\InvalidRequest $e) {
                // Invalid parameters were supplied to Stripe's API
            } catch (\Stripe\Error\Authentication $e) {
                // Authentication with Stripe's API failed
                // (maybe you changed API keys recently)
            } catch (\Stripe\Error\ApiConnection $e) {
                // Network communication with Stripe failed
            } catch (\Stripe\Error\Base $e) {
                // Display a very generic error to the user, and maybe send
                // yourself an email
            } catch (Exception $e) {
                // Something else happened, completely unrelated to Stripe
            }
        }

        if (isset($customer)) 
        {
            //print_r($customer);
            $charge_customer = true;

            // Save the customer in your own database!
            $this->createOrder($user_first_name,$user_last_name,$user_email,$user_address,$my_array);

            // Charge the Customer instead of the card
            try {
                // Use Stripe's library to make requests...
                $mult = 100;
                $sum = $user_info['Amount'] * $mult;
                $charge = \Stripe\Charge::create(array(
                    'amount' => $sum,
                    'description' => 'Books',
                    'currency' => 'sek',
                    'customer' => $customer->id,
                    'metadata' => $user_info
                ));

            } catch (\Stripe\Error\Card $e) {
                // Since it's a decline, \Stripe\Error\Card will be caught
                $body = $e->getJsonBody();
                $err  = $body['error'];
                $msg = "<div class='alert alert-danger'><ul>";
                $msg .= "<li>Status is: " . $e->getHttpStatus();" </li>";
                // $msg .= "<li>Type is: " . $err['type'];" </li>";
                // $msg .= "<li>Code is: " . $err['code'];" </li>";
                // $msg .= "<li>Param is: " . $err['param'];" </li>"; 
                $msg .= "<li>Message is: " . $err['message'];" </li>";      
                $msg .= "</ul></div>";
                echo $msg;

                $charge_customer = false;
            } catch (\Stripe\Error\RateLimit $e) {
                // Too many requests made to the API too quickly
            } catch (\Stripe\Error\InvalidRequest $e) {
                // Invalid parameters were supplied to Stripe's API
            } catch (\Stripe\Error\Authentication $e) {
                // Authentication with Stripe's API failed
                // (maybe you changed API keys recently)
            } catch (\Stripe\Error\ApiConnection $e) {
                // Network communication with Stripe failed
            } catch (\Stripe\Error\Base $e) {
                // Display a very generic error to the user, and maybe send
                // yourself an email
            } catch (Exception $e) {
                // Something else happened, completely unrelated to Stripe
            }
            if ($charge_customer) 
            {
                //print_r($charge);
            }
        }
    }
}
?>