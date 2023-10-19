<?php

    require_once 'conn.php';
    $sql = "CREATE TABLE match_mngmt(
        id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
        user_name VARCHAR (50) NOT NULL,
        team_name VARCHAR (50),
        team_logo VARCHAR (600),
        user_email VARCHAR (50),
        user_pass VARCHAR (50),
        contact VARCHAR(10)
    )";

    if($conn->query($sql)==true){
        echo "<h3>Table created successfully</h3>";
    }else{
        echo "Error while creating table ".$conn->error;
    }
