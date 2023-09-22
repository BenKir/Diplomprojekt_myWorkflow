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
    if (isset($_POST['do_id']) && !empty($_POST['do_id'])) {
        // Die ID des zu bearbeitenden Datensatzes aus dem Formular erhalten
        $do_id = $_POST['do_id'];

        // Die Werte aus den Textfeldern im Formular abrufen
        $domain_name = $_POST['do_domain_name'];
        $creation_date = $_POST['do_creation_date'];
        $webspace = $_POST['we_user'];

        // UPDATE-Abfrage, um den Datensatz zu aktualisieren     
        if (!empty($webspace)) {
            $sql = "UPDATE domains SET
            do_name = '$domain_name',
            do_creation_date = '$creation_date',
            we_user = '$webspace'
            WHERE do_id = $do_id";
        }
        else {
            $sql = "UPDATE domains SET
            do_name = '$domain_name',
            do_creation_date = '$creation_date',
            we_user = NULL
            WHERE do_id = $do_id";
        }
        
        $redirect_url = "do_show.php";
        header("Location: " . $redirect_url);

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