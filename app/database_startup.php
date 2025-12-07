<?php 
    require 'database_connect.php'; // Include the connection file

    // Create a table if it doesn't exist
    $pdo->exec("CREATE TABLE users (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    name TEXT NOT NULL,
                    email TEXT NOT NULL 
                )");
    $pdo->exec("CREATE TABLE documents (
                    id INTEGER PRIMARY KEY,
                    docName TEXT NOT NULL,
                    topic TEXT NOT NULL
                )");

    // Populate user table
    $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
    $stmt->execute(['John Doe', 'john.doe@example.com']);

    //Populate documents table
    $stmtUrl = $pdo->prepare("INSERT INTO documents (id, docName, topic) VALUES (?, ?, ?)");
    $stmtUrl->execute([1, 'Project Plan', 'October 3rd!']);
    $stmtUrl->execute([3, 'SQL Injection Guide', 'How to prevent SQL Injections, CSC 544']);
    $stmtUrl->execute([544, 'key', 'ribbit']);
?>