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

    <form action="pa_add_package.php" method="post" class="form-container">
        <label for="pa_typ">Typ</label>
            <select id="pa_typ" name="pa_typ" required>
                <option value="webspace">Webspace</option>
                <option value="domain">Domain</option>
            </select><br><br>
        <label for="pa_product_name">Paketname</label>
        <input type="text" id="pa_product_name" name="pa_product_name">
        <label for="pa_default_quota">Quota <i>[nur bei Webspace]</i></label>
        <input type="text" id="pa_default_quota" name="pa_default_quota">
        <input type="submit" name="submit" value="Paket anlegen"><br>
    </form>
    </body>
</html>