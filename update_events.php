<?php
require_once 'conn.php';

if (isset($_GET['updateid'])) {
    $updateid = $_GET['updateid'];
}
$sql1 = "SELECT * FROM match_events WHERE id=$updateid";

$result = mysqli_query($conn, $sql1);
while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $name = $row['name'];
    $prize = $row['prize'];
    $date = $row['date'];
    $vanue = $row['vanue'];
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
        $nameErr = $prizeErr = $dateErr = $vanueErrr = "";
        if (isset($_GET['updateid'])) {
            $updateid = $_GET['updateid'];
        }
        if (isset($_POST['submit'])) {
            if (empty($_POST['name'])) {
                $nameErr = "Please Enter Name";
            } else {
                $name = $_POST["name"];
            }
            if (empty($_POST['prize'])) {
                $prizeErr = "Please Enter Prize Value";
            } else {
                $prize = $_POST['prize'];
            }
            if (empty($_POST['date'])) {
                $dateErr = "Please Enter date";
            } else {
                $date = $_POST["date"];
            }
            if (empty($_POST['vanue'])) {
                $vanueErrr = "Please Enter Vanue";
            } else {
                $vanue = $_POST["vanue"];
            }


            if (!empty($name && !empty($prize) && !empty($date) && !empty($vanue))) {
                $sql = "UPDATE match_events set name='$name',prize=$prize,date='$date',vanue='$vanue' WHERE id=$updateid";

                if ($conn->query($sql)) {
                    echo '<script language="javascript">';
                    echo 'alert("Successfully Event Updated"); location.href="show_all_events.php"';
                    echo '</script>';
                } else {
                    echo "error while Updating data " . $conn->error;
                }
            } else {
                echo "error";
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
                    <label for="name" class="form-label">Enter Event Name</label>
                    <input value="<?php echo $name; ?>" type="text" class="form-control" id="name" name="name">
                    <span class="m"><?php echo $nameErr; ?></span>
                </div>
                <div class="mb-3">
                    <label for="prize" class="form-label">Enter Event Prize Pool</label>
                    <input type="number" value="<?php echo $prize; ?>" class="form-control " id="prize" name="prize">
                    <span class="m"><?php echo $prizeErr; ?></span>
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Select Event Date</label>
                    <input type="date" value="<?php echo $date; ?>" class="form-control" id="date" name="date">
                    <span class="w"><?php echo $dateErr ?></span>
                </div>
                <div class="mb-3">
                    <label for="vanue" class="form-label">Enter Event Place</label>
                    <input type="text" class="form-control" value="<?php echo $vanue; ?>" id="vanue" name="vanue">
                    <span class="w"><?php echo $vanueErrr ?></span>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

</body>

</html>