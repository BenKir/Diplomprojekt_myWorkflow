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
        // Die ID des zu bearbeitenden Datensatzes aus dem Formular erhalten
        $pa_id = $_POST['pa_id'];

        // Die Werte aus den Textfeldern im Formular abrufen
        $package_name = $_POST['package_name'];
        $quota = $_POST['quota'];

        // UPDATE-Abfrage, um den Datensatz zu aktualisieren     
        if (!empty($quota)) {
            $sql = "UPDATE packages SET
            pa_product_name = '$package_name',
            pa_default_quota = '$quota'
            WHERE pa_id = $pa_id";
        }
        else {
            $sql = "UPDATE packages SET
            pa_product_name = '$package_name',
            pa_default_quota = NULL
            WHERE pa_id = $pa_id";
        }
        
        //$redirect_url = "pa_show.php";
        //header("Location: " . $redirect_url);

        if (mysqli_query($dbconnect, $sql)) {
            echo "Datensatz wurde erfolgreich aktualisiert.";
        } else {
            echo "Fehler beim Aktualisieren des Datensatzes: " . mysqli_error($dbconnect);
        }
    } else {
        echo "Ungültige Anfrage.";
    }

    // Schließe die Verbindung zur Datenbank
    mysqli_close($dbconnect);
    exit();
?>