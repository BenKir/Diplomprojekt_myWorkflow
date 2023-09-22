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
    if (isset($_POST['we_user']) && !empty($_POST['we_user'])) {
        // Die ID des zu bearbeitenden Datensatzes aus dem Formular erhalten
        $we_user = $_POST['we_user'];

        // Die Werte aus den Textfeldern im Formular abrufen
        $we_server = $_POST['we_server'];
        $we_internal_hostaddress = $_POST['we_internal_hostaddress'];
        $we_maintained_by = $_POST['we_maintained_by'];
        $we_quota = $_POST['we_quota'];
        $we_php_vers = $_POST['we_php_vers'];
        $we_creation_date = $_POST['we_creation_date'];
        $we_is_online = $_POST['we_is_online'];
        $we_online_since = $_POST['we_online_since'];
        $we_comment = $_POST['we_comment'];

        // UPDATE-Abfrage, um den Datensatz zu aktualisieren
        $sql = "UPDATE webs SET
                we_server = '$we_server',
                we_internal_hostaddress = '$we_internal_hostaddress',
                we_maintained_by = '$we_maintained_by',
                we_quota = '$we_quota',
                we_php_vers = '$we_php_vers',
                we_creation_date = '$we_creation_date',
                we_is_online = '$we_is_online',
                we_online_since = '$we_online_since',
                we_comment = '$we_comment',
                WHERE we_user = '$we_user'";

        //$redirect_url = "we_show.php";
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