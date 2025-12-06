<?php
 /**
  * Solution input: 
  *  <script>
  *      function getCookie(cname) {
  *          let name = cname + "=";
  *          let decodedCookie = decodeURIComponent(document.cookie);
  *          let ca = decodedCookie.split(';');
  *          for (let i = 0; i < ca.length; i++) {
  *              let c = ca[i];
  *              while (c.charAt(0) == ' ') {
  *              c = c.substring(1);
  *              }
  *              if (c.indexOf(name) == 0) {
  *              return c.substring(name.length, c.length);
  *              }
  *          }
  *          return "";
  *      }
  *      console.log(getCookie("findme"));
  *  </script>
  */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>DOM XSS</title>
</head>
<?php
$cookie_name = "findme";
$cookie_value = "xss_key_aj";

// Set the expiration time (1 day)
$expiration_time = time() + (86400); 

// Set the cookie
setcookie($cookie_name, $cookie_value, $expiration_time, "/");

// check query parameter
if (isset($_GET['tryMe'])) {
    $value = 0;
} else {
    header('Location: http://localhost:8000/domxss.php?tryMe=Your%20Guess%20Here');
    exit; // Important: terminate the script after the redirect
}
?>
<body>
    <h1>Find the cookie</h1>
    <p style="color: white;">Hint: 'findme'</p>
    <form action="" method="get">
        <label for="query">Guesses:</label>
        <input type="text" id="query" name="tryMe">
        <input type="submit" value="Submit">
    </form>
    <?php
        echo "<h2>" . $_GET['tryMe'] . "</h2>";
    ?>
    
</body>
</html>