<?php
    require_once 'conn.php';
    session_start();
    $admin_id = $_SESSION['id_admin'];
    if($admin_id == 'a'){
    if(isset($_GET['deleteid'])){
        $id = $_GET['deleteid'];
        $sql = "DELETE FROM match_events where id=$id";
        if ($conn->query($sql) == true) {
            echo '<script language="javascript">';
            echo 'alert("Successfully Deleted"); location.href="show_all_events.php"';
            echo '</script>';
        } else {
            echo "error while inserting data " . $conn->error;
        }
    }
}else{echo '<script language="javascript">';
    echo 'alert("Please Login First"); location.href="user_login.php"';
    echo '</script>';}
?>