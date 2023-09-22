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
        $username = "admin";
        $password = "Passw0rd";
        $db = "mynet_test";

        $dbconnect = mysqli_connect($hostname, $username, $password, $db);

        if ($dbconnect->connect_error) {
            die("Database connection failed: " . $dbconnect->connect_error);
        }
    ?>

    <table class="styled-table">
        <tr>
            <th>Webuser</th>
            <th>Server</th>
            <th>Interne Hostadresse</th>
            <th>betreut von</th>
            <th>Quota</th>
            <th>PHP-Version</th>
            <th>Erstelldatum</th>
            <th>in Verrechnung</th>
            <th>Online seit</th>
            <th>Kommentar</th>
            <th></th>
            <th></th>
        </tr>
    
    <br>

    <?php
    $query = mysqli_query($dbconnect, "SELECT * FROM webs")
        or die (mysqli_error($dbconnect));

    while ($row = mysqli_fetch_array($query)) {
        echo
        "<tr>
            <td>{$row['we_user']}</td>
            <td>{$row['we_server']}</td>
            <td>{$row['we_internal_hostaddress']}</td>
            <td>{$row['we_maintained_by']}</td>
            <td>{$row['we_quota']}</td>
            <td>{$row['we_php_vers']}</td>
            <td>{$row['we_creation_date']}</td>
            <td>{$row['we_is_online']}</td>
            <td>{$row['we_online_since']}</td>
            <td>{$row['we_comment']}</td>
            <td>
            <form action='we_edit.php' method='post'>
                <input type='hidden' name='we_user' value='{$row['we_user']}'>
                <input type='submit' name='bearbeiten' value='Bearbeiten'>
            </form>
            </td>
            <td>
            <form action='we_delete.php' method='post'>
                <input type='hidden' name='we_user' value='{$row['we_user']}'>
                <input type='submit' name='loeschen' value='Löschen'>
            </form>
            </td>
        </tr>";
    }
    ?>
    </table>
</body>
</html>



</body>
</html>
