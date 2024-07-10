<?php
require_once ('db.php');
$sql="SELECT * FROM users";
$result=mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <link rel='stylesheet' href='style.css'>
    <link rel="" href="windowreg.php">

    <title>What's On Now?</title>
    <!-- CSS FOR STYLING THE PAGE -->
    <style>
        table {
            margin: 0 auto;
            font-size: large;
            border: 1px solid black;
        }
        h1 {
            padding-top: 20px;
            padding-bottom: 20px;
            text-align: center;
            color: #48036F;
            font-size: xx-large;
            margin: 0;
            font-family: 'Gill Sans', 'Gill Sans MT',
            ' Calibri', 'Trebuchet MS', 'sans-serif';
        }
        th {
            background-color: #B9F73E;
            border: 1px solid black;
        }
        td {
            background-color: #F5F5F5;
            border: 1px solid black;
        }
        th,
        td {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }

        td {
            font-weight: lighter;
        }
    </style>
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
    <div class="container">
            <h1>Пользователи</h1>
            <!-- TABLE CONSTRUCTION -->
            <table>
                <tr>
                    <th>Логин</th>
                    <th>Пароль</th>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Пол</th>
                    <th>Дата рождения</th>
                    <th>Статус</th>
                    <th>Удалить</th>
                    <th>Заблокировать</th>
                    <th>Разблокировать</th>
                </tr>
                <!-- PHP CODE TO FETCH DATA FROM ROWS -->
                <?php
                // LOOP TILL END OF DATA
                while($rows=$result->fetch_assoc())
                {
                    ?>
                    <tr>
                        <!-- FETCHING DATA FROM EACH
                            ROW OF EVERY COLUMN -->
                        <td><?php echo $rows['email'];
                        $email=$rows['email']?></td>
                        <td><?php echo $rows['pass'];?></td>
                        <td><?php echo $rows['first_name'];?></td>
                        <td><?php echo $rows['last_name'];?></td>
                        <td><?php echo $rows['gender'];?></td>
                        <td><?php echo $rows['date_birth'];?></td>
                        <td><?php if ($rows['access']==0): echo "ok"; else: echo "заблокирован"; endif;?></td>
                        <td><a href="delete_user.php?email=<?=$rows['email']?>">удалить</a></td>
                        <td><a href="block_user.php?email=<?=$rows['email']?>">заблокировать</a></td>
                        <td><?php if ($rows['access']==1):?><a href="unblock_user.php?email=<?=$rows['email']?>">Разблокировать<?php endif;?></a></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
    </div>

</header>
</body>
</html>