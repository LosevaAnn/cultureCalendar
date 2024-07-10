<?php
require_once ('db.php');
$email=$_POST['email'];
$pass=$_POST['pass'];
$repeatpass=$_POST['repeatpass'];
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$gender=$_POST['gender'];
$date_birth=$_POST['date_birth'];

$query = "SELECT * FROM users WHERE email='$email'";
$user = mysqli_fetch_assoc(mysqli_query($conn,$query));

    if(empty($email)||empty($pass)||empty($gender)||empty($date_birth)||empty($first_name)||empty($last_name)){
       echo "Заполните все поля";
    }else if ($pass!=$repeatpass){
            echo "Пароли не совпадают";
        }
    else if ($user['email'] == $_POST['email']){
        echo "Пользователь с таким email уже существует"; }
    else {
        $pass=md5($pass."dsfk09");
        $sql = "INSERT INTO `users` (email, pass, first_name, last_name, gender, date_birth, access) 
VALUES ('$email', '$pass', '$first_name', '$last_name', '$gender', '$date_birth', 0)";

        if ($conn->query($sql) === TRUE) {
            setcookie('user', $user=$_POST['email'], time()+3600, '/');
            header('Location: /kabinet.php');
        } else {
            echo "Ошибка" . $conn->error;
        }
    }










    
