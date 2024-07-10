<?php
require_once ('db.php');
$sql1 = "SELECT * FROM `events` ORDER BY id_event DESC";
$result=mysqli_query($conn,$sql1);
while($info = $result->fetch_assoc())
{
    $data[] = $info;
}
$sql2= "SELECT * FROM events, category, `events-category` 
         WHERE `events-category`.id_event= events.id_event 
           AND `events-category`.id_category=category.id_category";
$result1=mysqli_query($conn,$sql2);
while($cat = $result1->fetch_assoc())
{
    $catmas[] = $cat;
}
$sql3= "SELECT * FROM events, place, `events-place` 
         WHERE `events-place`.id_event= events.id_event 
           AND `events-place`.id_place=place.id_place";
$result1=mysqli_query($conn,$sql3);
while($place = $result1->fetch_assoc())
{
    $placemass[] = $place;
}
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='style.css'>

    <title>Админ</title>
</head>
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
<header>
    <div class="header-down">
        <div class="container">
            <a class="exit" href="exit.php"> Выйти из аккаунта</a>
            <a class="exit" href="users.php">Пользователи</a>
            <a class="exit" href="add_new_event.php">Добавить событие</a>
            <div class="events-admin">
            <?php foreach ($data as $info):?>
                <div class="event-admin">

                    <a class="draw" href='event.php?id_event=<?php echo $info['id_event']?>'>

                        <text class="age_limit"><?php echo $info['age_limit']?>+</text>
                        <text class="name_event"><?php echo $info['name_event'] ?></text>
                        <text class="categ">
                            <?php foreach ($catmas as $cat):
                                if ($info['id_event']==$cat['id_event']){
                                    echo $cat['name_category']. "<br>";}
                            endforeach;?>
                        </text>
                        <img class="image_event" src="img/<?php echo $info['image'] ?>" height="400" alt="Изображение события">
                    </a>

                    <div class="place"><span><?php
                            foreach ($placemass as $place):
                                if ($info['id_event'] == $place['id_event']) {
                                    echo $place['name_place'];
                                }
                            endforeach; ?></span>
                    </div>

                    <div class="description_event"><?php echo $info['description_event_crope'] ?></div>
                    <div class="date_added"><?php echo "Событие добавлено: ".$info['date_added'] ?></div>
                    <a  href='edit_event.php?id_event=<?php echo $info['id_event']?>'>Редактировать</a>
                    <a  href="delete_event.php?id_event=<?php echo $info['id_event']?>">Удалить</a>


                </div>
            <?php endforeach;?>
            </div>
        </div>
    </div>
</header>



</body>
</html>