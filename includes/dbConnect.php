
<?php

try {
    $dsn = "pgsql:host=localhost;dbname=GISportal;port=5432";
    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ];
    $pdo = new PDO($dsn, 'postgres', '1114', $opt);

    // echo "Your database connection is successful here.";
    return $pdo;

} catch (PDOException $e) {
    // Handle database connection errors gracefully.
    echo "Database connection failed: " . $e->getMessage();
    // You can log or display the error message as needed.
}
