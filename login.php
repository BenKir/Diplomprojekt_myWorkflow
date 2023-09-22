<?php
    include("header.html");
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="login.php" method="post">
        username:<br>
        <input type="text" name="username oder eMail"><br>

        <input type="text" name="passwort"><br>
    
        <input type="submit" name="login" value="login">

    </form>
</body>
</html>

<?php
    //hashing a password for transforming sensitive data (passwörter)
    // beispiel evtl. zum testen

    //manuell gesetztes passwort "pizza123" später aus datenbank
    $password = "pizza123"; 

    $hash = password_hash($password, PASSWORD_DEFAULT);

    //hier wird die das passwort mit dem hashwert verglichen
    //wenn richtig dann login ansonsten falschen passwort
    if(password_verify("pizza123", $hash))
    {
        echo "Wilkommen bei myWorkflow";
    }
    else
    {
        echo "Falsches Passwort!";
    }


?>

<?php
    include("footer.html");
?>

