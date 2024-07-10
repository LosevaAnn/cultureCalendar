<?php
require_once ('db.php');
if (isset($_GET['id_category'])){
$id_category=$_GET['id_category'];
$sql1 = "SELECT * FROM events, `events-category` 
         WHERE `events-category`.id_category='$id_category' 
           AND `events-category`.id_event=events.id_event";
$result=mysqli_query($conn,$sql1);

while($info = $result->fetch_assoc())
{
    $data[] = $info;
}
$query = "SELECT * FROM events, `events-date` 
         WHERE `events-date`.id_event=events.id_event";
$result_query=mysqli_query($conn,$sql1);

while($info1 = $result_query->fetch_assoc())
{
    $data1[] = $info1;
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
}
else if(isset($_GET['id_place'])){
    $id_place=$_GET['id_place'];
    $sql1 = "SELECT * FROM events, `events-place`
         WHERE `events-place`.id_place='$id_place'
           AND `events-place`.id_event=events.id_event";
    $result=mysqli_query($conn,$sql1);
    
    while($info = $result->fetch_assoc())
    {
        $data[] = $info;
    }
    $query = "SELECT * FROM events, `events-date`
         WHERE `events-date`.id_event=events.id_event";
    $result_query=mysqli_query($conn,$sql1);
    
    while($info1 = $result_query->fetch_assoc())
    {
        $data1[] = $info1;
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
    
}


?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='style.css'>
    <title>Культурный календарь</title>
</head>
<body>
<div class="rectangle">
    <div class="container">
        <div class="header-line">
            <div class="header-logo">
                <a href="index.php"><img src="img/logo.png" alt=""></a>
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
        <div class="events">
            <!--Если пользователь выбрал категорию-->
            

            <?php foreach ($data as $info):?>
                    <div class="event">
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

                        <div class="but">
                            <a class="price" href="<?php $info['url_event']?>"> Перейти к событию </a>
                            <button class="add-to-favourites icon" id="fav"  data-event-id="<?=$info['id_event']?>" >
                                <?php $id_event=$info['id_event'];
                                if (!empty($_COOKIE['user'])):
                                    $email=$_COOKIE['user'];
                                    $query = "SELECT * FROM favourites WHERE email ='$email' AND id_event ='$id_event'";
                                    $result = mysqli_query($conn,$query);
                                    if(mysqli_num_rows($result)>0):?>
                                        <img src="img/сердце.png"> <?php endif; ?>
                                <?php else:?>
                                    <img src="img/сердце серое.png">
                                <?php endif;?>
                            </button>


                            <script>
                                document.querySelectorAll('.add-to-favourites').forEach(function (button) {
                                    button.addEventListener('click', function () {

                                        var eventId = this.getAttribute('data-event-id');
                                        if (document.getElementById('fav').src === "серое сердце.png") {
                                            document.getElementById("fav").src="сердце.png";
                                        } else {
                                            document.getElementById("fav").src = "серое сердце.png";
                                        }

                                        // Отправка запроса на сервер для добавления товара в избранное
                                        // Здесь нужно использовать AJAX или Fetch API

                                        var params = new URLSearchParams();
                                        params.set('id_event', eventId);
                                        fetch('add_favourite.php', {
                                            method: 'POST',
                                            body: params
                                        }).then(
                                            response => {
                                                return response.text();
                                            }
                                        );
                                    })
                                });
                            </script>
                        </div>
                    </div>
            <?php endforeach;?>
            
    </div>
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