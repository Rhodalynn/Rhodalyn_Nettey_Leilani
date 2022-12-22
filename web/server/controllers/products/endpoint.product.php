<?php
include __DIR__ .'/db.product.controller.php';

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$inputJSON = file_get_contents('php://input');
$input= json_decode( $inputJSON, TRUE ); //convert JSON into array



//The endpoint for getting all products.
if (isset($input['getproduct'])) {

    echo json_encode(getAllProducts());
   
}

//The endpoint for creating new product.
if (isset($input['createProduct'])) {
    $productData = $input['createProduct'];

    $product_ID = uniqid();
    $product_name = $productNameData['product_name'];
    $description = $descriptionData['description'];
    $size = $sizeData['size'];
    $colour = $colourData['colour'];
    $unit_price = $unitPriceData['unit_price'];
    $picture = $pictureData['picture'];
    $availability = $availabilityData['availability'];
    
   

    echo json_encode(createProduct($product_ID, $product_name, $description, $size, $colour, $unit_price, $picture, $availability));
   
}

//The endpoint for deleting products.
if (isset($input['deleteProduct'])) {
    $deleteProductId = $input['deleteProduct'];
    echo json_encode(deleteProduct($deleteProductId));

}