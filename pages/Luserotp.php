<?php
session_start();
include'../includes/connection.php';
require "../vendor/autoload.php"; // If using Composer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$sql = "SELECT ID,e.FIRST_NAME,e.LAST_NAME,e.GENDER,e.EMAIL,e.PHONE_NUMBER,j.JOB_TITLE,l.PROVINCE,l.CITY,t.TYPE
        FROM  `users` u
        join `employee` e on e.EMPLOYEE_ID=u.EMPLOYEE_ID
        JOIN `location` l ON e.LOCATION_ID=l.LOCATION_ID
        join `job` j on e.JOB_ID=j.JOB_ID
        join `type` t ON t.TYPE_ID=u.TYPE_ID
        WHERE e.EMAIL='".$_POST['email']."'";
        $result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");
        if ($row = mysqli_fetch_assoc($result)) {
            $email = $row['EMAIL'];
            $code = rand(999999, 111111);
            $status = "Inactive";
            
            $sql ="UPDATE users
                 INNER JOIN employee ON users.EMPLOYEE_ID = employee.EMPLOYEE_ID
                 SET users.code = '".$code."', users.Status = '".$status."'
                 WHERE employee.EMAIL ='".$email."'";
           
            $data_check = mysqli_query($db, $sql);
            
            if($data_check){
            $mail = new PHPMailer(true);
            
            try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
            $mail->SMTPAuth = true;
            $mail->Username = 'capstonesystem2@gmail.com'; // SMTP username
            $mail->Password = 'amphaxmzyxxknyjv'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
            $mail->Port = 587; // TCP port to connect to
            
            //Recipients
            $mail->setFrom('capstonesystem2@gmail.com', 'artra');
            $mail->addAddress($email); // Add a recipient
            
            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Email Verification Code';
            $mail->Body = "Your verification code is ".$code;
            
            $mail->send();
            $info = "We've sent a verification code to your email - ".$email;
            echo "<script type='text/javascript'>alert('".$info."');</script>";
            } catch (Exception $e) {
                echo "<script type='text/javascript'>alert('Message could not be sent.'); window.location='Lforgotpass.php';</script>";
            }
            } else {
                echo "<script type='text/javascript'>alert('Failed while inserting data into database!.'); window.location='Lforgotpass.php';</script>";
            }
        }else{
            echo "<script type='text/javascript'>alert('Email Doesn't Exist.'); window.location='Lforgotpass.php';</script>";
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Code Verification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <?php
      
    ?>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="Lresetpass.php" method="POST" autocomplete="off">
                    <h2 class="text-center">Code Verification</h2>
                    <div class="form-group">
                        <input class="form-control" type="number" name="otp" placeholder="Enter verification code" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>