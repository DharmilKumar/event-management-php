<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php require_once 'admin_head.php';

    require_once 'conn.php';
    $admin_id = $_SESSION['id_admin'];
    if($admin_id=='a'){
    $sql  = "SELECT * FROM match_regteam ORDER BY reg_date DESC";
    $result = mysqli_query($conn, $sql);
    }
    else{echo '<script language="javascript">';
        echo 'alert("Please Login First"); location.href="user_login.php"';
        echo '</script>';}
    ?>
    <h2 class="text-center">All the Events</h2>
    <table class="table mx-auto mt-5" style="width: 35rem;">
        <thead>
            <tr>
                <th scope="col">Event Name</th>
                <th scope="col">Team Name</th>
                <th scope="col">Team LOGO</th>
                <th scope="col">Prize Pool</th>
                <th scope="col">Date</th>
                <th scope="col">Vanue for Event</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php

                while ($row = mysqli_fetch_assoc($result)) {
                    $id1 = $row['id'];
                    $name = $row['reg_event_name'];
                    $img = $row['reg_team_logo'];
                    $tname = $row['reg_team_name'];
                    $prize = $row['reg_prize'];
                    $date = $row['reg_date'];
                    $vanue = $row['reg_vanue'];
                    $status = $row['status'];
                    echo '
                        <td>' . $name . '</td>
                        <td>' . $tname . '</td>
                        <td><img src="'.$img.'" width="100px"></td>
                        <td>' . $prize . '</td>
                        <td>' . $date . '</td>
                        <td>' . $vanue . '</td>
                        <td>' . $status . '</td>
                        <Td><button type="button" class="btn btn-primary"><a href="status_update.php?updateid=' . $id1 . '" class="text-light">Update</a></button></td>
                    ';
                ?>
            </tr>
        <?php

                }

        ?>
        </tbody>
    </table>
    
</body>

</html>