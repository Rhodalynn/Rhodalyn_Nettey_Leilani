<?php
include __DIR__.'/../../db_cred.php';
// Make sure entries are not empty.
function createCategory($category_ID, $category_name, $ctg_descrpt, $image_url){
    if (empty($category_ID)) {
        return array("success" => false, "error" => array("message" => "Enter your employee ID."));
    } 

    if (empty($category_ID)) {
        return array("success" => false, "error" => array("message" => "Enter the category ID."));
    } 

    if (empty($category_name)) {
        return array("success" => false, "error" => array("message" => "Enter category name."));
    } 

    if (empty($ctg_descrpt)) {
        return array("success" => false, "error" => array("message" => "Enter category description."));
    } 

    if (empty($image_url)) {
        return array("success" => false, "error" => array("message" => "Upload category"));
    } 


    //Insert data entry into database
    global $conn;
    $sql = "INSERT INTO category (category_ID, category_name, ctg_descrpt, image_url) VALUES ('$category_ID', '$category_name', '$ctg_descrpt', '$image_url')";
    if (mysqli_query($conn, $sql)) {
        return array("success" => true, "message" => "Category successfully created");
      } else {
        return array("success" => false, "error" => array("message" => "Error: " . $sql . "<br>" . mysqli_error($conn) ));
        
    }
} 

function getAllCategory(){
    //Select all categories from the database
    global $conn;
    $sql = "SELECT * FROM `category`";

    $result = mysqli_query($conn, $sql);
   
       if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $category = [];
            while($row = mysqli_fetch_assoc($result)){

                   array_push($category, $row);
            }

        return array("success" => true, "data" =>  $category, "message" => "Category successfully found.");
    
    
        } else {
            
            return array("success" => false, "error" => array("message" => "0 results"));
        
    }
}

function deleteCategory($category_ID){
    global $conn;
      //Delete category from database
      $sql =  "DELETE FROM category WHERE category.category_ID = '$category_ID' ";
      
  
      if (mysqli_query($conn, $sql)) {
        return array("success" => true, "data" =>  $category_ID, "message" => "Category successfully deleted.");
      } else {
        return array("success" => false, "error" => array("message" => "Error: " . $sql . "<br>" . mysqli_error($conn) ));
  
  }

}