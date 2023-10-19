<?php
    require_once 'conn.php';

    $sql = "CREATE TABLE match_regteam (
        id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
        reg_team_name VARCHAR (50) NOT NULL,
        reg_team_logo VARCHAR (600),
        reg_team_user VARCHAR (50),
        reg_event_name VARCHAR (60),
        reg_vanue VARCHAR (20)
    )";

    if($conn->query($sql)==true){
        echo "<h3>Table created successfully</h3>";
    }else{
        echo "Error while creating table ".$conn->error;
    }
?>