<?php
    
    $hostname = "localhost";
    $username = "admin";
    $password = "Passw0rd";
    $db = "mynet_test";

    $dbconnect = mysqli_connect($hostname, $username, $password, $db);

    if ($dbconnect->connect_error) {
        die("Database connection failed: " . $dbconnect->connect_error);
    }
    
    // Überprüfe, ob das Formular gesendet wurde und die ID gesetzt ist
    if (isset($_POST['pa_id']) && !empty($_POST['pa_id'])) {
        // Die ID des zu löschenden Datensatzes aus dem Formular erhalten
        $pa_id = $_POST['pa_id'];

        // Führe die DELETE-Abfrage aus, um den Datensatz zu löschen
        $sql = "DELETE FROM packages WHERE pa_id = $pa_id";

        //$redirect_url = "pa_show.php";
        //header("Location: " . $redirect_url);

        if (mysqli_query($dbconnect, $sql)) {
            echo "Datensatz wurde erfolgreich gelöscht.";
        } else {
            echo "Fehler beim Löschen des Datensatzes: " . mysqli_error($dbconnect);
        }
        
    }

    // Schließe die Verbindung zur Datenbank
    mysqli_close($dbconnect);
    exit();
?>