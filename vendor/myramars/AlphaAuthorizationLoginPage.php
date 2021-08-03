<?php
    if(isset($_POST["pwd"]) && $_POST["pwd"] == AppConfig::$ALPHA_CLOSED_LOGIN_PASSWORD) {
        setcookie("AlphaClosedTestLogin", "authorized=true", time()+3600); // one hour
        header("Refresh:0");
    }
?>
<html>
    <head>
        <title>Alpha authorization page</title>
    </head>
    <body>
        <h3>Unlock</h3>
        <form method="post">
            <input type="password" name="pwd" />
            <button type="submit">check</button>
        </form>
    </body>
</html>