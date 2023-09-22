<?php
    
    $hostname = "localhost";
    $username = "admin";
    $password = "Passw0rd";
    $db = "mynet_test";

    $dbconnect = mysqli_connect($hostname, $username, $password, $db);

    if ($dbconnect->connect_error) {
        die("Database connection failed: " . $dbconnect->connect_error);
    }

    if (isset($_POST['pa_id']) && !empty($_POST['pa_id'])) {
        // Die ID des zu bearbeitenden Datensatzes aus dem Formular erhalten
        $pa_id = $_POST['pa_id'];

        // Abfrage, um den gewünschten Datensatz abzurufen
        $sql = "SELECT * FROM packages WHERE pa_id = $pa_id";
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
    
    <form action="pa_update.php" method="post" class="form-container">
        <label><h2>Eintrag bearbeiten</h2></label><br>
        <input type="hidden" name="pa_id" value="<?php echo $row['pa_id']; ?>">
        
        <label for="package_name">Paketname:</label>
        <input type="text" name="package_name" value="<?php echo $row['pa_product_name']; ?>"><br>

        <label for="quota">Quota:</label>
        <input type="text" name="quota" value="<?php echo $row['pa_default_quota']; ?>"><br>

        <input type="submit" value="Speichern">
    </form>
</body>
</html>