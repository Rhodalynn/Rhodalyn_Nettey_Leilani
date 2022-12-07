<?php
include __DIR__ .'/db.category.controller.php';

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$inputJSON = file_get_contents('php://input');
$input= json_decode( $inputJSON, TRUE ); //convert JSON into array



//The endpoint for getting all public services.
if (isset($input['getCategory'])) {

    echo json_encode(getAllCategory());
   
}

//The endpoint for creating new public service.
if (isset($input['createCategory'])) {
    $categoryData = $input['createCategory'];

    $category_ID = uniqid();
    $category_name = $categoryData['name'];
    $category_des = $categoryData['description'];
    $image_url= $categoryData['image'];
   

    echo json_encode(createCategory($category_ID, $category_name, $category_des, $image_url));
   
}

//The endpoint for deleting public service.
if (isset($input['deleteCategory'])) {
    $deleteCategoryId = $input['deleteCategory'];
    echo json_encode(deleteCategory($deleteCategoryId));

}