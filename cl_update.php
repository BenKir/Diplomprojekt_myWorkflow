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
        // Die ID des zu bearbeitenden Datensatzes aus dem Formular erhalten
        $cl_id = $_POST['cl_id'];

        // Die Werte aus den Textfeldern im Formular abrufen
        $cl_firstname = $_POST['cl_firstname'];
        $cl_lastname = $_POST['cl_lastname'];
        $cl_street = $_POST['cl_street'];
        $cl_zip = $_POST['cl_zip'];
        $cl_city = $_POST['cl_city'];
        $cl_phonenumber = $_POST['cl_phonenumber'];
        $cl_email = $_POST['cl_email'];
        $cl_is_reseller = $_POST['cl_is_reseller'];
        $cl_is_maintainer = $_POST['cl_is_maintainer'];
        $cl_uid = $_POST['cl_uid'];

        // UPDATE-Abfrage, um den Datensatz zu aktualisieren
        $sql = "UPDATE clients SET
                cl_firstname = '$cl_firstname',
                cl_lastname = '$cl_lastname',
                cl_street = '$cl_street',
                cl_zip = '$cl_zip',
                cl_city = '$cl_city',
                cl_phonenumber = '$cl_phonenumber',
                cl_email = '$cl_email',
                cl_is_reseller = '$cl_is_reseller',
                cl_is_maintainer = '$cl_is_maintainer',
                cl_uid = '$cl_uid'
                WHERE cl_id = $cl_id";

        $redirect_url = "cl_show.php";
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