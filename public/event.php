<?php
require_once ('db.php');
$id_event=$_GET['id_event'];
$sql = "SELECT * FROM events WHERE id_event='$id_event'";
$info = mysqli_fetch_assoc(mysqli_query($conn,$sql));

$sql1= "SELECT * FROM category, `events-category` 
         WHERE `events-category`.id_event='$id_event' 
           AND `events-category`.id_category=category.id_category";
$result1 = mysqli_query($conn,$sql1);
while($cat = $result1->fetch_assoc())
{
    $catmas[] = $cat;
}
$sql2= "SELECT * FROM place, `events-place` 
         WHERE `events-place`.id_event='$id_event' 
           AND `events-place`.id_place=place.id_place";
$result2 = mysqli_query($conn,$sql2);
while($place = $result2->fetch_assoc())
{
    $placemas[] = $place;
}
$sql3= "SELECT * FROM `events-date` WHERE `events-date`.id_event='$id_event'";
$result3 = mysqli_query($conn,$sql3);
while($date = $result3->fetch_assoc())
{
    $datemas[] = $date;
}
$day[0] = "Воскресенье";
$day[1] = "Понедельник";
$day[2] = "Вторник";
$day[3] = "Среда";
$day[4] = "Четверг";
$day[5] = "Пятница";
$day[6] = "Суббота";
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='style.css'>
    <link rel="" href="windowreg.php">

    <title>What's On Now?</title>
</head>
<body>
    <div class="rectangle">
        <div class="container">
            <div class="header-line">
                <div class="header-logo">
                    <a href="index.php" ><img src="img/logo.png" alt=""></a>
                </div>


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
    <div class="header-down">
        <div class="container">
            <div class="event-view">
                <img class="image_event" src="img/<?php echo $info['image'] ?>" height="400">
                <div class="event-view-info">
                    <div class="event-view">
                    <h1><?php echo $info['name_event'] ?></h1>
                    <?php if(!empty($_COOKIE['admin'])): ?>
                        <a href="edit_event.php?id_event=<?php echo $info['id_event']?>">Редактировать</a>
                    <?php endif;?>
                    </div>
                    <div class="category">
                        <?php foreach ($catmas as $cat):
                            if ($cat['id_event']==$id_event){ ?>
                        <div class="cat-event"><?php echo $cat['name_category'];} ?> </div>
                        <?php endforeach;?>
                    </div>
                    <hr>
                    <h2>Где?</h2>
                    <div class="place-event"> <?php foreach ($placemas as $place):
                        if ($place['id_event']==$id_event){ ?>
                            <text> <?php echo $place['name_place']?></text>
                            <?php echo $place['adress_place'];}?>
                    <?php endforeach;?>
                    </div>
                    <hr>
                    <?php
                    $query = "SELECT * FROM `events-date` WHERE id_event ='$id_event'";
                    $result= mysqli_query($conn, $query);
                    if ($result->num_rows > 0):
                    ?>
                    <h2>Когда?</h2>
                    <div class="date-admin">
                        <?php foreach ($datemas as $date):
                            if ($date['id_event']==$id_event){
                                $dnum = date("w",strtotime($date['date_event']));
                                $textday = $day[$dnum];?>
                        <text> <?php echo "$textday".", ". date('d.m.y H:i', strtotime($date['date_event'])); }?> </text>

                        <?php endforeach;?>
                    </div>
                    <?php endif;?>

                </div>

            </div>
            <div class="description_event-view"> <?php echo nl2br($info['description_event']) ?> </div>
            <a class="exit" href="<?php echo $info['url_event']?>"> Перейти к событию </a>
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