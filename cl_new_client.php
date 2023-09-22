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

    <form action="cl_add_client.php" method="post" class="form-container">
        <label for="firstname">Vorname</label>
        <input type="text" id="firstname" name="firstname">
        <label for="lastname">Nachname</label>
        <input type="text" id="lastname" name="lastname"><br>
        <label for="street">Strasse</label>
        <input type="text" id="street" name="street">
        <label for="zip">PLZ</label>
        <input type="text" id="zip" name="zip">
        <label for="city">Ort</label>
        <input type="text" id="city" name="city"><br>
        <label for="phonenumber">Telefonnummer</label>
        <input type="text" id="phonenumber" name="phonenumber">
        <label for="email">Email</label>
        <input type="text" id="email" name="email"><br>
        <label>Reseller</label>
        <input type="checkbox" name="is_reseller" id="is_reseller"><br>
        <label>Maintainer</label>
        <input type="checkbox" name="is_maintainer" id="is_maintainer"><br>
        <label for="uid">Steuernummer</label>
        <input type="text" id="uid" name="uid"><br>
        <input type="submit" name="submit" value="Kunde anlegen"><br>
    </form>
    </body>
</html>