<?php 
    session_start();
    if ($_SESSION['username']){
        $page="projects.php";
        $login_error = $_SESSION['login_error'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="stylesheets/reset.css">
    <link rel="stylesheet" href="stylesheets/style.css">
  
    <title>Грешни данни</title>
</head>
<body>

    <div class="container">
        <h3 class="centered info"><?php echo $login_error;?></h3>
        <button onclick="window.location.href='<?php echo $page;?>'">Назад</button>
   
            
    </div>
   
</body>
</html> 