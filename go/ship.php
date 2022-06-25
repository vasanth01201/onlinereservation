<?php
include_once 'conn.php';


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;


require_once 'vendor/autoload.php';

   if (isset($_POST['submit'])) {
   	     
           $name = mysqli_real_escape_string($conn, $_POST['name']);
           $email = mysqli_real_escape_string($conn, $_POST['gmail']);
   	     $from = $_POST['from'];
   	     $to = $_POST['to'];
   	     $departure = $_POST['departure'];
           $return = $_POST['return'];
           $passengers = $_POST['passengers'];
           $class = $_POST['class'];

   	     $sql = "INSERT INTO `ship` (`name`, `gmail`, `from`, `to`, `departure`, `return`, `passenger`, `class`) VALUES ('$name','$gmail', '$from', '$to', '$departure', '$return', '$passengers', '$class')";

   	      $result = mysqli_query($conn, $sql);

                if ($result) {
                    header('Location: index.html');
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
                        $mail->setFrom('bookme.onlinereservation@gmail.com', 'Bookme');
                        $mail->addAddress($email);
                        $mail->isHTML(true);                                  
                        $mail->Subject = 'Bookme Ticket Reservation';
                        $mail->Body    = '<b>Your Cruise Ticket Reserved Successfully</b><br>Username  - '  .$name.'<br>From - '.$from.'<br>To - '.$to.'<br>Departure - '.$departure.'<br>Return - '.$return.'<br>Passengers - '.$passengers.'<br>Class - '.$class.'';

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
           
        }
?>