<?php
include __DIR__ .'/db.auth.controller.php';

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$inputJSON = file_get_contents('php://input');
$input= json_decode( $inputJSON, TRUE ); //convert JSON into array



//The endpoint for checking login.
if (isset($input['login'])) {
    
    $email = $input['login']["email"];
    $password = $input['login']["password"];

    echo json_encode(login($email, $password));
   
}

//The endpoint for checking signup.
if (isset($input['signup'])) {
    
    $email = $input['signup']["email"];
    $password = $input['signup']["password"];
    $fname = $input['signup']["fname"];
    $lname = $input['signup']["lname"];
    $contact = $input['signup']["contact"];


    echo json_encode(signup($fname, $lname, $contact, $email, $password));
   
}

//The endpoint for getting all users
if (isset($input['getAllCustomer'])) {
   
    echo json_encode(getAllCustomer());
   
}
