<?php
    require "db_config.php";
    session_start();
    if ($_SESSION['username']==""){
        header("location: index.html");
    }
    $myegn= $_SESSION['username'];
    $sql = "SELECT * FROM students WHERE username=$myegn";
    $query = $conn->query($sql) or die("  failed!");
    $row = $query->fetch(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <title>Система за класиране на кандидат студенти</title> -->
    <link rel="stylesheet" href="stylesheets/reset.css">
    <link rel="stylesheet" href="stylesheets/style.css">
    <link rel="stylesheet" href="stylesheets/login.css">
</head>
<body>
     <header>
        <img src="images/logo.png" alt="logo" id='logo'>
        <h1>Профил на кандидат-студента</h1>
    </header>
    <button class="top-right" onclick="window.location.href='student_login.html'">Назад</button>
    
     <div class="container">
            <h2>Информация за кандидат-студента</h2>
            <ul class="col-2">
                <li>Име:
                    <?php echo $row['name']; ?>
                </li>
                <li>ЕГН: 
                     <?php echo $row['EGN']; ?>
                </li>
                <li>Програма: 
                    <?php echo $row['program']; ?>
                </li>
                <li>Телефон: +359 
                    <?php echo $row['mobile']; ?>
                </li>
                <li>Имейл: 
                    <?php echo $row['email']; ?>
                </li>
                <li>Пол: 
                    <?php echo $row['gender']; ?>
                </li>
            </ul>
        <h2>Оценки от изпити и бал</h2>
        <table id="results">
            <tr>
                <th>Оценка от изпит</th>
                <th>Оценка от дипломата</th>
                <th>Бал /18</th>
            </tr>
            <tr>
                <td><?php echo $row['exam']; ?></td>
                <td><?php echo $row['diploma']; ?></td>
                <td><?php echo $row['total_grade']; ?></td>
            </tr>
        </table>
        <?php
            $wish = $row['accepted_at'];
            $res="";
            if ($wish==""){
                $res="Студентът не е приет";
            }
            else{
                $major_accepted = $row[$wish];
                $res="Студентът е приет на ". $wish ." в специалност ". $major_accepted;
            }
        ?>
        
        <p>Резултат: <?php echo $res; ?>!</p>
        
            <h2>Класиране по специалности -  <?php echo $row['program']; ?> </h2>
            <?php
                $pr = $row['program'];
                $_SESSION["program"] = $pr; //this is needed by ranklist.php
                $get_majors="SELECT title FROM majors WHERE type='$pr'";
                $query2 = $conn->query($get_majors) or die("  failed!");
                $majors = $query2->fetchAll(PDO::FETCH_ASSOC);
            ?>
            
            <ul>
                <li>
                    <a href="ranklist.php?major=1"> <?php echo $majors[0]['title']; ?></a>
                </li>
                <li>
                    <a href="ranklist.php?major=2"> <?php echo $majors[1]['title']; ?></a>
                </li>
                <li>
                    <a href="ranklist.php?major=3"> <?php echo $majors[2]['title']; ?></a>
                </li>
                <li>
                    <a href="ranklist.php?major=4"> <?php echo $majors[3]['title']; ?></a>
                </li>
            </ul>
     
    </div>
</body>
</html>