

<?php
require_once('db.php');

$email = trim($_POST['email']);
$pass= trim($_POST['pass']);

$sql="SELECT * FROM users WHERE email='$email' AND pass='$pass'";
$sql_admin="SELECT * FROM admin WHERE login_admin='$email' AND password_admin='$pass'";

if(empty($email) || empty($pass)) {
    echo "Заполните все поля";
}else if ($_POST['forgot']){
    $query1 = "SELECT * FROM `users` WHERE `email`='$email' LIMIT 1";
    $sql = mysqli_query($conn,$query1) or die(mysqli_error());
    if (mysqli_num_rows($sql)==1)
    {
        $simv = array ("92", "83", "7", "66", "45", "4", "36", "22", "1", "0",
            "k", "l", "m", "n", "o", "p", "q", "1r", "3s", "a", "b", "c", "d", "5e", "f", "g", "h", "i", "j6", "t", "u", "v9", "w", "x5", "6y", "z5");
        for ($k = 0; $k < 8; $k++)
        {
            shuffle ($simv);
            $string = $simv[1];

        }
        $pass=md5($string."dsfk09");
        $query2 = "UPDATE `users` SET `pass`='$pass' WHERE `email`='$email' ";
        $sql = mysqli_query($conn,$query2) or die(mysqli_error());
        $sql = mysqli_query($conn,$query1)or die(mysqli_error());
        $r = mysqli_fetch_assoc($sql);
        $mail = $r['email'];
        //формируем письмо
        mail($email, "Запрос на восстановление пароля", "Hello. Here your new password: $string", "From: event_calendar@mail.ru");
    }
    echo "На ваш почтовый ящик было отправлено письмо с новым паролем";
}
else {
    $pass=md5($pass."dsfk09");
    $sql="SELECT * FROM users WHERE email='$email' AND pass='$pass'";
    $result1 = $conn->query($sql);
    $result2 = $conn->query($sql_admin);
    if ($result1->num_rows > 0) {
        while ($row1 = $result1->fetch_assoc()) {
            if($row1['access']==1){
                echo "Вы заблокированы";
            }else{
            setcookie('user', $row1['email'], time()+3600, '/');
            header('Location: /kabinet.php');
            }//echo "Добро пожаловать" . ", " . $row['first_name'];
        }
    } else if ($result2->num_rows > 0){
        while ($row2 = $result2->fetch_assoc()) {
            setcookie('admin', $row2['firstname_lastname'], time()+3600, '/');
            header('Location: /admin.php');
        }
    }
    else {
        echo "Скорее всего, вы ввели неверные данные";
    }
}



