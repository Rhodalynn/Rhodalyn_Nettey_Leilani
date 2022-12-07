<?php
include __DIR__.'/../../db_cred.php';
// Make sure entries are not empty.
function createOrder($order_ID, $customer_ID, $payment_ID, $order_date, $ship_date, $arrival_date){
    if (empty($order_ID)) {
        return array("success" => false, "error" => array("message" => "Enter your order ID."));
    } 

   // if (empty($order_ID)) {
        //return array("success" => false, "error" => array("message" => "Enter your emergency ID."));
    //} 

    if (empty($customer_ID)) {
        return array("success" => false, "error" => array("message" => "Enter the customer ID."));
    } 

    if (empty($payment_ID)) {
        return array("success" => false, "error" => array("message" => "Enter payment ID."));
    } 

    if (empty($order_date)) {
        return array("success" => false, "error" => array("message" => "Enter order date."));
    } 

    if (empty($ship_date)) {
        return array("success" => false, "error" => array("message" => "Enter the shipping date"));
    }

    if (empty($arrival_date)) {
        return array("success" => false, "error" => array("message" => "Enter the arrival date"));
    } 


    //Insert data entry into database
    global $conn;
    $sql = "INSERT INTO order (order_ID, customer_ID, payment_ID, order_date, ship_date, arrival_date) VALUES ('$order_ID', '$customer_ID', '$payment_ID', '$order_date', '$ship_date', '$arrival_date')";
    if (mysqli_query($conn, $sql)) {
        return array("success" => true, "message" => "Order successfully created");
      } else {
        return array("success" => false, "error" => array("message" => "Error: " . $sql . "<br>" . mysqli_error($conn) ));
        
    }
} 

function getAllOrders(){
    //Select all categories from the database
    global $conn;
    $sql = "SELECT * FROM `order`";

    $result = mysqli_query($conn, $sql);
   
       if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $orders = [];
            while($row = mysqli_fetch_assoc($result)){

                   array_push($category, $row);
            }

        return array("success" => true, "data" =>  $orders, "message" => "Order successfully found.");
    
    
        } else {
            
            return array("success" => false, "error" => array("message" => "0 results"));
        
    }
}

function deleteOrder($order_ID){
    global $conn;
      //Delete category from database
      $sql =  "DELETE FROM order WHERE order.order_ID = '$order_ID' ";
      
  
      if (mysqli_query($conn, $sql)) {
        return array("success" => true, "data" =>  $order_ID, "message" => "Order successfully deleted.");
      } else 
        return array("success" => false, "error" => array("message" => "Error: " . $sql . "<br>" . mysqli_error($conn) ));
  
  }