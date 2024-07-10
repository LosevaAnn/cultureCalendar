




<?php
require_once('db.php');
$email=$_COOKIE['user'];
$sql="SELECT * FROM users WHERE email='$email'";

$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>

<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='style.css'>
    <title>Измените данные</title>
</head>
</html>

<link rel="stylesheet" type="text/css" href="style.css">
<body>
<div class="rectangle">
    <div class="container">
        <div class="header-line">
            <a class="header-logo" href="index.php">
                <img src="img/logo.png" alt="">
            </a>

            <div class="lk">
                <a class='lks' href="windowreg.php">
                    <img src="img/LK.png" alt="">
                </a>
            </div>

        </div>
        <div class="logo-text">
            Выбери событие по интересам!
        </div>

    </div>
</div>

<div class="update">
    <form class="reg" action="save.php" method="post">
        <h2>Измените данные</h2>
        <div class="input-field"><input type="text" placeholder="<?= $user['first_name'] ?>" name="first_name" > </div>
        <div class="input-field"><input type="text" placeholder="<?= $user['last_name'] ?>" name="last_name" ></div>
        <div class="input-field"><input type="email" placeholder="<?= $user['email'] ?>" name="new_email" ></div>
        <div class="input-field">
            <?php if ($user['gender']=='male'): ?>
            <input type = "radio" name = "gender" value = 'male' id="male" checked><label for="male">Мужчина</label>
            <input type = "radio" name = "gender" value = 'female' id="female"><label for="female">Женщина</label>
            <?php else: ?>
            <input type = "radio" name = "gender" value = 'male' id="male" ><label for="male">Мужчина</label>
            <input type = "radio" name = "gender" value = 'female' id="female" checked><label for="female">Женщина</label>
            <?php endif ?>
        </div>
        <div class="input-field"><input type="password" placeholder="Новый пароль" name="pass" ></div>
        <div class="input-field"><input type="password" placeholder="Повторите пароль" name="repeatpass" ></div>
        <button type="submit" class="button">Изменить</button>
    </form>
</div>
<footer>
    <ul class="menu">
        <li><a href="index.php">Главная</a></li>
        <li><a href="#">О нас</a></li>
        <li><a href="#">Контакты</a></li>
    </ul>
    <p>©2024 What's On Now? | Все права защищены</p>
</footer>

</body>



