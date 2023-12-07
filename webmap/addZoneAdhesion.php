<?php
    require_once ("./config/dbConnect.php");

    // Check if a POST request with GeoJSON data was received
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'));

    // You can validate the GeoJSON data and perform database insertion here
    // Example: Insert the GeoJSON data into a 'polygons' table
    $geojsonData = json_encode($data->polygonData);
    $query = "INSERT INTO polygons (geojson_data) VALUES (:geojsonData)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':geojsonData', $geojsonData, PDO::PARAM_STR);

    if ($stmt->execute()) {
        // Return a success response if insertion was successful
        echo json_encode(['message' => 'Polygon saved to database']);
    } else {
        // Return an error response if insertion failed
        http_response_code(500); // Internal Server Error
        echo json_encode(['error' => 'Failed to save polygon to database']);
    }
}
?>