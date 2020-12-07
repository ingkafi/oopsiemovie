<?php
session_start();
require_once('db_login.php');

if (isset($_POST["login"])){
    $valid=TRUE;
    $email = test_input($_POST['email']);
    if ($email == ''){
        echo '<script type="text/JavaScript">  
        alert("Email is required");
        </script>';
        $valid = FALSE;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo '<script type="text/JavaScript">  
        alert("Invalid email format");
        </script>';
        $valid = FALSE;
    }
    $password = test_input($_POST['password']);
    if ($password == ''){
        echo '<script type="text/JavaScript">  
        alert("Password is required");
        </script>';
        $valid=FALSE;
    }

    if($valid){
        $query = "SELECT * FROM penulis WHERE email='".$email."' AND password ='".$password."' ";
        $execution = mysqli_query($db, $query) or die(mysqli_error($db));
        if($result = mysqli_fetch_assoc($execution))
        {
                $_SESSION['penulis_id'] = $result['idpenulis'];
                $_SESSION['email'] = $result['email'];
                $_SESSION['username'] = $result['username'];
                $_SESSION['nama'] = $result['nama'];
                $_SESSION['idpenulis'] = $result['idpenulis'];
                $_SESSION['alamat'] = $result['alamat'];
                $_SESSION['kota'] = $result['kota'];
                $_SESSION['no_telp'] = $result['no_telp'];
                echo '<script>
                alert("Login success ! Redirecting to main page");
                location.replace("dashboard.php");
                </script>';
                exit;
            } else {
                echo '<script>
                alert("Combination of username and password are not correct");
                </script>';
            }
        }
        $db->close();
    }


if (isset($_POST["signup"])){
    echo '<script>
        location.replace("signup.php");
        </script>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="sb-admin-2.min.css" rel="stylesheet">
</head>

<script>
    var btn = document.getElementById('signup');
    btn.addEventListener('click', function() {
    document.location.href = 'signup.php';
});
</script>

<style>
    .btn {
        padding: 12px 24px;
        color: white;
        display: inline-block;
        border-radius: 4px;
    }
</style>


<body style="background-color:#e65c4f;">

  <div class="container">
  <br>
    <div class="row justify-content-center">
      <div class="col-xl-5 col-lg-12">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <img src="../images/oopsie movie hitam.png" style="width:250px;"><br><br>
                    <h1 class="h4 text-gray-900 mb-4" style="font-weight:bold;">Selamat Datang Penulis !</h1><hr style="border-top: 2px solid black;">
                  </div>
                  <form class="user" method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Enter Email ..." value="<?php if(isset($email)) echo $email?>">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="login" value="Login">Login</button>
                    <button class="btn btn-danger btn-block" id="signup" name="signup" value="signup">Sign Up</button>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
</body>

</html>