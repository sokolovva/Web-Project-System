
<?php
require "db_config.php";
session_start();

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="stylesheets/reset.css">
    <link rel="stylesheet" href="stylesheets/style.css">
    <link rel="stylesheet" href="stylesheets/login.css">
</head>

<body>
     <header>
        <img src="pictures/logo.png" alt="logo" id='logo'>
        <h1>Система за управление на проекти</h1>
                <p>Профил</p>
    </header>

      <div class='menu'>
        <ul>
        <li>
       <a href='profiles.php'>Моят профил</a>
   </li>
   <li>
       <a href='projects.php'>Проекти</a>
   </li>
        </ul>
</div>

        <button class='top-right' onclick="window.location.href='index.html'">Излез</button>
    <?php

    echo "
        <div class='container'>";
   
    $sql = "SELECT * FROM students WHERE username='$username'";
    $query = $conn->query($sql) or die(" Не съществува потребител с тези данни!");
    $row = $query->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM students WHERE projectId='".$row['projectId']."'";
    $query = $conn->query($sql) or die(" Не съществува потребител с тези данни!");
    $students = $query->fetch(PDO::FETCH_ASSOC);

    echo "<h1> Здравей, " . $row['username'] . "!</h1>";
    $sql = "SELECT * FROM projects WHERE id='".$row['projectId']."'";
    $query = $conn->query($sql) or die(" lala!");
    $row = $query->fetch(PDO::FETCH_ASSOC);
    if ($row){
        echo "<p class='info'>Вашият проект </p> ";
       
        echo "<form method='post' action='edit_project.php'><table class='table'><tr>
        <th>Избери</th>
        <th>Заглавие</th>
        <th>Описание</th>
        <th>Проект</th></tr>
       
        <tr><td><input type='radio' id='asd' name='projectId' value='" . $row['id']. "' required></td>
        <td>".$row['title']."</td>
        <td>".$row['description']."</td>";
        echo $row['project'];
        if ($row['project'] !=''){
           echo "<td><a href='./files/".$row['project']."' download>".$row['project']."</a></td>
        </tr></table>";
        } else {
            echo "<td>Няма добавен</td>
            </tr></table>";
        }
        
        $_SESSION['project'] = $row['id'];
        if ($row['project']) {
            $value = "Добави редактиран";
        } else {
            $value = "Качи проект";
        } 
        echo "<input type='submit' name='new_project' value='".$value."'><input type='submit' name='students' value='Виж студенти'></form>";
    } else {
        $sql = "SELECT * FROM projects WHERE requested='$username'";
        $query = $conn->query($sql) or die("asd!");
        $row = $query->fetch(PDO::FETCH_ASSOC);
        if($row){
            echo "<p class='info'>Вие сте изпратили заявка за проект ".$row['title'].", но тя все още не е одобрена.</p> <br>
            <p class='info'>Когато бъде одобрена от преподавател ще имате възможността да качите проект.</p>";
        } else {
            echo "<p class='info'>Вие все не сте избрали проект. Може да изберете от списъка по долу.</p>
            <div class='container'>
            <h1>Избери проект</h1>";
            //requested TODO
    $sql = "SELECT * FROM projects WHERE  requested='0' || requested='1'";
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
            echo "<form action='project_request.php' method='POST'>";
            echo "<tr> <td> <input type='radio' id='projectRadio' name='project' value='" . $projects[$i]['id'] . "'></td>
                    <td>" . $projects[$i]['title'] . "</td>
                    <td>". $projects[$i]['description'] ."</td></tr>";
        }
        echo "<input class='submit-btn' type='submit' value='Изпрати заявка за проект'></form>";
    } else {
        echo "<div class='info'> Няма проекти в тази категория </div>";
    }
    echo "</table></div>";
        }

    }
    ?>

</body>
</html>
    