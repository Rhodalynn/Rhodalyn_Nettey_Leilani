<?php
include __DIR__.'/../../db_cred.php';
// Make sure entries are not empty.
function createProduct($product_ID, $product_name, $description, $size, $colour, $unit_price, $image_url, $availability){
    if (empty($product_ID)) {
        return array("success" => false, "error" => array("message" => "Enter the product ID."));
    } 

   if (empty($product_name)) {
        return array("success" => false, "error" => array("message" => "Enter the product ID."));
    } 

    if (empty($description)) {
        return array("success" => false, "error" => array("message" => "Enter the description."));
    } 

    if (empty($size)) {
        return array("success" => false, "error" => array("message" => "Enter product size."));
    } 

    if (empty($colour)) {
        return array("success" => false, "error" => array("message" => "Enter product colour."));
    } 

    if (empty($unit_price)) {
        return array("success" => false, "error" => array("message" => "Enter the unit price"));
    } 

    if (empty($image_url)) {
        return array("success" => false, "error" => array("message" => "Upload product picture"));
    } 

    if (empty($availability)) {
        return array("success" => false, "error" => array("message" => "Enter the product availability"));
    } 


    //Insert data entry into database
    global $conn;
    $sql = "INSERT INTO products (product_ID, product_name, description, size, colour, unit_price, image_url, availability) VALUES ('$product_ID', '$product_name', '$description', '$size', '$colour', '$unit_price', '$image_url', '$availability')";
    if (mysqli_query($conn, $sql)) {
        return array("success" => true, "message" => "Product successfully created");
      } else {
        return array("success" => false, "error" => array("message" => "Error: " . $sql . "<br>" . mysqli_error($conn) ));
        
    }
} 

function getAllProducts(){
    //Select all categories from the database
    global $conn;
    $sql = "SELECT * FROM `products`";

    $result = mysqli_query($conn, $sql);
   
       if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $products = [];
            while($row = mysqli_fetch_assoc($result)){

                   array_push($products, $row);
            }

        return array("success" => true, "data" =>  $products, "message" => "Products successfully found.");
    
    
        } else {
            
            return array("success" => false, "error" => array("message" => "0 results"));
        
    }
}

function getAllProductsByCategory($category_ID){
    //Select all categories from the database
    global $conn;
    $sql = "SELECT * FROM `products`";

    $result = mysqli_query($conn, $sql);
   
       if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $products = [];
            while($row = mysqli_fetch_assoc($result)){

                   array_push($products, $row);
            }

        return array("success" => true, "data" =>  $products, "message" => "Products successfully found.");
    
    
        } else {
            
            return array("success" => false, "error" => array("message" => "0 results"));
        
    }
}


function deleteProduct($product_ID){
    global $conn;
      //Delete category from database
      $sql =  "DELETE FROM products WHERE products.product_ID = '$product_ID' ";
      
  
      if (mysqli_query($conn, $sql)) {
        return array("success" => true, "data" =>  $product_ID, "message" => "Product successfully deleted.");
      } else {
        return array("success" => false, "error" => array("message" => "Error: " . $sql . "<br>" . mysqli_error($conn) ));
  
  }

}