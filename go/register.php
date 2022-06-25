<?php
   include_once 'conn.php';

   if (isset($_POST['submit'])) {
   	     
   	     $username = $_POST['name'];
   	     $number = $_POST['mobile'];
   	     $gmail = $_POST['mail'];

   	     $sql = "INSERT INTO `users` (`username`, `number`, `gmail`) VALUES ('$username', '$number', '$gmail')";
   	      if ($conn->query($sql) === TRUE) {
               header('Location: index.html');
           }
           else 
           {
               echo "Booking Failed";
           }
     mysqli_close($conn);
   }
?>