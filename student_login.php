
<?php
    require "db_config.php";
    session_start();
    $_SESSION['is_student']=true;
    
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['username'])){
            $username= $_POST['username'];
            $sql = "SELECT * FROM students WHERE username='$username'";
            $query = $conn->query($sql) or die(" Не съществува потребител с тези данни!");
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $password= $_POST['pass'];
            if($row) {
                $password = md5($row['password']);
                $correct_password = $password;
                if ($password != $correct_password){
                    $_SESSION['login_error'] = "Грешна парола!";
                    header("location: invalid_user.php");
                }
                else {
                    $_SESSION["username"] = $username;
                    header("location: projects.php");
                }
            }else {
                $_SESSION['login_error'] = "Не съществува потребител с това потребителско име!";
                header("location: invalid_user.php");
            }
        }
        else echo "not set!";
        
    }
	
?>