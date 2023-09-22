<?php
    
    $hostname = "localhost";
    $username = "admin";
    $password = "Passw0rd";
    $db = "mynet_test";

    $dbconnect = mysqli_connect($hostname, $username, $password, $db);

    if ($dbconnect->connect_error) {
        die("Database connection failed: " . $dbconnect->connect_error);
    }

    if (isset($_POST['we_user']) && !empty($_POST['we_user'])) {
        // Die ID des zu bearbeitenden Datensatzes aus dem Formular erhalten
        $we_user = $_POST['we_user'];

        // Abfrage, um den gewünschten Datensatz abzurufen
        $sql = "SELECT * FROM webs WHERE we_user = '$we_user'";
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
    
    <form action="we_update.php" method="post" class="form-container">
        <label><h2>Eintrag bearbeiten</h2><br><h3><?php echo $row['we_user']; ?></h3></label><br>
        <input type="hidden" name="we_user" value="<?php echo $row['we_user']; ?>">

        <label for="server">Server:</label>
        <input type="text" name="we_server" value="<?php echo $row['we_server']; ?>"><br>

        <label for="internal_hostaddress">Interne Hostadresse:</label>
        <input type="text" name="we_internal_hostaddress" value="<?php echo $row['we_internal_hostaddress']; ?>"><br>

        <label for="maintainer">Maintainer:</label>
        <input type="text" name="we_maintained_by" value="<?php echo $row['we_maintained_by']; ?>"><br>

        <label for="quota">Quota:</label>
        <input type="text" name="we_quota" value="<?php echo $row['we_quota']; ?>"><br>

        <label for="phpvers">PHP-Version:</label>
        <input type="text" name="we_php_vers" value="<?php echo $row['we_php_vers']; ?>"><br>

        <label for="creation_date">Erstelldatum:</label>
        <input type="date" name="we_creation_date" value="<?php echo $row['we_creation_date']; ?>"><br>

        <label for="online">Online:</label>
        <input type="text" name="we_is_online" value="<?php echo $row['we_is_online']; ?>"><br>

        <label for="activation_date">aktiv seit:</label>
        <input type="date" name="we_online_since" value="<?php echo $row['we_online_since']; ?>"><br>

        <label for="comment">Kommentar:</label>
        <input type="text" name="we_comment" value="<?php echo $row['we_comment']; ?>"><br>

        <input type="submit" value="Speichern">
    </form>
</body>
</html>