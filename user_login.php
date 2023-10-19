<!DOCTYPE html>
<html>

<head>
    <style>
        .w{
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
        require_once 'conn.php'; 
        
        require_once 'nav.php';

        $email = $emailErr = $password = $passwordErr =  "";
        session_start();
      
        if (isset($_POST['submit'])) {
            $date =  date('Y-m-d');
            $sqldel = "DELETE FROM match_events WHERE date<'$date'";
            $conn->query($sqldel);
            
            $sqldel1 = "DELETE FROM match_regteam WHERE reg_date<'$date'";
            $conn->query($sqldel1);


            if (empty($_POST['email'])) {
                $emailErr = "Please Enter Email";
            } else {
                $email = $_POST["email"];
            }
            if (empty($_POST['password'])) {
                $passwordErr = "Please Enter Password";
            } else {
                $password = $_POST["password"];
               
            }
            if (!empty($email) && !empty($password)) {
                $query = "SELECT user_email,user_name,user_pass,id FROM match_mngmt WHERE user_email='$email'";
                $result = mysqli_query($conn,$query);
                $row = mysqli_fetch_assoc($result);
                
                
                if (mysqli_num_rows($result) > 0) {
                    $id = $row['id'];
                    $username = $row['user_name'];
                    $pass_hash = $row['user_pass'];
                    $emailTry = $row['user_email'];
                    $pass_verify = password_verify($password,$pass_hash);
                    if($pass_verify == $password && $emailTry == $email){
                        
                        $_SESSION['id_session'] = $id;
                        $_SESSION['usersession'] = $username;
                        echo "<script type='text/javascript'>alert('Login Successful');window.location='user_head.php'</script>";
                        // setcookie('id_cookie', "$id", time() + 86400);    
                    }else{
                        echo '<script language="javascript">';
                        echo 'alert("Password not match!")';
                        echo '</script>';
                    }
                }elseif($password=='Admin2' && $email=='admin2@gmail.com'){
                        $_SESSION['id_admin'] = 'a';
                        echo "<script type='text/javascript'>alert('Admin Login Successful');window.location='admin_head.php'</script>";
                    
                } else {
                    echo '<script language="javascript">';
                    echo 'alert(" Email not match!")';
                    echo '</script>';
                }
            }
        }
        ?>
        <div class="card mx-auto mt-5" style="width: 30rem;">
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                        <span class="w"><?php echo $emailErr?></span>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <span class="w"><?php echo $passwordErr?></span>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </body>

</html>