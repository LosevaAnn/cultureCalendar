<?php
require_once ('db.php');

$sql1 = "SELECT * FROM events ORDER BY date_added DESC";
$result=mysqli_query($conn,$sql1);
//($info = mysqli_fetch_assoc($result))
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
$sql4= "SELECT * FROM category";
$result4=mysqli_query($conn,$sql4);
while($categ = $result4->fetch_assoc())
{
    $categmas[] = $categ;
}

$sql3= "SELECT * FROM events, place, `events-place` 
         WHERE `events-place`.id_event= events.id_event 
           AND `events-place`.id_place=place.id_place ORDER BY place.name_place";
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
    <title>Культурный календарь</title>
</head>
<body>
        <div class="rectangle">
            <div class="container">
                <div class="header-line">
                    <div class="header-logo">
                        <img src="img/logo.png" alt="">
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
            
            <div class="scrollmenu">
                <div class="category">
                    <?php foreach ($categmas as $categ):?>
                    <a class="cat" href="events.php?id_category=<?=$categ['id_category']?>"> <?=$categ['name_category']?> </a>
                    <?php endforeach;?>

                </div>
                
            </div>
            <div class="razdel"> Новые события</div>
            <div class="scrollmenu">

                <div class="events">

                    <?php foreach ($data as $info):?>
                    <?php
                        $date="2024-05-27";
                        if ($info['date_added']>$date):?>
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
                               <a class="price" href="<?php echo $info['url_event']?>"> Перейти к событию </a>
                            <button class="add-to-favourites icon" id="fav"  data-event-id="<?=$info['id_event']?>" >
                        
                           
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
                   
                    <?php endif;?>
                    
                    <?php endforeach;?>
                </div>
            </div>

        </div>
    </div>
<div class="filter">

    <div class="container">
    <div class="scrollmenu">
                <div class="category">
                    <?php foreach ($placemass as $place):?>
                    <a class="cat" href="events.php?id_place=<?=$place['id_place']?>"> <?=$place['name_place']?> </a>
                    <?php endforeach;?>

                </div>
                
            </div>
    

        <form class="research" action="search.php">

            <input class="poeskinput" name="search-item" type="text" placeholder="Искать здесь...">
            <button class="search" type="submit"> </button>

        </form>
        <div class="dropdown">
            <button class="dropbtn"> <img src="img/Arrow.png">  Жанр</button>
            <div class="dropdown-content">
                <?php foreach ($categmas as $categ): ?>
                <a href="events.php?id_category=<?=$categ['id_category']?>"><?=$categ['name_category']?></a>
                <?php endforeach;?>
            </div>
        </div>
        <div class="dropdown">
            <a class="dropbtn" href=""> По популярности</a>
        </div>
        <div class="dropdown">

            <a class="dropbtn" href="events.php?new"> Новые</a>
        </div>
        <div class="dropdown">
            <a class="dropbtn" href="events.php/id_category=5"> детям</a>
        </div>
        <div class="dropdown">
            <a class="dropbtn" href="events.php/id_category=14">бесплатно</a>
        </div>
        <div class="dropdown">
        <form action="search.php" type= "post">
            <input type="date" class="dropbtn" name="date_select"></input>
            <button type="submit">Найти по дате</button>
            </form>
        
    </div>
</div>

			
<div class="rec">
    <div class="container">
        <div class="razdel"> Другие события</div>
        <div class="AllRec">
            <?php foreach ($data as $info):?>
            <?php
            $date="2024-05-27";
            if ($info['date_added']<$date):?>
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
                        
                    </button>

                    <script>
                        document.querySelectorAll('.add-to-favourites icon').forEach(function (button) {
                        
                            button.addEventListener('click', function () {
                            	
                                var eventId = this.getAttribute('data-event-id');
                                
                              
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
            <?php endif;?>
            
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
