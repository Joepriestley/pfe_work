<?php
try {
    $pdo = new PDO("pgsql:host=your_host;dbname=your_database", "your_username", "your_password");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve the feature data and additional properties from the AJAX request
    $featureData = json_decode($_POST['polygon']);
    $property1 = $_POST['property1'];
    $property2 = $_POST['property2'];

    // Prepare the SQL query to insert a feature with additional properties into the database
    $query = "INSERT INTO polygons (geom, property1, property2) VALUES (ST_SetSRID(ST_GeomFromGeoJSON(:featureData), 4326), :property1, :property2)";
    $stmt = $pdo->prepare($query);

    // Bind parameters
    $stmt->bindParam(':featureData', json_encode($featureData->geometry), PDO::PARAM_STR);
    $stmt->bindParam(':property1', $property1, PDO::PARAM_STR);
    $stmt->bindParam(':property2', $property2, PDO::PARAM_STR);

    // Execute the query
    $stmt->execute();

    echo "Feature saved successfully!";
} catch (PDOException $e) {
    echo "Error inserting feature: " . $e->getMessage();
}

// Close the database connection
$pdo = null;
?>
