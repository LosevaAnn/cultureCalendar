<?php
require_once ('db.php');
$sql1= "SELECT * FROM category ORDER BY `name_category` ASC";
$result1 = mysqli_query($conn,$sql1);
while($cat = $result1->fetch_assoc())
{
    $catmas[] = $cat;
}
$sql2= "SELECT * FROM place ORDER BY `name_place` ASC";
$result2 = mysqli_query($conn,$sql2);
while($place = $result2->fetch_assoc())
{
    $placemas[] = $place;
}

?>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='style.css'>



    <title>Добавьте событие</title>
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

        <form action="add_new_event_save.php" method="post">
            <div class="event-view">

                <div>
                    <img class="image_event" id="10" src="img/" alt="изображение события" height="400">
                    <div class="input-field-admin"><input type="file" id="12" name="image"></div>
                    <div class="area">

                        <label>Короткое описание</label><textarea name="description_event_crope" rows="5" cols="50"></textarea>
                        <label>Полное описание</label><textarea name="description_event" rows="15" cols="50" ></textarea>

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
                    <div class="input-field-admin"> <label>Наименование события</label><input type="text" value="" name="name_event" ></div>
                    <div class="input-field-admin"> <label>Возрастное ограничение</label><input type="text" value="" name="age_limit" ></div>
                    <div class="input-field-admin"><label>Ссылка на источник</label><input type="url" value="" name="url_event" ></div>
                    <input type="hidden" id = 4 name="item">
                    <?php foreach ($catmas as $cat): ?>
                        <div class="check-cat">
                            <input type="checkbox" value="<?=$cat['id_category']?>" name="category[]"><label><?=$cat['name_category'] ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="select-place">
                    <select name="place" size="10" name="id_place" onchange=":onchange()">

                        <?php foreach ($placemas as $place): ?>
                            <option value="<?=$place['id_place']?>" > <?=$place['name_place'] ?> </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="area" id="dates">
                        <div class="date-admin" >
                            <input class="date_event[]" id="date" type="datetime-local" value="" name="date_event[]" >
                            <button type="button"  onclick="document.getElementById('date').value = ''">удалить</button>
                        </div>
                    <button type="button"  onclick=" add(); "> Добавить еще</button>
                </div>
                <script>
                    function add(){
                        const $input = document.createElement("input");
                        $input.type = "datetime-local";
                        $input.id='date';
                        $input.name="date_event[]";
                        const $date = document.querySelector('#dates');
                        $date.appendChild($input);

                        const $button = document.createElement("button");
                        $button.type = "button";
                        $button.textContent = 'удалить';
                        $button.addEventListener('click', () => { document.getElementById('date').value = '';});
                        $date.appendChild($button);

                        return <?=$i=$i+1;?>;
                    }
                </script>
            </div>
            <button type="submit" class="button" >Добавить событие</button>
        </form>
    </div>
</div>


</body>
</html>
