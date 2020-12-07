<?php
    require_once('db_login.php');
    if (isset($_GET['submit'])){
        $valid = TRUE;
        $name = test_input($_GET['name']);
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
        $address = test_input($_GET['address']);
        if ($address == ''){
            echo '<script type="text/JavaScript">  
            alert("Address is required");
            </script>';
            $valid = FALSE;
        }
        $city = test_input($_GET['city']);
        if ($city == ''){
            echo '<script type="text/JavaScript">  
            alert("city is required");
            </script>';
            $valid = FALSE;
        }
        $email = test_input($_GET['email']);
        if ($email == ''){
            echo '<script type="text/JavaScript">  
            alert("Email is required");
            </script>';
            $valid = FALSE;
        }
        $phone = test_input($_GET['phone']);
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
        $password = test_input($_GET['password']);
        if ($password == ''){
            echo '<script type="text/JavaScript">  
            alert("Password is required");
            </script>';
            $valid = FALSE;
        }
        $confirm = test_input($_GET['confirm']);
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
                echo '<div class="alert alert-success alert-dismissible">
                <strong>Success!</strong> Data has been added.<br></div>';
                $db->close();
                header('Location: wick.html');
            }
        }
    }
?>
<script src="ajax.js"></script>