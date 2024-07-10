<?php
require_once('db.php');
$email=$_COOKIE['user'];
$new_email=$_POST['new_email'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$gender = $_POST['gender'];
$pass = $_POST['pass'];
$repeatpass = $_POST['repeatpass'];
$sql="SELECT * FROM users WHERE email='$email'";

$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if ($first_name !=""){
    $sql_first_name = "UPDATE users SET first_name='$first_name' WHERE email='$email'";
    mysqli_query($conn, $sql_first_name) or die(mysqli_error($sql_first_name));
    if ($conn->query($sql_first_name) === TRUE){
        echo 'юзер успешно изменен!';
    }
    header('Location: /kabinet.php');
}

if ($last_name !=""){
$sql_last_name = "UPDATE users SET last_name='$last_name'  WHERE email='$email'";
mysqli_query($conn, $sql_last_name) or die(mysqli_error($sql_last_name));
    if ($conn->query($sql_last_name) === TRUE){
        echo 'юзер успешно изменен!';
    }
    header('Location: /kabinet.php');
}

if ($new_email !=""){
    $sql_new_email = "UPDATE users SET email='$new_email' WHERE email='$email'";
    mysqli_query($conn, $sql_new_email) or die(mysqli_error($sql_new_email));
    setcookie('user', $email=$_POST['new_email'], time()+3600, '/');
    if ($conn->query($sql_last_name) === TRUE){
        echo 'юзер успешно изменен!';
    }
    header('Location: /kabinet.php');
}

if ($gender==='male'){
    $sql_gender = "UPDATE users SET gender= 'male' WHERE email='$email'";
    mysqli_query($conn, $sql_gender) or die(mysqli_error($sql_gender));
    if ($conn->query($sql_gender) === TRUE){
        echo 'юзер успешно изменен!';
    }
    header('Location: /kabinet.php');
}
if ($gender==='female'){
    $sql_gender = "UPDATE users SET gender= 'female' WHERE email='$email'";
    mysqli_query($conn, $sql_gender) or die(mysqli_error($sql_gender));
    if ($conn->query($sql_gender) === TRUE){
        echo 'юзер успешно изменен!';
    }
    header('Location: /kabinet.php');
}

if ($pass !="") {
    if ($pass != $repeatpass) {
        echo "Пароли не совпадают";
    } else {
        $pass=md5($pass."dsfk09");
        $sql_pass = "UPDATE users SET pass='$pass' WHERE email='$email'";
        mysqli_query($conn, $sql_pass) or die(mysqli_error($sql_pass));
        if ($conn->query($sql_pass) === TRUE){
            echo 'юзер успешно изменен!';
        }
        header('Location: /kabinet.php');
    }

}
?>



