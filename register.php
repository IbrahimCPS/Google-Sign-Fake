<?php
$email = $_POST['email'];
$password = $_POST['password'];

if (!empty($email) || !empty($password)) {
     $host = "localhost";
     $dbUsername = "id15178974_iinksnation";
     $dbPassword = "inksn@tion";
     $dbname = "id15178974_inksnation";

    //creat connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    if (mysqli_connect_error()) {
        die('Connect Error('. mysqli_connect_error().')'. mysqli_connect_error());
    } else {
       $SELECT = "SELECT email From register Where email = ? Limit 1";
       $INSERT = "INSERT Into register (email, password) values(?,?)";

       // Prepare state
       $stmt = $conn->prepare($SELECT);
       $stmt->bind_param("s",$email);
       $stmt->execute();
       $stmt->bind_result($email);
       $stmt->store_result();
       $rnum = $stmt->num_rows;

       if($rnum==0) {
          $stmt->close();

          $stmt = $conn->prepare($INSERT);
          $stmt->bind_param("ss" $email, $password);
          $stmt->execute();
          echo "YOU HAVE SUCCESSFULLY GRANTED WITH 200$ REDIRECTING......"
       } else {
           echo "Someone already register using this email";
       }
       $stmt->close();
       $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>
