<?php 
$hint = isset($_GET['hint']) ? intval($_GET['hint']) : 0;
?>
<!DOCTYPE html>
<html>
<head>
    <title>WAF SQL Injection – Hints</title>
    <style>
        body { background:#0b0b0b; color:#00aaff; font-family:Consolas; padding:20px; }
        .box { background:#1a1a1a; padding:20px; border-radius:8px; margin-top:20px; }
        button { background:#00aaff; color:#000; padding:10px; border:none; cursor:pointer; margin-top:20px; }
        button:hover { opacity:0.8; }
        pre { color:#00ccff; font-size:18px; white-space:pre-wrap; }
    </style>
</head>
<body>

<h1>WAF SQL Injection – Hints</h1>

<div class="box">
<?php if ($hint === 0): ?>

    <h2>No Hint Yet</h2>
    <p>Try the challenge first to unlock hints.</p>

<?php elseif ($hint === 1): ?>

    <h2>Hint #1 – Try Single-Encoding</h2>
    <p>The WAF blocks literal quotes and classic injections.</p>
    <p>Encode your quote as <code>%27</code> and try the <strong>full injection</strong>:</p>

    <pre>%27 OR %271%27=%271%27--</pre>

    <p>This is the full payload you should enter as the <strong>username</strong>.</p>

<?php elseif ($hint === 2): ?>

    <h2>Hint #2 – Try Double-Encoding</h2>
    <p>The WAF is detecting single-encoded attempts.</p>
    <p>Some WAFs decode only once. Try <strong>double-encoding</strong> your '%' sign:</p>
    <pre>%2527</pre>

    <p>Use the <strong>full payload</strong> below to bypass the WAF:</p>

    <pre>%2527%20OR%20%25271%2527=%25271%2527--</pre>

    <p>This will double-decode back to the valid SQL injection and bypass the simplistic firewall.</p>

<?php endif; ?>
</div>

<button onclick="location.href='wafbased.php'">Back to Challenge</button>

</body>
</html>
