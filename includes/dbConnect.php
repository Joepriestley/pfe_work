
<?php

try {
    $dsn = "pgsql:host=gisportal.cfzonnclgbha.us-east-1.rds.amazonaws.com;dbname=GISportal;port=5432";
    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ];
    $pdo = new PDO($dsn, 'postgres', '1114joseph', $opt);

    // echo "Your database connection is successful here.";
    return $pdo;

} catch (PDOException $e) {
    // Handle database connection errors gracefully.
    echo "Database connection failed: " . $e->getMessage();
    // You can log or display the error message as needed.
}
