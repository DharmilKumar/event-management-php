<!DOCTYPE html>
<html>

<head>
    <style>
        .w {
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

    <body>
        <?php 
        require_once 'admin_head.php';
        require_once 'conn.php';
        $admin_id = $_SESSION['id_admin'];
        if($admin_id=='a'){
        $name = $nameErr = $prize = $prizeErr = $date = $dateErr = $vanue = $vanueErrr = "";
        

        if (isset($_POST['submit'])) {
            $date =  date('Y-m-d');
            $sqldel = "DELETE FROM match_events WHERE date<'$date'";
            $conn->query($sqldel);
        

            if (empty($_POST['name'])) {
                $nameErr = "Please Enter Name";
            } else {
                $name = $_POST["name"];
                
            }
            if(empty($_POST['prize'])){
                $prizeErr = "Please Enter Prize Value";
            }else{
                $prize = $_POST['prize'];
            }
            if (empty($_POST['date'])) {
                $dateErr = "Please Enter date";
            } else {
                $date1 = $_POST["date"];
                if($date1<$date){
                    $dateErr = "Please Enter Valid Date";
                    $date1 = "";
                }else{
                    
                $date1 = $_POST["date"];
                }
            }
            if (empty($_POST['vanue'])) {
                $vanueErrr = "Please Enter Vanue";
            } else {
                $vanue = $_POST["vanue"];
            }

            
            if (!empty($name && !empty($prize) && !empty($date1) && !empty($vanue))) {
                $sql1 = mysqli_query($conn, "SELECT * FROM match_events WHERE date='$date1' AND name='$name' AND vanue='$vanue'");
                if (mysqli_num_rows($sql1) > 0) {
                    echo '<script language="javascript">';
                    echo 'alert("Event is already Created")';
                    echo '</script>';
                } else {
                        $sql = "INSERT INTO match_events (name,prize,date,vanue) VALUES ('$name',$prize,'$date1','$vanue');";
                        if ($conn->query($sql) == true) {
                            echo "<script type='text/javascript'>alert('Event Added!');window.location='show_all_events.php'</script>";
                        } else {
                            echo "error while inserting data " . $conn->error;
                        }
                    
                }
            }
        }
    }
    else{echo '<script language="javascript">';
        echo 'alert("Please Login First"); location.href="user_login.php"';
        echo '</script>';}
        ?>
        <div class="card mx-auto mt-5" style="width: 30rem;">
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Enter Event Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                        <span class="w"><?php echo $nameErr ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="prize" class="form-label">Enter Event Prize</label>
                        <input type="number" class="form-control" id="prize" name="prize">
                        <span class="w"><?php echo $prizeErr ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Select Event Date</label>
                        <input type="date" class="form-control" id="date" name="date">
                        <span class="w"><?php echo $dateErr ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="vanue" class="form-label">Enter Event Place</label>
                        <input type="text" class="form-control" id="vanue" name="vanue" >
                        <span class="w"><?php echo $vanueErrr ?></span>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
        
    </body>
</html>