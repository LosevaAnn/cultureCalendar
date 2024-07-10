<?php
require_once('db.php');

$description_event_crope = $_POST['description_event_crope'];
$description_event = $_POST['description_event'];
$name_event = $_POST['name_event'];
$id_category = $_POST['category'];
$place = ($_POST['place']);
$date_event = $_POST['date_event'];
$age_limit = $_POST['age_limit'];
$image=$_POST['image'];
$url_event = $_POST['url_event'];


$sql1= "SELECT * FROM category ORDER BY name_category ASC";
$result1 = mysqli_query($conn,$sql1);
while($cat = $result1->fetch_assoc())
{
    $catmas[] = $cat;
}
//сохранение данных в таблицу events
$sql_events = "INSERT INTO `events` 
    (id_event, name_event, description_event_crope, description_event, image, age_limit, date_added, url_event) 
VALUES (null, '$name_event', '$description_event_crope', '$description_event', '$image', '$age_limit', NOW(), '$url_event')";
mysqli_query($conn, $sql_events) or die(mysqli_error($sql_events));
$id_event=mysqli_insert_id($conn);

//сохранение места проведения
$sql_place = "INSERT INTO `events-place` (id, id_place, id_event) VALUES (null, '$place', '$id_event')";
mysqli_query($conn, $sql_place) or die(mysqli_error($sql_place));

//сохранение категорий
$N = count($id_category);
for($i=0; $i < $N; $i++)
{
    $var1=$id_category[$i];
    include ('db.php');

    $sql_category = "INSERT INTO `events-category` (id, id_event, id_category) ".
        "VALUES (null, '$id_event', '$var1')";
    mysqli_query($conn, $sql_category) or die(mysqli_error($sql_category));

}
//сохранение дат

$N = count($date_event);
for($i=0; $i < $N; $i++)
{
    $var2=$date_event[$i];
    if ($var2 != ""){
        include ('db.php');

        $sql_date = "INSERT INTO `events-date` (id, id_event, date_event) ".
            "VALUES (null, '$id_event', '$var2')";
        mysqli_query($conn, $sql_date) or die(mysqli_error($sql_date));
    }
}
header('Location:https:add_new_event.php');