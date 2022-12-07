<?php
include __DIR__ .'/db.order.controller.php';

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$inputJSON = file_get_contents('php://input');
$input= json_decode( $inputJSON, TRUE ); //convert JSON into array



//The endpoint for getting all orders.
if (isset($input['getOrder'])) {

    echo json_encode(getAllOrders());
   
}

//The endpoint for creating new order.
if (isset($input['createOrder'])) {
    $categoryData = $input['createOrder'];

    $order_ID = uniqid();
    $customer_ID = $customerData['ID'];
    $payment_ID = $paymentData['ID'];
    $order_date= $orderDateData['order_date'];
    $arrival_date= $arrivalDateData['arrival_date'];
    
   

    echo json_encode(createOrder($order_ID, $customer_ID, $payment_ID, $order_date, $ship_date, $arrival_date));
   
}

//The endpoint for deleting orders.
if (isset($input['deleteOrder'])) {
    $deleteOrderId = $input['deleteOrder'];
    echo json_encode(deleteOrder($deleteOrderId));

}