<?php

if (empty($_COOKIE['user'])){
    setcookie('admin', $row['firstname_lastname'], time()-3600, "/");
    header('Location: index.php');
}
else{
setcookie('user', $row['email'], time()-3600, "/");
header('Location: index.php');}

