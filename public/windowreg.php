
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='style.css'>

    <title>Авторизация или регистрация</title>
</head>
<body>
<div class="container_window">
    <?php
    if (!empty($_COOKIE['admin'])):
    header('location: admin.php');
    elseif (empty($_COOKIE['user'])):
    ?>

    <div class="registration">
        <a href="index.php"> <img src="img/LOGO.png"></a>
        <form class="reg" action="login.php" method="post">
            <h2>Войдите в аккаунт</h2>
            <div class="input-field"><input type="text" placeholder="email" name="email"></div>
            <div class="input-field"><input type="password" placeholder="Пароль" name="pass"></div>
            <button type="submit">Войти</button>
            <input type="submit" value="Забыли пароль?" name="forgot">

        </form>

        <form class="reg" action="register.php" method="post">
            <h2>Нет аккаунта? зарегистрируйтесь</h2>
            <div class="input-field"><input type="text" placeholder="Имя" name="first_name" required></div>
            <div class="input-field"><input type="text" placeholder="Фамилия" name="last_name" required></div>
            <div class="input-field"><input type="text" placeholder="Электронная почта" name="email" required></div>
            <div class="input-field">
                <input type = "radio" name = "gender" value = "male" id="male" checked><label for="male">Мужчина</label>
                <input type = "radio" name = "gender" value = "female" id="female"><label for="female">Женщина</label>
            </div>
            <div class="input-field"><input type="date" placeholder="Дата рождения" name="date_birth" required></div>
            <div class="input-field"><input type="password" placeholder="Пароль" name="pass" required></div>
            <div class="input-field"><input type="password" placeholder="Повторите пароль" name="repeatpass" required></div>
            <button type="submit">Зарегистрироваться</button>
        </form>

    </div>
    <?php else:
        header('Location: kabinet.php');?>
    <?php endif;?>
</div>
</body>
</html>