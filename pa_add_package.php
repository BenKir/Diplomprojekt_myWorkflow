<?php
    $typ = "";
    $package_name = "";
    $quota = NULL;
  
        
    if (isset($_POST["submit"])) {

        $typ = trim($_POST["pa_typ"]);
        $package_name = trim($_POST["pa_product_name"]);
        
        if (!empty($_POST["pa_default_quota"]))
        {
            $quota = trim($_POST["pa_default_quota"]);
        }
    }
    
    if(empty($package_name)) {
        echo "<br>Paketname fehlt ... <br>";
    }
    else {
        $redirect_url = "pa_show.php";
        header("Location: " . $redirect_url);
        
        $pdo = new PDO("mysql:host=localhost;dbname=mynet_test", "admin", "Passw0rd");
        
        
        $statement = $pdo->prepare("INSERT INTO packages (pa_typ, pa_product_name, pa_default_quota)
                                                VALUES
                                                (:typ, :package_name, :quota)");
        $statement->execute(array("typ" => $typ, 
                                    "package_name" => $package_name, 
                                    "quota" => $quota));
    exit();
    }
            
?>