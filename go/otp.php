<?php
include_once 'config.php';

if (isset($_POST['submit'])) 
{
  $code = $_POST['otp'];
 $sql = "SELECT * FROM users WHERE code = '$code'";

  $result = mysqli_query($conn, $sql);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1){  
            header('Location: login.php');  
        }  
        else{  
            echo "<script type='text/javascript'>alert('Please enter correct OTP');</script>";
        }
        }     
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bookme</title>
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="icon" href="favicon.ico" type="image/ico">
    <link rel="stylesheet" href="styles/vendor.css">
    <link rel="stylesheet" href="styles/main.css">

	<style type="text/css">
            .login-form{   
              margin-top: 5%;
              margin-left:25%;
              background: linear-gradient(0deg, #f17509 0%, #ffc000 100%);
              position: fixed;
              z-index: 1;
              width: 50%;
              display: flex;
              border-radius: 15px;
              box-shadow: 0px 1px 12px -1px;
            }
            .login_div{
              background: #ffff;
              width: 50%;
              border-top-left-radius: 15px;
              border-bottom-left-radius: 15px;
            }
            .btn_btn{
              background: linear-gradient(0deg, #f17509 0%, #ffc000 100%);
              border: none;
              outline: none;
              padding: 10px;
              border-radius: 5px;
              cursor: pointer;
              color: #ffff;
            }
            .btn_btn:hover{
              background: linear-gradient(0deg, #ffc000 0%, #f17509 100%);
            }
            #login{
              cursor: pointer;
              color: #f17509;
            }
            #login:hover{
              opacity: 50%;
            }
        </style>

</head>
<body>

	<div class="login-form" id="login-form" style="display:block;">
  <div class="login_div">   
<div>
    <form action="" method="post" style="padding-left: 55px;padding-right: 55px; padding-top: 50px; padding-bottom: 50px;">
        <label for="name">Enter OTP</label><br>
          <input type="number" name="otp" id="name" style="margin-bottom: 30px;width: 100%;"><br>
        <button class="btn_btn" name="submit">Submit</button>
      </div>
    </form>
  </div>
</div>
</div>
</body>
</html>