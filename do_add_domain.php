<?php
    $domain_name = "";
    $creation_date = "";
    $webspace = NULL;
  
        
    if (isset($_POST["submit"])) {

        $domain_name = trim($_POST["domain_name"]);
        $creation_date = ($_POST["creation_date"]);
        if (!empty($_POST["webspace"]))
        {
            $webspace = $_POST["webspace"];
        }
    }
    
    if(empty($domain_name)) {
        echo "<br>Domain fehlt ... <br>";
    }
    else {
        $redirect_url = "do_show.php";
        header("Location: " . $redirect_url);
        
        $pdo = new PDO("mysql:host=localhost;dbname=mynet_test", "admin", "Passw0rd");
        
        
        $statement = $pdo->prepare("INSERT INTO domains (do_name, do_creation_date, we_user)
                                                VALUES
                                                (:domain_name, :creation_date, :webspace)");
        $statement->execute(array("domain_name" => $domain_name, 
                                    "creation_date" => $creation_date, 
                                    "webspace" => $webspace));
    exit();
    }
            
?>