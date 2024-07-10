<?php
require_once('db.php');
$id_event=$_GET['id_event'];
$image=$_POST['image'];
$description_event_crope = $_POST['description_event_crope'];
$description_event = $_POST['description_event'];
$name_event = $_POST['name_event'];
$id_category = $_POST['category'];
$place = ($_POST['place']);
$date_event = $_POST['date_event'];
$age_limit = $_POST['age_limit'];
$url_event = $_POST['url_event'];

$sql11= "SELECT * FROM `events-category`, category 
         WHERE `events-category`.id_event='$id_event' 
           AND `events-category`.id_category=category.id_category 
         ORDER BY name_category ASC";
$result11 = mysqli_query($conn,$sql11);
while($catcat = $result11->fetch_assoc())
{
    $catcatmas[] = $catcat;
}
$sql1= "SELECT * FROM category ORDER BY name_category ASC";
$result1 = mysqli_query($conn,$sql1);
while($cat = $result1->fetch_assoc())
{
    $catmas[] = $cat;
}

//сохранение данных в таблицу events
$sql_events = "UPDATE events SET name_event='$name_event',  
                  description_event_crope='$description_event_crope', 
                  description_event = '$description_event', age_limit='$age_limit', url_event='$url_event'
                  WHERE id_event='$id_event'";
mysqli_query($conn, $sql_events) or die(mysqli_error($sql_events));
if ($conn->query($sql_events) === TRUE){
    header('refresh:0; url=edit_event.php?id_event='.$id_event);
}
if ($image !=""){
    $sql_image = "UPDATE events SET image='$image' WHERE id_event='$id_event'";
    mysqli_query($conn, $sql_image) or die(mysqli_error($sql_image));

}
//сохранение места проведения
$sql_place = "UPDATE `events-place` SET id_place='$place'
                  WHERE id_event='$id_event'";
mysqli_query($conn, $sql_place) or die(mysqli_error($sql_place));

//сохранение категорий
$sql_category_delete="DELETE FROM `events-category` WHERE id_event='$id_event'";
mysqli_query($conn, $sql_category_delete) or die(mysqli_error($sql_category_delete));
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
$sql_date_delete="DELETE FROM `events-date` WHERE id_event='$id_event'";
mysqli_query($conn, $sql_date_delete) or die(mysqli_error($sql_date_delete));
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








