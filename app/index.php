<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CSC 544</title>
</head>
<body>
    <h1>SQL XSS</h1>
    <?php
    require 'database_connect.php'; // Include the connection file

    // Example: Select all users
    $stmt = $pdo->query("SELECT id, name, email FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Name</th>";
    echo "<th>Email</th>";
    echo "</tr>";
    foreach($users as $user) 
    {
        echo "<td>";
        echo $user['id'];
        echo "</td>";
        echo "<td>";
        echo $user['name'];
        echo "</td>";
        echo "<td>";
        echo $user['email'];
        echo "</td>";
    }
    echo "</table>";
    ?>
</body>
</html>