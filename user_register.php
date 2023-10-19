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
        require_once 'nav.php';
        require_once 'conn.php';


        $name = $nameErr = $tname = $tnameErr = $folder = $folderErr = $email = $emailErr = $contact = $contactErr = $password = $passwordErr = $hash = "";

        $emailReg = '/^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/';
        $nameReg = '/^[A-Za-z\s]+$/';
        $passReg = '/^(?=.*[A-Za-z])(?=.*\d)(?=.*[\W_]).{8,}$/';
        $contactReg = '/^\d{10}$/';


        if (isset($_POST['submit'])) {
            $filename = $_FILES["image"]["name"];
            $tempfile = $_FILES["image"]["tmp_name"];


            if (empty($_POST['name'])) {
                $nameErr = "Please Enter Name";
            } else {
                $name = $_POST["name"];
                if (!preg_match($nameReg, $name)) {
                    $nameErr = "Name must be alphabets only.";
                    $name = "";
                } else {
                    $name = $_POST['name'];
                }
            }
            if(empty($_POST['tname'])){
                $tnameErr = "Please Enter Team Name";
            }else{
                $tname = $_POST['tname'];
            }
            if (empty($filename = $_FILES["image"]["name"])) {
                $folderErr = "Please Select Image";
            } else {
                $folder = "images/" . $filename;
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $allowed =  array('jpeg', 'jpg', "png", "gif", "bmp", "JPEG", "JPG", "PNG", "GIF", "BMP");
                if (!in_array($ext, $allowed)) {
                    $folderErr = ".jpg .jpeg .png .gif .bmp only allowed!";
                    $folder = "";
                } else {
                    $folder = "images/" . $filename;
                }
            }
            if (empty($_POST['email'])) {
                $emailErr = "Please Enter Email";
            } else {
                $email = $_POST["email"];
                if (!preg_match($emailReg, $email)) {
                    $emailErr = "Please Enter Valid Email";
                    $email = "";
                } else {
                    $email = $_POST["email"];
                }
            }


            if (empty($_POST['password'])) {
                $passwordErr = "Please Enter Password";
            } else {
                $password = $_POST["email"];
                if (!preg_match($passReg, $password)) {
                    $passwordErr = "password has minimum 8 length and contains special character!";
                    $password = "";
                } else {
                    $password = $_POST["password"];
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                }
            }
            if (empty($_POST['contact'])) {
                $contactErr = "Please Enter Contact";
            } else {
                $contact = $_POST["contact"];
                if (!preg_match($contactReg, $contact)) {
                    $contactErr = "Contact must be 10 digits only!";
                    $contact = "";
                } else {
                    $contact = $_POST['contact'];
                }
            }

            if (!empty($name && !empty($tname) && !empty($folder) && !empty($email) && !empty($contact) && !empty($hash))) {
                $sql1 = mysqli_query($conn, "SELECT user_email FROM match_mngmt WHERE user_email='$email'");
                if (mysqli_num_rows($sql1) > 0) {
                    echo '<script language="javascript">';
                    echo 'alert("Email Id already exists")';
                    echo '</script>';
                } else {
                    move_uploaded_file($tempfile, $folder);
                        $sql = "INSERT INTO match_mngmt(user_name,team_name,team_logo,user_email,user_pass,contact) VALUES ('$name','$tname','$folder','$email','$hash',$contact);";
                        if ($conn->query($sql) == true) {
                            echo "<script type='text/javascript'>alert('Registration Successful');window.location='user_login.php'</script>";
                        } else {
                            echo "error while inserting data " . $conn->error;
                        }
                    
                }
            }
        }
        ?>
        <div class="card mx-auto mt-5" style="width: 30rem;">
            <div class="card-body">
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Enter Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                        <span class="w"><?php echo $nameErr ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="tname" class="form-label">Enter Team Name</label>
                        <input type="text" class="form-control" id="tname" name="tname">
                        <span class="w"><?php echo $tnameErr ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Select Team LOGO</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <span class="w"><?php echo $folderErr ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                        <span class="w"><?php echo $emailErr ?></span>
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <span class="w"><?php echo $passwordErr ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="form-label">Enter Contact</label>
                        <input type="number" class="form-control" id="contact" name="contact">
                        <span class="w"><?php echo $contactErr ?></span>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>
    </body>

</html>