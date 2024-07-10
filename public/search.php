<?php
//include SITE_ROOT . "db.php";

require_once ('db.php');
if (isset($_GET['search-item'])){
    $text=$_GET['search-item'];
    
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
    
    
         
         $text1=trim(stripcslashes($text));
         $sql= "SELECT * FROM events WHERE name_event LIKE '%$text1%' ORDER BY date_added DESC";
         $result=mysqli_query($conn,$sql);
         while($info = $result->fetch_assoc())
         {
             $data[] = $info;
         }
}
else if (isset($_GET['date_select'])){
    $date=$_GET['date_select'];
    
    $sql2= "SELECT * FROM events, category, `events-category`, `events-date`
             WHERE `events-date`.date_event LIKE '%$date%' AND `events-date`.id_event=events.id_event
               AND `events-category`.id_category=category.id_category AND `events-category`.id_event=`events-date`.id_event" ;
    $result1=mysqli_query($conn,$sql2);
    while($cat = $result1->fetch_assoc())
    {
        $catmas[] = $cat;
    }
    $sql3= "SELECT * FROM events, place, `events-place`, `events-date`
             WHERE `events-place`.id_event= events.id_event AND `events-date`.date_event LIKE '%$date%' 
               AND `events-place`.id_place=place.id_place AND `events-date`.id_event=events.id_event";
    $result1=mysqli_query($conn,$sql3);
    while($place = $result1->fetch_assoc())
    {
        $placemass[] = $place;
    }
    
    
    
    
    $sql= "SELECT * FROM events,`events-date` WHERE `events-date`.date_event LIKE '%$date%'
AND `events-date`.id_event=events.id_event ORDER BY date_added DESC";
    $result=mysqli_query($conn,$sql);
    while($info = $result->fetch_assoc())
    {
        $data[] = $info;
    }
    
}


    
    
    
    
//}

//if (isset($_POST['submit'])) {
    //if (isset($_GET['go'])) {

            //$search = $_POST['search'];
            //$sql="SELECT * FROM events WHERE name_event LIKE '%" . $search .  "%'";
           // $result=mysqli_query($conn,$sql);

           // echo $result;
                //-Вывод результата в виде массива



    //} else {
    //    echo "<p>Пожалуйста, введите поисковый запрос</p>";
   // }
//}
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='style.css'>

    <title>Результаты поиска</title>
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


                </div>
            <?php endforeach;?>
            </div>
        </div>
    </div>
</header>



</body>
</html>


