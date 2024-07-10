<?php
require_once ('db.php');
    $email = $_COOKIE['user'];
    $event_id = $_POST['id_event'];

// Проверка наличия товара в избранном
    $query = "SELECT * FROM favourites WHERE email ='$email' AND id_event ='$event_id'";
    $result= mysqli_query($conn, $query);

// Добавление товара в избранное, если его там нет
    if ($result->num_rows > 0) {
        $query = "DELETE FROM favourites WHERE email ='$email' AND id_event ='$event_id'";
        mysqli_query($conn, $query);
    } else {
        $query = "INSERT INTO favourites (email, id_event) VALUES ('$email', '$event_id')";
        mysqli_query($conn, $query);
    }

