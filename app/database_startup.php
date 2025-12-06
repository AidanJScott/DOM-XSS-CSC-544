<?php 
    require 'database_connect.php'; // Include the connection file

    // Create a table if it doesn't exist
    $pdo->exec("CREATE TABLE users (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    name TEXT NOT NULL,
                    email TEXT NOT NULL 
                )");

    // Populate user table
    $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
    $stmt->execute(['John Doe', 'john.doe@example.com']);

?>