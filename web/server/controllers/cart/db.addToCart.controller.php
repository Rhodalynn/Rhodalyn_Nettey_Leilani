<?php
include __DIR__.'/../../db_cred.php';
// Make sure entries are not empty.
function addToCart($customer_ID, $product_ID, $quantity){
    if (empty($customer_ID)) {
        return array("success" => false, "error" => array("message" => "Enter your customer ID."));
    } 

    if (empty($product_ID)) {
        return array("success" => false, "error" => array("message" => "Enter the product ID."));
    } 

    if (empty($quantity)) {
        return array("success" => false, "error" => array("message" => "Enter quantity."));
    } 


    //Insert data entry into database
    global $conn;
    $sql = "INSERT INTO cart (customer_ID, product_ID, quantity) VALUES ('$customer_ID', '$product_ID', '$quantity')";
    if (mysqli_query($conn, $sql)) {
        return array("success" => true, "message" => "Product successfully added.");
      } else {
        return array("success" => false, "error" => array("message" => "Error: " . $sql . "<br>" . mysqli_error($conn) ));
        
    }
} 

function getCartItems($customer_ID){
    //Select all categories from the database
    global $conn;
    $sql = "SELECT * FROM `cart` WHERE cart.customer_ID = '$customer_ID'";

    $result = mysqli_query($conn, $sql);
   
       if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $cart = [];
            while($row = mysqli_fetch_assoc($result)){

                   array_push($cart, $row);
            }

        return array("success" => true, "data" =>  $cart, "message" => "Cart successfully found.");
    
    
        } else {
            
            return array("success" => false, "error" => array("message" => "0 results"));
        
    }
}

function deleteCartItem($customer_ID, $product_ID){
    global $conn;
      //Delete cart/product from database
      $sql =  "DELETE FROM cart WHERE cart.customer_ID = '$customer_ID' AND cart.product_ID = '$product_ID' ";
      
  
      if (mysqli_query($conn, $sql)) {
        return array("success" => true, "data" =>  $product_ID, "message" => "Product successfully deleted.");
      } else {
        return array("success" => false, "error" => array("message" => "Error: " . $sql . "<br>" . mysqli_error($conn) ));
  
  }

}

function updateCartItemQty($customer_ID, $product_ID, $quantity){
    global $conn;
    //Update cart items in database
    $sql = "UPDATE cart SET `quantity` = '$quantity' WHERE `customer_ID` = $customer_ID AND `product_ID` = $product_ID ";

    if (mysqli_query($conn, $sql)) {
        return array("success" => true, "data" =>  $quantity, "message" => "Product quantity successfully updated.");
      } else {
        return array("success" => false, "error" => array("message" => "Error: " . $sql . "<br>" . mysqli_error($conn) ));
  
  }




}


?>