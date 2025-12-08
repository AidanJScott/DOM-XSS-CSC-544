<?php
require 'database_connect.php';

function waf_block($input) {

    // Allow DOUBLE-ENCODED quotes → bypass trick
    if (strpos($input, '%2527') !== false) {
        return false;
    }

    // Allow SINGLE encoded quotes, but still block others
    if (strpos($input, '%27') !== false) {
        return true;
    }

    // Block simple SQLi indicators, such as literal single quotes,
    // OR keyword with spaces, 1=1, and SQL comments.
    $patterns = [
        "/'/",              
        "/ or /i",          
        "/1\s*=\s*1/",      
        "/--/"              
    ];

    foreach ($patterns as $p) {
        if (preg_match($p, $input)) {
            return true;
        }
    }

    return false;
}

$blocked = false;
$success = false;
$invalid = false;
$query_shown = "";
$hint_level = 0;

if (isset($_GET['username']) && isset($_GET['password'])) {

    $u_raw = $_GET['username'];
    $p_raw = $_GET['password'];

    // DOUBLE-DECODE to enable encoded bypass
    $u = urldecode(urldecode($u_raw));
    $p = urldecode(urldecode($p_raw));

    // Determine hint level
    if (strpos($u_raw, "' OR '1'='1") !== false) {
        $hint_level = 1; // Classic SQLi → now encode
    }
    else if (strpos($u_raw, "%27") !== false) {
        $hint_level = 2; // single encoding detected → now double encoding
    }

    // Check WAF rules
    if (waf_block($u_raw) || waf_block($p_raw)) {
        $blocked = true;

    } else {
        // Vulnerable query
        $query = "SELECT * FROM users WHERE name='$u' AND email='$p'";
        $query_shown = $query;

        $result = $pdo->query($query)->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $success = true;
            $key = "phrog";   // The key required for the CTF transition
        } else {
            $invalid = true;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>WAF-Based SQL Injection Challenge</title>
    <style>
        body { background:#0b0b0b; color:#00aaff; font-family:Consolas; padding:20px; }
        .box { background:#1a1a1a; padding:20px; border-radius:8px; }
        input { background:#000; color:#00aaff; border:1px solid #00aaff; padding:6px; width:260px; }
        button { background:#00aaff; color:#000; border:none; padding:10px; cursor:pointer; }
        button:hover { opacity:0.75; }
    </style>
</head>
<body>

<h1 style="color:#00aaff;">WAF-Based SQL Injection Challenge</h1>

<div class="box">
    <p>Your goal: <strong>bypass the WAF</strong> and retrieve the <strong>KEY</strong>.</p>
    <p>Try a basic SQL injection first.</p>
    <p>If it's blocked, click <strong>Show Hint</strong> to reveal guidance based on your last attempt.</p>
</div>

<br>

<!-- User input form -->
<form method="GET">
    <label>Username:</label><br>
    <input type="text" name="username"><br><br>

    <label>Password:</label><br>
    <input type="text" name="password"><br><br>

    <button type="submit">Submit</button>
</form>

<br>

<!-- Button for hint -->
<form action="waf_hints.php" method="get">
    <input type="hidden" name="hint" value="<?php echo $hint_level; ?>">
    <button type="submit">Show Hint</button>
</form>

<hr>

<!-- Showing the SQL query -->
<?php if ($query_shown): ?>
    <p><strong>Executed SQL:</strong></p>
    <pre style="color:#00ccff;"><?php echo htmlspecialchars($query_shown); ?></pre>
<?php endif; ?>

<!-- If blocked -->
<?php if ($blocked): ?>
    <p style="color:#ff3333;">Blocked by WAF.</p>
<?php endif; ?>

<!-- If invalid -->
<?php if ($invalid): ?>
    <p style="color:#ff3333;">Invalid login.</p>
<?php endif; ?>

<!-- If successful -->
<?php if ($success): ?>
    <h2 style="color:#00ffaa;">Success! WAF Bypassed!</h2>
    <p>Your key is:</p>
    <pre style="font-size:22px; color:#00ffaa;"><?php echo $key; ?></pre>
<?php endif; ?>

</body>
</html>
