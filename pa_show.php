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
            <th>Typ</th>
            <th>Produkt Name</th>
            <th>Quota</th>
            <th></th>
            <th></th>
        </tr>
    
    <?php
    $query = mysqli_query($dbconnect, "SELECT * FROM packages ORDER BY pa_typ ASC, pa_default_quota DESC")
        or die (mysqli_error($dbconnect));

    while ($row = mysqli_fetch_array($query)) {
        echo
        "<tr>
            <td>{$row['pa_typ']}</td>
            <td>{$row['pa_product_name']}</td>
            <td>{$row['pa_default_quota']}</td>
            <td>
            <form action='pa_edit.php' method='post'>
                <input type='hidden' name='pa_id' value='{$row['pa_id']}'>
                <input type='submit' name='bearbeiten' value='Bearbeiten'>
            </form>
            </td>
            <td>
            <form action='pa_delete.php' method='post'>
                <input type='hidden' name='pa_id' value='{$row['pa_id']}'>
                <input type='submit' name='loeschen' value='Löschen'>
            </form>
            </td>
        </tr>";
    }
    ?>
    </table>
</body>
</html>
