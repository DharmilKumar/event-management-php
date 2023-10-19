<?php
require_once 'conn.php';

if (isset($_GET['updateid'])) {
    $updateid = $_GET['updateid'];
}
$sql1 = "SELECT * FROM match_regteam WHERE id=$updateid";

$result = mysqli_query($conn, $sql1);
while ($row = mysqli_fetch_assoc($result)) {
    $id1 = $row['id'];
    $name = $row['reg_event_name'];
    $tname = $row['reg_team_name'];
    $prize = $row['reg_prize'];
    $date = $row['reg_date'];
    $vanue = $row['reg_vanue'];
    $status = $row['status'];
}



?>

<!DOCTYPE html>
<html>

<head>
    <style>
        .m {
            color: red;
        }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>
    <?php require_once 'admin_head.php';
    require_once 'conn.php';

    $admin_id = $_SESSION['id_admin'];
    if ($admin_id == 'a') {

        if (isset($_GET['updateid'])) {
            $updateid = $_GET['updateid'];
        }
        if (isset($_POST['submit'])) {
            $status = $_POST['status'];

            $sql = "UPDATE match_regteam set status='$status' WHERE id=$updateid";

            if ($conn->query($sql)) {
                echo '<script language="javascript">';
                echo 'alert("Successfully Status Updated"); location.href="reg_team.php"';
                echo '</script>';
            } else {
                echo "error while Updating data " . $conn->error;
            }
        }
    } else {
        echo '<script language="javascript">';
        echo 'alert("Please Login First"); location.href="user_login.php"';
        echo '</script>';
    }
    ?>
    <div class="card mx-auto mt-5" style="width: 30rem;">
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="name" class="form-label">Event Name</label>
                    <input value="<?php echo $name; ?>" type="text" class="form-control" id="name" name="name" disabled>
                </div>
                <div class="mb-3">
                    <label for="tname" class="form-label">Register Team Name</label>
                    <input value="<?php echo $tname; ?>" type="text" class="form-control" id="tname" name="tname" disabled>
                </div>
                <div class="mb-3">
                    <label for="prize" class="form-label">Prize Pool</label>
                    <input type="number" value="<?php echo $prize; ?>" class="form-control " id="prize" name="prize" disabled>
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" value="<?php echo $date; ?>" class="form-control" id="date" name="date" disabled>
                </div>
                <div class="mb-3">
                    <label for="vanue" class="form-label">Place</label>
                    <input type="text" class="form-control" value="<?php echo $vanue; ?>" id="vanue" name="vanue" disabled>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Change Status</label>
                    <select class="dropdown show form-control" name="status">
                        <option class="dropdown-menu " value="Panding" id="status">Panding</option>
                        <option class="dropdown-item" value="Rejected" id="status">Rejected</option>
                        <option class="dropdown-item" value="Approved" id="status">Approved</option>
                    </select>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Change Status</button>
            </form>
        </div>
    </div>

</body>

</html>