<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>
    <?php
    require_once 'conn.php';

    session_start();

    $userid = $_SESSION['id_session'];
    if ($userid > 0) {
        if (isset($_GET['registerid'])) {
            $regid = $_GET['registerid'];
        }
        $sql = "SELECT * FROM match_events WHERE id='$regid'";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ename = $row['name'];
                $eprize = $row['prize'];
                $edate = $row['date'];
                $evanue = $row['vanue'];
            }
        }
        $sql55 = "SELECT * FROM match_mngmt WHERE id='$userid'";
        $result55 = mysqli_query($conn, $sql55);
        if ($result55->num_rows > 0) {
            while ($row1 = $result55->fetch_assoc()) {
                $uname = $row1['user_name'];
                $teamlogo = $row1['team_logo'];
                $teamname = $row1['team_name'];
               
            }
        }
        if (!empty($teamname) && !empty($teamlogo) && !empty($uname) && !empty($ename)  && !empty($evanue) && !empty($edate) && !empty($eprize)) {
            $sql4 = mysqli_query($conn, "SELECT * FROM match_regteam WHERE reg_team_name='$teamname' AND reg_event_name='$ename'");

            if (mysqli_num_rows($sql4) > 0) {
                echo "<script type='text/javascript'>alert('You Already Registered');window.location='user_show_all_events.php'</script>";
            } else {
                $sql = "INSERT INTO match_regteam (reg_team_name,reg_team_logo,reg_team_user,reg_event_name,reg_vanue,reg_date,reg_prize,status) VALUES ('$teamname','$teamlogo','$uname','$ename','$evanue','$edate','$eprize','Panding');";
                if ($conn->query($sql)) {
                    echo "<script type='text/javascript'>alert('Event Registered');window.location='user_booked_event.php'</script>";
                } else {
                    echo "error " . $conn->error;
                }
            }
        } 
    } else {
        echo '<script language="javascript">';
        echo 'alert("Please Login First"); location.href="user_login.php"';
        echo '</script>';
    }
    ?>
</body>


</html>