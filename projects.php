<?php
require "db_config.php";
session_start();
$username=$_SESSION['username'];

?> 

<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Проекти</title> 
    <link rel="stylesheet" href="stylesheets/reset.css"> 
    <link rel="stylesheet" href="stylesheets/style.css">
    <link rel="stylesheet" href="stylesheets/checkbox.css">
</head>
<body>
     <header>
        <img src="pictures/logo.png" alt="logo" id='logo'>
        <h1>Система за управление на проекти</h1>
    </header>
    <?php
    if ($_SESSION['is_student'] == true) {
        echo "<div class='menu'>
                    <ul>
                    <li>
                <a href='profiles.php'>Моят профил</a>
            </li>
            <li>
                <a href='projects.php'>Проекти</a>
            </li>
                    </ul>
            </div>";
    } else {
        echo "<div class='menu'>
                    <ul>
            <li>
                <a href='projects.php'>Проекти</a>
            </li>
                    </ul>
            </div>";
    } ?>
     
</div> <button class="top-right"  onclick="window.location.href='index.html'">Излез</button>
    <main>
   


<div class="container">
<h1>Неизбрани проект</h1>
<?php
$sql = "SELECT * FROM projects WHERE requested='0'";
$query = $conn->query($sql) or die("  failed!");
$projects = $query->fetchAll(PDO::FETCH_ASSOC);
$projects_cnt = count($projects);
if ($projects_cnt > 0) {
    echo "<table class='table'>
<tr>
<th>Избери</th>
 <th>Заглавие</th>
 <th>Описание</th>
 </tr>";
    for ($i = 0; $i < $projects_cnt; $i++) {
        echo "
        <form method='post' action='edit_project.php'><tr> <td> <input type='radio' name='projectId' value='".$projects[$i]['id']." required'>
                </td><td>".$projects[$i]['title'] . "</td>
                <td>".$projects[$i]['description'] . "</td></tr>"; 
    }
        echo "<input type='submit' name='comment' value='Напиши коментар'><input type='submit' name='comments' value='Виж коментарите'></form></div>";
} else {
    echo "<div class='info'> Няма проекти в тази категория </div>";
}
?>
</table>
</div>

<div class="container">
<h1>Чакащи одобрение проекти</h1>
<?php
$sql = "SELECT * FROM projects WHERE requested!='0' && requested!='1'";
$query = $conn->query($sql) or die("  failed!");
$projects = $query->fetchAll(PDO::FETCH_ASSOC);
$projects_cnt = count($projects);
if ($projects_cnt > 0) {
    echo "<table class='table'>
<tr>
<th>Избери</th>
 <th>Заглавие</th>
 <th>Описание</th>
 <th>Заявен от</th>
 </tr>";
    for ($i = 0; $i < $projects_cnt; $i++) {
        echo "
<form method='post' action='edit_project.php'><tr>
<td> <input type='radio' name='projectId' value='" . $projects[$i]['id'] . "' required></td><td>" . $projects[$i]['title'] . "</td><td>" . $projects[$i]['description']
                . "</td><td>". $projects[$i]['requested']."</td></tr>";
    }
    if($_SESSION['is_student']){
        echo "<input type='submit' name='comment' value='Напиши коментар'><input type='submit' name='comments' value='Виж коментарите'></form></div>";  
    } else {
        echo "<input type='submit' name='approve' value='Одобри'><input type='submit' name='comment' value='Напиши коментар'><input type='submit' name='comments' value='Виж коментарите'></form></div>";
    }
  
} else {
    echo "<div class='info'> Няма проекти в тази категория </div>";
}
?>

</table>
</div>

<div class="container">
<h1>Одобрени проекти</h1>
<?php
$sql = "SELECT * FROM projects WHERE requested='1'";
$query = $conn->query($sql) or die("  failed!");
$projects = $query->fetchAll(PDO::FETCH_ASSOC);
$projects_cnt = count($projects);
if ($projects_cnt > 0) {
    echo "<table class='table'>
<tr>
<th>Избери</th>
 <th>Заглавие</th>
 <th>Описание</th>
 <th>Проект</th>
 </tr>";
    for ($i = 0; $i < $projects_cnt; $i++) {
            echo "
<form method='post' action='edit_project.php'><tr>
<td> <input type='radio' id='asd' name='projectId' value='" . $projects[$i]['id'] . "' required></td><td>" . $projects[$i]['title'] . "</td><td>" . $projects[$i]['description'] . "</td>";
                if($projects[$i]['project'] !=''){
                    echo "<td><a href='./files/". $projects[$i]['project'] ."' download>" . $projects[$i]['project'] . "</a></td></tr>";
                } else {
                    echo "<td>Няма добавен</td></tr>";
                }
    }
    if($_SESSION['is_student']){
        echo "<input type='submit' name='comment' value='Напиши коментар'><input type='submit' name='comments' value='Виж коментарите'> <input type='submit' name='students' value='Виж студенти'></form></div>";  
    } else {
        echo "<input type='submit' name='new_project' value='Добави редактиран'><input type='submit' name='comment' value='Напиши коментар'><input type='submit' name='comments' value='Виж коментарите'> <input type='submit' name='students' value='Виж студенти'></form></div>";
    }
   
} else {
    echo "<div class='info'> Няма проекти в тази категория </div>";
}
?>

</table>
</div></main>
</body>
</html>

