<?php
global $conn;
$servername='MySQL-8.0';
$username='root';
$password='';
$dbname='BD';


    $conn= mysqli_connect($servername, $username, $password, $dbname);

// function searchInTitle($text) {
//     $text=trim(strip_tags(stripcslashes(htmlspecialchars($text))));
//     global $pdo;
//     $sql= "SELECT * FROM events WHERE name_event LIKE '%$text%' ORDER BY date_added DESC";
//     $query=$pdo->prepare($sql);
//     $query=execute();
//     return $query->fetchAll();
// }




//if (!$conn){
    //die("Connection failed: " . mysqli_connect_error());
//} else {
    //echo "Успех";
//}
