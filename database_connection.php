<?php

    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "mynet_test";
    //weiß nich ob man das .sql braucht
    $conn = "";

    echo "database status: <br>";

    try{
        $conn = mysqli_connect($db_server,
                                $db_user,
                                $db_pass,
                                $db_name);
        
        echo "Connected! <br>";
    }
    catch(mysqli_sql_exception)
    {
        echo "!!! Not connected with database!!! <br>";
    }

    //bereits so in cl_show:
    /*
        $hostname = "localhost";
        $username = "admin";
        $password = "Passw0rd";
        $db = "mynet_test";

        $dbconnect = mysqli_connect($hostname, $username, $password, $db);

        if ($dbconnect->connect_error) {
            die("Database connection failed: " . $dbconnect->connect_error);
        }
    */

    //mysqli_close($conn);

?>