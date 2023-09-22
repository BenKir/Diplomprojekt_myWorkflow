<?php
    include("header.html");
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="login.php" method="post">
        username:<br>
        <input type="text" name="username"><br>
        oder email:<br>
        <input type="text" name="email"><br>
        passwort:<br>
        <input type="password" name="passwort"><br>
    
        <input type="submit" name="login" value="login">
    </form>

<?php
    
    if(isset($_POST["login"]))
    {
        //filter um sql injections auszuschließen
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

       //filter um ausschließlich valide emails zu akzeptieren
       $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);

        if(empty($username) && empty($email))
        {
            echo "Bitte geben Sie einen Benutzernamen oder eine E-Mail-Adresse ein! <br>";
        }
        else
        {
            echo "Hello: {$username} <br>";
            echo "your email is: {$email} <br>";
        }
       
        $password = filter_input(INPUT_POST, "passwort", FILTER_SANITIZE_SPECIAL_CHARS);

        if(!empty($username) || !empty($email)) {
            if(!empty($password)) {
                // Wir verwenden hier ein fest codiertes Passwort nur zu Demonstrationszwecken.
                // In einer echten Anwendung sollten Sie das gespeicherte gehashte Passwort aus Ihrer Datenbank abrufen.
                $correct_password_hash = password_hash("pizza123", PASSWORD_DEFAULT);

                if(password_verify($password, $correct_password_hash)) 
                {
                    //echo "Willkommen bei myWorkflow!";
                    header("Location: index.php");
                    exit;  
                } 
                else 
                {
                    echo "Falsches Passwort!";
                }
            } 
            else 
            {
                echo "Bitte geben Sie ein Passwort ein!";
            }
        }
    }

?>
</body>
</html>

<?php
    include("footer.html");
?>
