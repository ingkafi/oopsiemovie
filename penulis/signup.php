<?php
require_once('db_login.php');
    if (isset($_POST['submit'])){
        $valid = TRUE;
        $name = test_input($_POST['name']);
        if ($name == ''){
            echo '<script>  
            alert("Name is required");
            </script>';
            $valid = FALSE;
        }
        elseif (!preg_match("/^[a-zA-Z ]*$/", $name)){
            echo '<script type="text/JavaScript">  
                alert("Only Letters and white space allowed");
                </script>';
            $valid = FALSE;
        }
        $address = test_input($_POST['address']);
        if ($address == ''){
            echo '<script type="text/JavaScript">  
            alert("Address is required");
            </script>';
            $valid = FALSE;
        }
        $city = test_input($_POST['city']);
        if ($city == ''){
            echo '<script type="text/JavaScript">  
            alert("city is required");
            </script>';
            $valid = FALSE;
        }
        $email = test_input($_POST['email']);
        if ($email == ''){
            echo '<script type="text/JavaScript">  
            alert("Email is required");
            </script>';
            $valid = FALSE;
        }
        $phone = test_input($_POST['phone']);
        if ($phone == ''){
            echo '<script type="text/JavaScript">  
            alert("Phone Number is required");
            </script>';
            $valid = FALSE;
        }
        elseif(strlen($phone)>13){
            echo '<script type="text/JavaScript">  
            alert("Must not more than 13 number");
            </script>';
            $valid = FALSE;
        }
        $password = test_input($_POST['password']);
        if ($password == ''){
            echo '<script type="text/JavaScript">  
            alert("Password is required");
            </script>';
            $valid = FALSE;
        }
        $confirm = test_input($_POST['confirm']);
        if ($password !== $confirm){
            echo '<script type="text/JavaScript">  
            alert("Password not match");
            </script>';
            $valid = FALSE;
        }   
        if($valid){
            $address = $db->real_escape_string($address);
            $query = "INSERT INTO penulis (nama,password,alamat,kota,email,no_telp) VALUES 
            ('".$name."','".$password."','".$address."','".$city."','".$email."','".$phone."')";
            $result = $db->query($query);
            if(!$result){
                die ("Could not query the database : <br/>" . $db->error. '<br>Query:'.$query);
            }
            else{
                $db->close();
                echo '<script>
                alert("Signup success ! Redirecting to main page");
                location.replace("login.php");
                </script>';
            }
        }
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
        
    <title>Sign up</title>
        
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        
    <link href="sb-admin-2.min.css" rel="stylesheet">
  </head>
    
<style>
  .label{
    color:black;
  }
  .center{
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>

<body style="background-image: url(https://prog-8.com/images/html/advanced/top_en.png); background-size: cover;">

  <div class="container">
  <br>
    <div class="row justify-content-center">
      <div class="col-xl-8 col-lg-12">
        <div class="card o-hidden border-0 shadow-lg my-5" style="background-color:honeydew ;">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4" style="font-size: 24px; font-weight: bold;">Buat Akun Baru</h1><hr style="border-top: 2px solid black;">
                  </div>
                  <form class="user" method="POST" autocomplete="on" action="">
                    <div class="form-group">
                      <label for="name" class="label">Name : </label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name ..." value="<?php if(isset($name)) echo $name?>">
                      <div class="error"><?php if(isset($error_name)) echo $error_name;?></div>
                    </div>
                    <div class="form-group">
                      <label for="email" class="label">Email : </label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email ..." value="<?php if(isset($email)) echo $email?>">
                    </div>
                    <div class="form-group">
                      <label for="address" class="label">Address : </label>
                      <textarea class="form-control" id="address" name="address" value="<?php if(isset($address)) echo $address?>"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="city" class="label">City : </label>
                      <input type="text" class="form-control" id="city" name="city" placeholder="Enter Your City ..." value="<?php if(isset($city)) echo $city?>">
                    </div>
                    <div class="form-group">
                      <label for="phone" class="label">Phone Number : </label>
                      <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter Your Phone Number ..." value="<?php if(isset($phone)) echo $phone?>">
                    </div>
                    <div class="form-group">
                      <label for="password" class="label">Password : </label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                    </div>
                    <div class="form-group">
                      <label for="confirm" class="label">Confirm Password : </label>
                      <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Confirm Password">
                    </div>
                    <div class="center">
                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                    </div>
                  </form>
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