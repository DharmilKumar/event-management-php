<?php
    require_once 'conn.php';

    $sql = "CREATE TABLE match_events(
        id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
        name VARCHAR (50) NOT NULL,
        price VARCHAR (50),
        date VARCHAR (60),
        vanue VARCHAR (20)
    )";

    if($conn->query($sql)==true){
        echo "<h3>Table created successfully</h3>";
    }else{
        echo "Error while creating table ".$conn->error;
    }
?>