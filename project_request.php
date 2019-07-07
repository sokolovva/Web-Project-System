
<?php
    require "db_config.php";
    session_start();
    $_SESSION['is_student']=true;
    
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['project'])){
            $project= $_POST['project'];
            $sql = "SELECT * FROM projects WHERE id='$project'";
            $query = $conn->query($sql) or die(" Не съществува потребител с тези данни!");
            $row = $query->fetch(PDO::FETCH_ASSOC);
            if($row) {
            $user = $_SESSION['username'];
            $sql = "UPDATE projects SET requested='$user' WHERE id='$row[id]'";
            echo $sql;
            $query = $conn->query($sql) or die(" Не съществува потребител с това ЕГН!");
            $row = $query->fetch(PDO::FETCH_ASSOC);
            header("location: success_operation.html");
            }else {
                //there is no such username in db
                $_SESSION['login_error'] = "Не съществува потребител с това потребителско име!";
                header("location: invalid_user.php");
            }
        }
        else echo "not set!";
        
    }
	
?>