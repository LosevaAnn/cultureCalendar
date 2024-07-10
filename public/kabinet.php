
<?php require_once ('db.php');
$email=$_COOKIE['user'];
$sql1 = "SELECT * FROM events, favourites WHERE favourites.id_event=events.id_event AND favourites.email='$email'";
$result=mysqli_query($conn,$sql1);

while($info = $result->fetch_assoc())
{
    $data[] = $info;
}
$sql2= "SELECT * FROM events, category, `events-category` WHERE `events-category`.id_event= events.id_event AND `events-category`.id_category=category.id_category";
$result1=mysqli_query($conn,$sql2);
while($cat = $result1->fetch_assoc())
{
    $catmas[] = $cat;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='style.css'>

    <title>Личный кабинет</title>
</head>
<body>
<div class="rectangle">
    <div class="container">
        <div class="header-line">
            <div class="header-logo">
                <a href="index.php"> <img src="img/logo.png" alt=""></a>
            </div>
            <div class="lk">
                <a class='lks' href="kabinet.php">
                    <img src="img/LK.png" alt="">
                </a>
            </div>

        </div>
        <div class="logo-text">
            Выбери событие по интересам!
        </div>

    </div>
</div>
<div class="info">
    <div class="container">
        <div class="DataUser">
            <div class="FIO">
                <p>Имя и Фамилия:</p>
                <?php
                $email=$_COOKIE['user'];
                $sql="SELECT * FROM users WHERE email='$email' ";
                $result = $conn->query($sql);
                $user = mysqli_fetch_assoc($result);;
                ?>
                <text>  <?php printf($user['first_name'] . " " .$user['last_name'] )?>  </text>
                

            </div>
            <div class="favorite">
                <p>избранное</p>

                <?php $query="SELECT * FROM favourites WHERE email='$email'";
                $result = mysqli_query($conn, $query);
                $num_rows=mysqli_num_rows($result);
                echo $num_rows;?>
            </div>

            <a class="exit" href="update.php"> Редактировать данные</a>
            <a class="exit" href="exit.php"> Выйти из аккаунта</a>


        </div>
        <hr>
        <div class="razdel"> Избранные события</div>
        <div class="AllRec">
            <div class="RecHoriz">
                <?php if ($num_rows>0): ?>
                <?php foreach ($data as $info):?>
                <div class="event1">
                    <img src="img/<?=$info['image']?>" height="300">
                    <a class="EvRec" href='event.php?id_event=<?php echo $info['id_event']?>'>
                        <div class="name"> <?=$info['name_event']?></div>
                        <div class="subname"><?php foreach ($catmas as $cat):
                                if ($info['id_event']==$cat['id_event']){
                                    echo $cat['name_category']. "<br>";}
                            endforeach;?></div>

                    </a>
                </div>
                <?php endforeach;?>
                <?php else: ?> <text>У Вас пока нет избранных событий :(</text>
                <?php endif;?>

            </div>
        </div>
        <hr>
    </div>
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
</html>