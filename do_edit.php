<?php
    
    $hostname = "localhost";
    $username = "admin";
    $password = "Passw0rd";
    $db = "mynet_test";

    $dbconnect = mysqli_connect($hostname, $username, $password, $db);

    if ($dbconnect->connect_error) {
        die("Database connection failed: " . $dbconnect->connect_error);
    }

    if (isset($_POST['do_id']) && !empty($_POST['do_id'])) {
        // Die ID des zu bearbeitenden Datensatzes aus dem Formular erhalten
        $do_id = $_POST['do_id'];

        // Abfrage, um den gewünschten Datensatz abzurufen
        $sql = "SELECT * FROM domains WHERE do_id = $do_id";
        $result = mysqli_query($dbconnect, $sql);

        // Überprüfe, ob ein Datensatz gefunden wurde
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        } else {
            echo "Datensatz nicht gefunden.";
            exit; // Beende das Skript, da kein Datensatz gefunden wurde
        }
    } else {
        echo "Ungültige Anfrage.";
        exit; // Beende das Skript, da keine ID übermittelt wurde
    }

    // Schließe die Verbindung zur Datenbank
    mysqli_close($dbconnect);
?>

<!DOCTYPE html>
<html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="styles.css">

    <title>project_statesolver_2.0</title>

</head>
<body>
    
    <form action="do_update.php" method="post" class="form-container">
        <label><h2>Eintrag bearbeiten</h2></label><br>
        <input type="hidden" name="do_id" value="<?php echo $row['do_id']; ?>">
        <label for="domain_name">Domain:</label>
        <input type="text" name="do_domain_name" value="<?php echo $row['do_name']; ?>"><br>
        <label for="creation_date">Registrierdatum:</label>
        <input type="date" name="do_creation_date" value="<?php echo $row['do_creation_date']; ?>"><br>
        <label for="we_user">Webspace:</label>
        <input type="text" name="we_user" value="<?php echo $row['we_user']; ?>"><br>

        <input type="submit" value="Speichern">
    </form>
</body>
</html>