<?php
//Connect to MongoDB
$mongoClient = new MongoClient();

//Select a database
$db = $mongoClient->ecommerce;

//Extract the data that was sent to the server
$name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);
$category = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_STRING);

$findCriteria = [];

if ($category) {
    $findCriteria['category'] = new MongoRegex("/$category/i");
}

if ($name) {
    $findCriteria['name'] = new MongoRegex("/$name/i");
}

//Find all of the customers that match  this criteria
$cursor = $db->Products->find($findCriteria);
$response = [];

header('Content-Type: application/json');

foreach ($cursor as $cust) {
    $response[] = $cust;
}

echo json_encode($response);

//Output the results
// echo "<h1>Results</h1>";
// foreach ($cursor as $cust){
//    echo "<p>";
//    echo "Product name: " . $cust['name'];
//    echo "</p>";
//    echo "<p>";
//    echo "name: " . $cust['category'];
//    echo "</p>";
//    echo "<p>";
//    echo "Price: " . $cust['cost'];
//    echo "</p>";
//    echo "<p>";
//    echo "Information about product: " . $cust['description'];
//    echo "</p>";
// }

//Close the connection
// $mongoClient->close();