<?php
include __DIR__ .'/db.addToCart.controller.php';

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$inputJSON = file_get_contents('php://input');
$input= json_decode( $inputJSON, TRUE ); //convert JSON into array



//The endpoint for getting all products in cart.
if (isset($input['getCartItems'])) {
    $customer_ID = $input['getCartItems'];

    echo json_encode(getCartItems($customer_ID));
   
}

//The endpoint for creating new cart.
if (isset($input['addToCart'])) {
    $cartData = $input['addToCart'];

    $customer_ID = $cartData['customer_ID'];
    $product_ID = $cartData['product_ID'];
    $quantity = $cartData['quantity'];
   
   

    echo json_encode(addToCart($customer_ID, $product_ID, $quantity));
   
}

//The endpoint for deleting cart/products in cart.
if (isset($input['deleteCartItem'])) {
    $cartItem = $input['deleteCartItem'];
    $customerId = $cartItem['customerId'];
    $productId = $cartItem['productId'];
    echo json_encode(deleteCartItem($customerId, $productId));

}

//The endpoint for updating cart.
if (isset($input['updateCartQty'])) {
    $updateCartQtyData = $input['updateCartQty'];

    $customer_ID = $updateCartQtyData['customer_ID'];
    $product_ID = $updateCartQtyData['product_ID'];
    $quantity = $updateCartQtyData['quantity'];


    echo json_encode(updateCartItemQty($customer_ID, $product_ID, $quantity));

}