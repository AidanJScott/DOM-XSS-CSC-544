<?php
require 'database_connect.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>SQLi CTF Challenge</title>
    <style>
        body { background:#111; color:#0f0; font-family: Consolas; padding:20px; }
        .box { background:#222; padding:20px; border-radius:10px; }
        button {position: absolute; top:0; right: 100px; margin: 2rem; opacity: 0;}
        button:hover {opacity: 1; transition: opacity 0.5s;}
        #hint {color:#222}
    </style>
</head>
<body>

<h1>URL-Based SQL Injection Challenge</h1>

<div class="box">
    <p>Your objective? = fInd the aDmin's secret using only the GET parameter.</p>
    <p>Everything is a hint, use every clue.</p>
    <p id="hint">Hint: Top Right :]</p>
    
</div>
<button onclick="location.href='hint.html'">FOUND ME</button>
<hr>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];  // intentionally unsafe

    echo "<p>Debug SQL query:<br><code>SELECT docName, secret FROM documents WHERE id = $id</code></p>";

    $query = "SELECT docName, topic FROM documents WHERE id = $id";

    try {

        $result = $pdo->query($query);
        $row = $result->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            echo "<h2>Result:</h2>";
            echo "<p><strong>Document Name:</strong> {$row['docName']}</p>";
            echo "<p><strong>Topic:</strong> {$row['topic']}</p>";
        } else {
            echo "<p>No record found.</p>";
        }

    } catch (Exception $e) {
        echo "<p style='color:red'>SQL Error: " . $e->getMessage() . "</p>";
    }
}
?>

</body>
</html>
