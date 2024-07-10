<?php
require_once ('db.php');
$id_event=$_GET['id_event'];
//$id_event = $_GET['id_event'];
$sql = "SELECT * FROM events WHERE id_event='$id_event'";
$info = mysqli_fetch_assoc(mysqli_query($conn,$sql));

//$sql1= "SELECT * FROM category, `events-category` WHERE `events-category`.id_event='$id_event' AND `events-category`.id_category=category.id_category";
$sql1= "SELECT * FROM category ORDER BY `name_category` ASC";
$result1 = mysqli_query($conn,$sql1);
while($cat = $result1->fetch_assoc())
{
    $catmas[] = $cat;
}
$sql11= "SELECT * FROM category, `events-category` WHERE `events-category`.id_event='$id_event' AND `events-category`.id_category=category.id_category";
$result11 = mysqli_query($conn,$sql11);
while($catcat = $result11->fetch_assoc())
{
    $catcatmas[] = $catcat;
}

$sql2= "SELECT * FROM place ORDER BY `name_place` ASC";
$result2 = mysqli_query($conn,$sql2);
while($place = $result2->fetch_assoc())
{
    $placemas[] = $place;
}

$sql22= "SELECT * FROM place, `events-place` WHERE `events-place`.id_event='$id_event' AND `events-place`.id_place=place.id_place";
$result22 = mysqli_query($conn,$sql22);
while($placeplace = $result22->fetch_assoc())
{
    $placeplacemas[] = $placeplace;
}
$sql3= "SELECT * FROM `events-date` WHERE `events-date`.id_event='$id_event'";
$result3 = mysqli_query($conn,$sql3);



?>

<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='style.css'>



    <title>Редактировать событие</title>
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
        <a href="admin.php">К списку событий</a>

        <form action="save_event.php?id_event=<?php echo $info['id_event']?>" method="post">
            <div class="event-view">

                <div>
                    <img class="image_event" id="10" src="img/<?=$info['image']?>" alt="изображение события" height="400">
                    <div class="input-field-admin"><input type="file" id="12" value="<?=$info['image']?>" name="image"></div>
                    <div class="area">

                        <label>Короткое описание</label><textarea name="description_event_crope" rows="5" cols="50" name="description_event_crope"><?= $info['description_event_crope'] ?></textarea>
                        <label>Полное описание</label><textarea name="description_event" rows="15" cols="50" name="description_event"><?= $info['description_event'] ?></textarea>

                    </div>
                </div>
                <script>
                    $button=document.getElementById('12');
                    $button.addEventListener('click', () => {
                        document.querySelector('input[type="file"]').onchange = event => {
                            let reader = new FileReader();
                            reader.onload = e => document.getElementById('10').src = e.target.result;
                            reader.readAsDataURL(event.target.files[0]);
                        };
                        });
                </script>
                <div class="area">
                    <div class="input-field-admin"><input type="text" value="<?= $info['name_event'] ?>" name="name_event" > </div>
                    <div class="input-field-admin"> <input type="text" placeholder="Возрастное ограничение" value="<?=$info['age_limit']?>" name="age_limit" ></div>
                    <div class="input-field-admin"><label>Ссылка на источник</label><input type="text" value="<?=$info['url_event']?>" name="url_event" ></div>
                    <input type="hidden" id = 4 name="item">
                    <?php foreach ($catmas as $cat): ?>
                    <div class="check-cat">

                        <input type="checkbox" value="<?=$cat['id_category']?>" name="category[]"
                            <?php foreach ($catcatmas as $catcat): ?>
                                <?php if ($catcat['id_category']==$cat['id_category']):?> checked
                               <?php endif;?>
                                <?php endforeach; ?>
                        ><label><?=$cat['name_category'] ?></label>


                    </div>
                    <?php endforeach; ?>
                </div>

            <div class="select-place">
            <select name="place" size="10" name="id_place" onchange=":onchange()">

                <?php foreach ($placemas as $place): ?>
                <option value="<?=$place['id_place']?>" > <?=$place['name_place'] ?> </option>
                <?php endforeach; ?>
                <?php foreach ($placeplacemas as $placeplace): ?>
                    <script>
                        var select = document.querySelector('select');
                        var i = 0;

                        for (; i < select.length; i++) {
                            var check = select[i];

                            if (check.value === '<?php echo $placeplace['id_place'] ?>') {
                                check.selected = true;
                            }
                        }
                    </script>
                <?php endforeach; ?>
            </select>
            </div>
            <div class="area" id="dates">
                <?php $i2=0;?>
                <?php while ($date = mysqli_fetch_assoc($result3)):
                    $i1 = $i2; ?>
                <div class="date-admin" ><input class="dat" id="<?=$i1?>" type="datetime-local" value="<?php echo $date['date_event'];?>" name="date_event[]" >
                    <button type="button"  onclick="document.getElementById('<?=$i1?>').value = ''">удалить</button>
                    <?php $i2=$i1+1 ;?></div>
                <?php endwhile; ?>
                <button type="button"  onclick=" add(); "> Добавить еще</button>
            </div>


            <script>
                function add(){
                const $input = document.createElement("input");
                $input.type = "datetime-local";
                $input.id=<?=$i2?>;
                $input.name="date_event[]";
                const $date = document.querySelector('#dates');
                $date.appendChild($input);

                const $button = document.createElement("button");
                $button.type = "button";
                $button.textContent = 'удалить';
                $button.addEventListener('click', () => { document.getElementById(<?=$i2?>).value = '';});
                $date.appendChild($button);

                return <?=$i2=$i2+1;?>;
                }
            </script>
                </div>
                <button type="submit" class="button" >Изменить</button>

        </form>
    </div>
</div>


</body>
</html>