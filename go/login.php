<?php
include_once 'config.php';

if (isset($_POST['submit'])) 
{
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $sql = "SELECT * FROM users WHERE name = '$name' and email = '$email'";

  $result = mysqli_query($conn, $sql);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1){  
            header('Location: index.html');  
        }  
        else{  
            echo "<script type='text/javascript'>alert('Check your credentials');</script>";
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
         .sign-form{   
              margin-top: 5%;
              margin-left: 25%;
              background: linear-gradient(0deg, #f17509 0%, #ffc000 100%);
              position: fixed;
              z-index: 1;
              width: 50%;
              display: flex;
              border-radius: 15px;
              box-shadow: 0px 1px 12px -1px;
            }
            .sign_div{
              background: #ffff;
              width: 50%;
              border-top-left-radius: 15px;
              border-bottom-left-radius: 15px;
            }
            .btn_btn_btn{
              background: linear-gradient(0deg, #f17509 0%, #ffc000 100%);
              border: none;
              outline: none;
              padding: 10px;
              border-radius: 5px;
              cursor: pointer;
              color: #ffff;
            }
            .btn_btn_btn:hover{
              background: linear-gradient(0deg, #ffc000 0%, #f17509 100%);
            }
            #sign{
              cursor: pointer;
              color: #f17509;
            }
            #sign:hover{
              opacity: 50%;
            }
      </style>

    </head>
<body>
     <div class="sign-form" id="sign-form" style="display:block;">
      <div>
        <div class="sign_div"> 
    <form action="" method="post" style="padding-left: 55px;padding-right: 55px;">
        <h4 style="padding-top: 15px;">Log in</h4>       
        <label for="name">Username</label><br>
          <input type="text" name="name" style="margin-bottom: 30px;width: 100%;" required><br>
        <label for="mail">Gmail</label><br>
          <input type="email" name="email" style="margin-bottom: 30px;width: 100%;" required><br>  
        <button class="btn_btn_btn"name="submit">Submit</button>
        <div style="display: flex; justify-content: space-between;padding-bottom: 20px;">
        <p style="font-size: 12px; color: blue;">I dont have a account</p>
        <p id="sign" onclick="creat()"><a href="signup.php">signup</a></p>
      </div>
    </form> 
</div>
</div>
</div>
</body>
</html>