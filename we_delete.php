<?php
    
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $db = "mynet_test";

    $dbconnect = mysqli_connect($hostname, $username, $password, $db);

    if ($dbconnect->connect_error) {
        die("Database connection failed: " . $dbconnect->connect_error);
    }
    
    // Überprüfe, ob das Formular gesendet wurde und die ID gesetzt ist
    if (isset($_POST['we_user']) && !empty($_POST['we_user'])) {
        // Die ID des zu löschenden Datensatzes aus dem Formular erhalten
        $we_user = $_POST['we_user'];

        // Führe die DELETE-Abfrage aus, um den Datensatz zu löschen
        $sql = "DELETE FROM webs WHERE we_user = '$we_user'";

        //$redirect_url = "we_show.php";
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