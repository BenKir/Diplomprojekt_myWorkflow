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
    <nav>
        <ul class="navbar">
            <li class="nav-item">
                <a href="#">Kunden</a>
                <ul class="dropdown-menu">
                    <li><a href="cl_new_client.php">neuer Kunde</a></li>
                    <li><a href="cl_show.php">Anzeigen</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#">Webspaces</a>
                <ul class="dropdown-menu">
                    <li><a href="we_new_webspace.php">Webspace anlegen</a></li>
                    <li><a href="we_show.php">Anzeigen</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#">Domains</a>
                <ul class="dropdown-menu">
                    <li><a href="do_new_domain.php#">Registrieren</a></li>
                    <li><a href="do_show.php">Anzeigen</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#">Packages</a>
                <ul class="dropdown-menu">
                <li><a href="pa_new_package.php">neues Paket</a></li>
                    <li><a href="pa_show.php">Anzeigen</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <br>

    <?php
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $db = "mynet_test";

        $dbconnect = mysqli_connect($hostname, $username, $password, $db);

        if ($dbconnect->connect_error) {
            die("Database connection failed: " . $dbconnect->connect_error);
        }
    ?>

    <table class="styled-table">
        <tr>
            <th>Vorname</th>
            <th>Nachname</th>
            <th>Strasse</th>
            <th>PLZ</th>
            <th>Ort</th>
            <th>Telefonnummer</th>
            <th>Email-Adresse</th>
            <th>Reseller</th>
            <th>Maintainer</th>
            <th>Steuernummer</th>
            <th></th>
            <th></th>
        </tr>
    
    <?php
    $query = mysqli_query($dbconnect, "SELECT * FROM clients")
        or die (mysqli_error($dbconnect));

    while ($row = mysqli_fetch_array($query)) {
        echo
        "<tr>
            <td>{$row['cl_firstname']}</td>
            <td>{$row['cl_lastname']}</td>
            <td>{$row['cl_street']}</td>
            <td>{$row['cl_zip']}</td>
            <td>{$row['cl_city']}</td>
            <td>{$row['cl_phonenumber']}</td>
            <td>{$row['cl_email']}</td>
            <td>{$row['cl_is_reseller']}</td>
            <td>{$row['cl_is_maintainer']}</td>
            <td>{$row['cl_uid']}</td>
            <td>
            <form action='cl_edit.php' method='post'>
                <input type='hidden' name='cl_id' value='{$row['cl_id']}'>
                <input type='submit' name='bearbeiten' value='Bearbeiten'>
            </form>
            </td>
            <td>
            <form action='cl_delete.php' method='post'>
                <input type='hidden' name='cl_id' value='{$row['cl_id']}'>
                <input type='submit' name='loeschen' value='Löschen'>
            </form>
            </td>
        </tr>";
    }
    ?>
    </table>
</body>
</html>
