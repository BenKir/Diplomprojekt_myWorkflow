<?php
    $firstname = "";
    $lastname = "";
    $street = "";
    $zip = "";
    $city = "";
    $phonenumber = "";
    $email = "";
    $taxuid = "";
    $is_reseller = 0;
    $is_maintainer = 0;
        
    if (isset($_POST["submit"])) {

        $firstname = trim($_POST["firstname"]);
        $lastname = trim($_POST["lastname"]);
        $street = trim($_POST["street"]);
        $zip = trim($_POST["zip"]);
        $city = trim($_POST["city"]);
        $phonenumber = trim($_POST["phonenumber"]);
        $email = trim($_POST["email"]);
        $taxuid = trim($_POST["uid"]);

        if (isset ($_POST["is_reseller"])) {
            $is_reseller = 1;
        }
        
        if (isset ($_POST["is_maintainer"])) {
            $is_maintainer = 1;
        }
    }
    
    if(empty($lastname) && empty($email)) {
        echo "<br>Nachname und Email-Adresse fehlt ... <br>";
    }
    elseif (empty($lastname)) {
        echo "<br>Nachname fehlt ... <br>";
    }
    elseif (empty($email)) {
        echo "<br>Email-Adresse fehlt ... <br>";
    }
    else {
        $redirect_url = "cl_show.php";
        header("Location: " . $redirect_url);
        
        $pdo = new PDO("mysql:host=localhost;dbname=mynet_test", "admin", "Passw0rd");
        
        
        $statement = $pdo->prepare("INSERT INTO clients (cl_firstname, cl_lastname, cl_street, cl_zip, cl_city, cl_phonenumber,
                                                cl_email, cl_is_reseller, cl_is_maintainer, cl_uid)
                                                VALUES
                                                (:firstname, :lastname, :street, :zip, :city, :phonenumber, :email, :is_reseller, :is_maintainer, :taxuid)");
        $statement->execute(array("firstname" => $firstname, 
                                    "lastname" => $lastname, 
                                    "street" => $street, 
                                    "zip" => $zip, 
                                    "city" => $city,
                                    "phonenumber" => $phonenumber,
                                    "email" => $email,
                                    "is_reseller" => $is_reseller,
                                    "is_maintainer" => $is_maintainer,
                                    "taxuid" => $taxuid));
        
    exit();
    }
            
?>