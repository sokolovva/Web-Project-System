<?php
    session_start();
    if ( isset($_SESSION['is_student']))  {
        if ($_SESSION['is_student']==true){
            header("location: index.html");
        }
    }
?>


<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <title>Система за класиране на кандидат студенти</title> -->
    <link rel="stylesheet" href="stylesheets/reset.css">
    <link rel="stylesheet" href="stylesheets/style.css">
    <link rel="stylesheet" href="stylesheets/login.css">
    <script src="javascript/students.js"></script>
</head>

<body>
     <header>
        <img src="images/logo.png" alt="logo" id='logo'>
        <h1>Профил на преподавател</h1>
    </header>
    <button class="top-right" onclick="window.location.href='teacher_login.html'">Назад</button>
    
     <div class="container">
            <ul class="menu">
                <li>
                    <a href="projects.html">
                        Активни проекти
                    </a>
                </li>
                <li>
                    <a href="proposed_projects.html">Проекти, чакащи одобрение/редакция</a>
                </li>
            </ul>
    </div>

    


</body>

</html>