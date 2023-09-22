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
    if (isset($_POST['cl_id']) && !empty($_POST['cl_id'])) {
        // Die ID des zu löschenden Datensatzes aus dem Formular erhalten
        $cl_id = $_POST['cl_id'];

        // Führe die DELETE-Abfrage aus, um den Datensatz zu löschen
        $sql = "DELETE FROM clients WHERE cl_id = $cl_id";

        $redirect_url = "cl_show.php";
        header("Location: " . $redirect_url);

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