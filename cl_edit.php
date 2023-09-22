<?php
    
    $hostname = "localhost";
    $username = "admin";
    $password = "Passw0rd";
    $db = "mynet_test";

    $dbconnect = mysqli_connect($hostname, $username, $password, $db);

    if ($dbconnect->connect_error) {
        die("Database connection failed: " . $dbconnect->connect_error);
    }

    if (isset($_POST['cl_id']) && !empty($_POST['cl_id'])) {
        // Die ID des zu bearbeitenden Datensatzes aus dem Formular erhalten
        $cl_id = $_POST['cl_id'];

        // Abfrage, um den gewünschten Datensatz abzurufen
        $sql = "SELECT * FROM clients WHERE cl_id = $cl_id";
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
    
    <form action="cl_update.php" method="post" class="form-container">
        <label><h2>Eintrag bearbeiten</h2></label><br>
        <input type="hidden" name="cl_id" value="<?php echo $row['cl_id']; ?>">
        <label for="firstname">Vorname:</label>
        <input type="text" name="cl_firstname" value="<?php echo $row['cl_firstname']; ?>"><br>
        <label for="lastname">Nachname:</label>
        <input type="text" name="cl_lastname" value="<?php echo $row['cl_lastname']; ?>"><br>
        <label for="street">Straße:</label>
        <input type="text" name="cl_street" value="<?php echo $row['cl_street']; ?>"><br>
        <label for="zip">PLZ:</label>
        <input type="text" name="cl_zip" value="<?php echo $row['cl_zip']; ?>"><br>
        <label for="city">Stadt:</label>
        <input type="text" name="cl_city" value="<?php echo $row['cl_city']; ?>"><br>
        <label for="phonenumber">Telefonnummer:</label>
        <input type="text" name="cl_phonenumber" value="<?php echo $row['cl_phonenumber']; ?>"><br>
        <label for="email">Email:</label>
        <input type="text" name="cl_email" value="<?php echo $row['cl_email']; ?>"><br>
        <label for="is_reseller">Reseller:</label>
        <input type="text" name="cl_is_reseller" value="<?php echo $row['cl_is_reseller']; ?>"><br>
        <label for="is_maintainer">Maintainer:</label>
        <input type="text" name="cl_is_maintainer" value="<?php echo $row['cl_is_maintainer']; ?>"><br>
        <label for="uid">UID:</label>
        <input type="text" name="cl_uid" value="<?php echo $row['cl_uid']; ?>"><br>
        <input type="submit" value="Speichern">
    </form>
</body>
</html>