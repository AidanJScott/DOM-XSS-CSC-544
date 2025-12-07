<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CSC 544</title>
</head>
<body>
    <h1>SQL & XSS Capture the Flag</h1>
    
    <form action="ctf.php" method="post">
        <div>
            <label for="sqlwaf">WAF-Based SQL Injection Key:</label><br>
            <input type="text" id="sqlwaf" name="sqlwaf">
        </div>
        <div>
            <button type="submit">Submit</button>
        </div>
    </form>

    
    
    <?php 
        if ((isset($_POST['xssreflected']) || isset($_POST['xssstored']) || isset($_POST['xssdom']) || isset($_POST['sqlserver']) || isset($_POST['sqlurl'])) || isset($_POST['xssdom']) || (isset($_POST['sqlwaf']) && $_POST['sqlwaf'] == "wafkey")) {
            echo "<form action=\"ctf.php\" method=\"post\">";
            echo "<div>";
            echo "<label for=\"sqlurl\">URL-Based SQL Injection Key:</label><br>";
            echo "<input type=\"text\" id=\"sqlurl\" name=\"sqlurl\">";
            echo "</div>";
            echo "<div>";
            echo "<button type=\"submit\">Submit</button>";
            echo "</div>";
            echo "</form>";
        }
        if (isset($_POST['xssreflected']) || isset($_POST['xssstored']) || isset($_POST['sqlserver']) || isset($_POST['xssdom']) || (isset($_POST['sqlurl']) && $_POST['sqlurl'] == "ribbit")) {
            echo "<form action=\"ctf.php\" method=\"post\">";
            echo "<div>";
            echo "<label for=\"sqlserver\">Server-Based SQL Injection Key:</label><br>";
            echo "<input type=\"text\" id=\"sqlserver\" name=\"sqlserver\">";
            echo "</div>";
            echo "<div>";
            echo "<button type=\"submit\">Submit</button>";
            echo "</div>";
            echo "</form>";
        }
        if (isset($_POST['xssreflected']) || isset($_POST['xssstored']) || isset($_POST['xssdom']) || (isset($_POST['sqlserver']) && $_POST['sqlserver'] == "serverkey")) {
            echo "<form action=\"ctf.php\" method=\"post\">";
            echo "<div>";
            echo "<label for=\"xssdom\">DOM-Based Cross-Site Scripting Key:</label><br>";
            echo "<input type=\"text\" id=\"xssdom\" name=\"xssdom\">";
            echo "</div>";
            echo "<div>";
            echo "<button type=\"submit\">Submit</button>";
            echo "</div>";
            echo "</form>";
        }
        if (isset($_POST['xssreflected']) || isset($_POST['xssstored']) || (isset($_POST['xssdom']) && $_POST['xssdom'] == "domkey")) {
            echo "<form action=\"ctf.php\" method=\"post\">";
            echo "<div>";
            echo "<label for=\"xssstored\">Stored Cross-Site Scripting Key:</label><br>";
            echo "<input type=\"text\" id=\"xssstored\" name=\"xssstored\">";
            echo "</div>";
            echo "<div>";
            echo "<button type=\"submit\">Submit</button>";
            echo "</div>";
            echo "</form>";
        }
        if (isset($_POST['xssreflected']) || (isset($_POST['xssstored']) && $_POST['xssstored'] == "storedkey")) {
            echo "<form action=\"ctf.php\" method=\"post\">";
            echo "<div>";
            echo "<label for=\"xssreflected\">Reflected Cross-Site Scripting Key:</label><br>";
            echo "<input type=\"text\" id=\"xssreflected\" name=\"xssreflected\">";
            echo "</div>";
            echo "<div>";
            echo "<button type=\"submit\">Submit</button>";
            echo "</div>";
            echo "</form>";
        }
        if (isset($_POST['xssreflected']) && $_POST['xssreflected'] == "reflectedkey") {
            echo "<h2>CTF Completed</h2>";
        }
    ?>

</body>
</html>