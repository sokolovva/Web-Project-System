

<?php
require "db_config.php";
session_start();
$project=$_SESSION['project'];
$username = $_SESSION['username'];
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
    } ?>
     
</div> <button class="top-right"  onclick="window.location.href='projects.php'">Назад</button>
<p class='info add'> Добави проект: </p>
<form name='form1' enctype='multipart/form-data' method='POST' action='' class='smaller'>
     <input type='file'  name='f1'>
     <br>
     <input type='submit' name='submit1' value='Качи проект'>
</div>
     </form>
</body>


<?php
    if (isset($_POST["submit1"])) {
        $fnm = $_FILES["f1"]["name"];
        $dst = "./files/" . $fnm;
        $result = move_uploaded_file($_FILES["f1"]["tmp_name"], $dst);
        echo $dst;
        echo $result;
        if ($result) {
            echo $project;
            $sql = "UPDATE projects SET project='$fnm' WHERE id='$project'";
            $query = $conn->query($sql) or die(" Не съществува такъв проект!");
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $_SESSION['username']=$username;
            header("location: success_operation.html");
        } else {
            $_SESSION['login_error'] = "Нещо се обърка. Опитайте отново!";
        }
    }

    ?>