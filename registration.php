
<?php

if (isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You are already logged in as admin";
    header('location: projects.php');
} 
?>
<?php

require "db_config.php";
    session_start(); 


$username = "";
$errors = array(); 

if (isset($_POST['reg_user'])) {
    $username = $_POST['username'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];
    $role = $_POST['role'];
  
    if (empty($username)) { array_push($errors, "Потребителстоко име е задължително"); }
    if (empty($password_1)) { array_push($errors, "Паролата е задължителна"); }
    if (empty($password_2)) { array_push($errors, "Повторната парола е задължителна");}
    if ($password_1 != $password_2) {
      array_push($errors, "Двете пароли не си съответсват");
    }
    if($role=='s'){
    $user_check_query = "SELECT * FROM students WHERE username='$username'";
    $query = $conn->query($user_check_query) or die("asd!");
    $user = $query->fetch(PDO::FETCH_ASSOC);
    } else {
        $user_check_query = "SELECT * FROM teachers WHERE username='$username'";
        $query = $conn->query($user_check_query) or die("asd!");
        $user = $query->fetch(PDO::FETCH_ASSOC);   
    }
    if ($user) {   
      if ($user['username'] === $username) {
        array_push($errors, "Потребителското име е заето");
      }
    }
  
    if (count($errors) == 0) {
        $password = md5($password_1);
        
        if($role=='s'){
            $query = "INSERT INTO students (username, password) 
            VALUES('$username',  '$password')";

        $query = $conn->query($query) or die("Не успяхме да създадем този акаунт!");
        } else {
            $query = "INSERT INTO teachers (username, password) 
            VALUES('$username',  '$password')";

        $query = $conn->query($query) or die("Не успяхме да създадем този акаунт!");
        }
       
        header('location: index.html');
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tuffin</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="stylesheets/style.css">
</head>
<body>
<button class="top-right"  onclick="window.location.href='index.html'">Назад</button>
    <div class="form_style">
    <h1>Регистрация</h1>
    <?php include('errors.php'); ?>
    <form method="post" action="registration.php">
       <div>
       <input type="text" name="username" placeholder="Потребителско име" />
       </div> 
        <div>
        <input type="password" name="password_1" placeholder="Парола" />
        </div>
<div>
<input type="password" name="password_2" placeholder="Повтори Парола" />
</div>
<div>
<input type="radio" id="student" name="role" value='s' />
<label for="student">Студент</label>
<input type="radio" id="teacher" name="role" value='t' />
<label for="teacher">Преподавател</label>
</div>
      
        <button type="submit" class="btn hyperlink" name="reg_user">Изпрати</button>

        <p>
  		    Имате акаунт? <a href="index.html" class="login-link">Вход</a>
  	    </p>
    </form>
    </div>
  </body>
</html>
