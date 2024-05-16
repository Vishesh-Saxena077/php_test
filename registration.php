<?php
require_once 'db_con.php';

$dataErr_Message = $nameErr_Message = $phoneErr_Message = $emailErr_Message = $subjectErr_Message = $messageErr_Message = $ipErr_Message = $timeinsertErr_Message = '';
$name = $phone = $email = $subjet = $message = $ip = $timeinsert = '';



    if(isset($_POST['submit'])){
        $checkemail = mysqli_real_escape_string($connection, $_POST['email']);
        echo $checkemail;
        // check Duplicate Entry
        $result = mysqli_query($connection, "SELECT * FROM user_table WHERE email = '$checkemail'");
        $exce = mysqli_num_rows($result);
        if($exce > 0){
            $dataErr_Message = "Duplicate Data";
            echo $dataErr_Message;
        }
        else{

            // no SQL Injection will work  here due to the use of mysqli_real_escape_string() method as it will 
            // eleminate the special characters
            //DONE by using this function 
            // 'Validate each of the fields to make sure they are filled in with correct and valid input using PHP.'
            // name
            
            if(empty($_POST['fullname'])){
                $nameErr_Message = "Name is required"."<br>";
                echo $nameErr_Message;
            }
            else{
                $name = mysqli_real_escape_string($connection, $_POST['fullname']);
                // echo $name;
            }

            // email
            if(empty($_POST['phone'])){
                $emailErr_Message = "email is required"."<br>";
                echo $phoneErr_Message;
            }
            else{
                $email = mysqli_real_escape_string($connection, $_POST['email']);
                // echo $name;
            }

            // phone
            if(empty($_POST['phone']) && $_POST['phone'].length < 13){
                $emailErr_Message = "Check the Length and if empty check the feild"."<br>";
                echo $phoneErr_Message;
            }
            else{
                $email = mysqli_real_escape_string($connection, $_POST['email']);
                // echo $name;
            }

            // subject
            if(empty($_POST['subject'])){
                $subjectErr_Message = "Subject is required"."<br>";
                echo $subjectErr_Message;
            }
            else{
                $subject = mysqli_real_escape_string($connection, $_POST['subject']);
                // echo $name;
            }

            // message
            if(empty($_POST['messages'])){
                $messageErr_Message = "Message not found"."<br>";
                echo $messageErr_Message;
            }
            else{
                $message = mysqli_real_escape_string($connection, $_POST['messages']);
                // echo $name;
            }

            $timeinsert = date('Y-m-d H:i:s');
            // time Stamp
            if(empty($timeinsert)){
                $timeinsertErr_Message = "timestamp not specified"."<br>";
                echo $timeinsertErr_Message;
            }

            $ip = $_SERVER["REMOTE_ADDR"];
            if(empty($ip)){
                $ipErr_Message = "error ip address"."<br>";
                echo $ipErr_Message;
            }

            $insert_data = [
                'fullname' => $name,
                'phone' => $phone,
                'email' => $email,
            'subject' => $subject,
            'message' => $message,
            'ip' => $ip,
            'timeinsert' => $timeinsert
            ];

            $cols = implode(', ', array_keys($insert_data));

            $vals = implode("', '", array_values($insert_data));
            
            $sql = "INSERT INTO user_table($cols) VALUES ('$vals')";

            $insert = $connection->query($sql);
            if($insert){
                echo "Successfully Inserted the Data";
            } else {
                $err1 = "Failed to Insert the Data";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        form{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        input{
            width: 200px;
            height: 30px;
            margin: 10px;
        }
        textarea{
            width: 200px;
            height: 100px;
            margin: 10px;
        }
        input[type="submit"]{
            width: 200px;
            height: 30px;
            margin: 10px;
        }
    </style>
</head>
<body>
    <h2>Registration form</h2>
    <!-- 
        Full name
        phone number
        email
        subject
        message
     -->
     <!-- $_SERVER['PHP_SELF'] exploits can be avoided by using htmlspecialchars() function-->
    <form method="POST" id="userform" enctype="multipart/form-data" autocomplete="off" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="text" name="fullname" placeholder="Name">
        <input type="number" name="phone" placeholder="phone number">
        <input type="email" name="email">
        <input type="text" name="subject">
        <textarea name="messages" id="messages"></textarea>
        <input type="submit" name="submit">
        <hr>
    </form>
</body>
</html>
