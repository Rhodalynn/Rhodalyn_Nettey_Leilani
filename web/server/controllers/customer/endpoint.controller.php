<?php
include __DIR__ .'/db.customer.controller.php';

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$inputJSON = file_get_contents('php://input');
$input= json_decode( $inputJSON, TRUE ); //convert JSON into array



//The endpoint for getting all customers.
if (isset($input['getCustomer'])) {

    echo json_encode(getAllCustomer());
   
}

//The endpoint for creating new customer.
if (isset($input['createCustomer'])) {
    $customerData = $input['createCustomer'];

    $customer_ID = uniqid();
    $fname = $customerData['fname'];
    $lname = $customerData['lname'];
    $contact = $customerData['contact'];
    $email = $customerData['email'];
    $password = $customerData['password'];
   

    echo json_encode(createCustomer($customer_ID, $fname, $lname, $contact, $email, $password));
   
}

//The endpoint for deleting customer.
if (isset($input['deleteCustomer'])) {
    $deleteCustomerId = $input['deleteCustomer'];
    echo json_encode(deleteCustomer($deleteCustomerId));

}