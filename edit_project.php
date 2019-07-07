<?php
require "db_config.php";
session_start();


if (isset($_POST['approve'])) {
    $_SESSION['project'] = $_POST['projectId'];

    approve();
}
if (isset($_POST['comment'])) {

    $_SESSION['project'] = $_POST['projectId'];

    writeComment();
}


if (isset($_POST['students'])) {

    $_SESSION['project'] = $_POST['projectId'] || $_SESSION['project'] ;

    seeStudents();
}

if (isset($_POST['comments'])) {

    $_SESSION['project'] = $_POST['projectId'];

    seeComments();
}
if (isset($_POST['new_project'])) {
    $_SESSION['project'] = $_POST['projectId'];
    addNewProject();
}


function approve()
{
    require "db_config.php";
    $project =$_SESSION['project'];
    echo $project;
    $sql = "select * from projects where id='$project'";
    $query = $conn->query($sql) or die("Не е намерен проект с това Id");
    $pr = $query->fetch(PDO::FETCH_ASSOC);
    print_r($pr);
    $sql = "update students set projectId='".$pr['id']."' where username='".$pr['requested']."';";
    $query = $conn->query($sql) or die(" Не успяхме да одобрим този проект!");

    $sql = "update projects set requested='1' where id='$project';";
    $query = $conn->query($sql) or die(" Не успяхме да одобрим този проект!");
    header("location: success_operation.html");
   
}
function writeComment()
{
    header("location: write_comment.php");
}

function seeStudents(){
    header("location: students.php");
}

function addNewProject()
{
    header("location: add_project.php");
}

function seeComments(){
    header("location: comments.php");
}

?>