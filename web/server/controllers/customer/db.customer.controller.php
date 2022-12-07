<?php
include __DIR__.'/../../db_cred.php';

global $conn;

// Make sure entries are not empty
function createCustomer ($customer_ID, $fname, $lname, $contact, $email, $password){
    if (empty($customer_ID)) {
        return array("success" => false, "error" => array("message" => "Enter the customer ID."));
    } 

    if (empty($fname)) {
        return array("success" => false, "error" => array("message" => "Enter your first name."));
    } 

    if (empty($lname)) {
        return array("success" => false, "error" => array("message" => "Enter your last name."));
    } 

    if (empty($contact)) {
        return array("success" => false, "error" => array("message" => "Enter your phone number."));
    } 


    if (empty($email)) {
        return array("success" => false, "error" => array("message" => "Enter your email."));
    } 

    if (empty($password)) {
        return array("success" => false, "error" => array("message" => "Enter your password."));
    } 
    

    //Insert data entry into database
    global $conn;
    $sql = "INSERT INTO customer (customer_ID, fname, lname, contact, email, password) VALUES ('$customer_ID', '$fname', '$lname', '$contact', '$email','$password')";
    if (mysqli_query($conn, $sql)) {
        return array("success" => true, "message" => "Customer successfully created");
      } else {
        return array("success" => false, "error" => array("message" => "Error: " . $sql . "<br>" . mysqli_error($conn) ));
        
    }

}

function getAllCustomer(){
    //Select all customers from the database
    global $conn;
    $sql = "SELECT * FROM `customer`";

    $result = mysqli_query($conn, $sql);
   
       if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $customers = [];
            while($row = mysqli_fetch_assoc($result)){

                   array_push($customers, $row);
            }

        return array("success" => true, "data" =>  $customers, "message" => "Customers successfully found.");
    
    
        } else {
            
            return array("success" => false, "error" => array("message" => "0 results"));
        
    }


}

function getOneCustomer($customer_ID){
    //Select one customer from database
    global $conn;
    $sql="SELECT * FROM `customer` WHERE `customer_ID` = $customer_ID";

    $result = mysqli_query($conn, $sql);
   
    if (mysqli_num_rows($result) > 0) {
     // output data of each row
     $customer = [];
         while($row = mysqli_fetch_assoc($result)){

                array_push($customer, $row);
         }

     return array("success" => true, "data" =>  $customer, "message" => "Customer successfully found.");
 
 
     } else {
         
         return array("success" => false, "error" => array("message" => "0 results"));
     
 }

}

function editCustomer($customer_ID, $fname, $lname, $contact, $email, $password){
    //Edit customer details
    global $conn;
    $sqlQuery="UPDATE `customer` SET `fname`=$fname,`lname` = $lname,`contact` = $contact, `email`=$email, `password`=$password WHERE `customer_ID`= $customer_ID";

    $result = mysqli_query($conn, $sqlQuery);
   
    if (mysqli_num_rows($result) > 0) {
     // output data of each row
     $customer = [];
         while($row = mysqli_fetch_assoc($result)){

                array_push($customer, $row);
         }

     return array("success" => true, "data" =>  $customer, "message" => "Customer details edited successfully.");
 
 
     } else {
         
         return array("success" => false, "error" => array("message" => "0 results"));
     
 }

}



