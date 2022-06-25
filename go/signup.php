<?php
include_once 'config.php';


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;


require_once 'vendor/autoload.php';

$msg = "";

if (isset($_POST['submit'])) 
{
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, md5($_POST['password']));
  $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm-password']));
  $code = mysqli_real_escape_string($conn, (rand(100000,999999)));

   if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'")) > 0) {
            $msg = "<div class='alert alert-danger'>{$email} - This email address has been already exists.</div>";
        } else {
            if ($password === $confirm_password) {
                $sql = "INSERT INTO users (name, email, password, code) VALUES ('{$name}', '{$email}', '{$password}', '{$code}')";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    header('Location: otp.php');
                    $mail = new PHPMailer(true);

                    try {
                        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
                        $mail->isSMTP();                                            
                        $mail->Host       = 'smtp.gmail.com';                     
                        $mail->SMTPAuth   = true;                                   
                        $mail->Username   = 'bookme.onlinereservation@gmail.com';                   
                        $mail->Password   = 'Bookme@05';                               
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
                        $mail->Port       = 465;                                    
                        $mail->setFrom('gvasanth12345@gmail.com', 'Bookme');
                        $mail->addAddress($email);
                        $mail->isHTML(true);                                  
                        $mail->Subject = 'Registration otp code';
                        $mail->Body    = '<b>Here is the otp code = </b>'.$code.'';

                        $mail->send();
                        echo 'Message has been sent';
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                    echo "</div>";
                    $msg = "<div class='alert alert-info'>We've send a verification link on your email address.</div>";
                } else {
                    $msg = "<div class='alert alert-danger'>Something wrong went.</div>";
                }
            } else {
                $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match</div>";
            }
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
  <?php echo $msg; ?>
    <form action="" method="post" style="padding-left: 55px;padding-right: 55px;">
        <h4 style="padding-top: 15px;">Create account</h4>       
        <label for="name">Username</label><br>
          <input type="text" name="name" id="name" style="margin-bottom: 30px;width: 100%;"><br>
        <label for="mail">Gmail</label><br>
          <input type="email" name="email" id="gmail" style="margin-bottom: 30px;width: 100%;"><br>
          <label>Password</label><br>
           <input type="password" class="password" name="password" style="margin-bottom: 30px;"required><br>
           <label>Confirm Password</label> 
           <input type="password" class="confirm-password" name="confirm-password" style="margin-bottom: 30px;" required> 
        <button class="btn_btn" name="submit">Submit</button>
        <div style="display: flex; justify-content: space-between;padding-bottom: 20px;">
        <p style="font-size: 12px; color: blue;">Already i have account</p>
        <p id="login" onclick="signup()"><a href="login.php">login</a></p>
      </div>
    </form>
  </div>
</div>
</div>
</body>
</html>