<?php 
session_start();
if (!isset($_SESSION['id']) or !isset($_SESSION['uname'])) {
    header('location:../login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="header">
        trainee information management information system 
    </div>
    <div class="body">
        <div class="left">
            <a href="?trades">trade</a>
            <a href="?trainees">trainees</a>
            <a href="?modules">modules</a>
            <a href="?marks">marks</a>
            <a href="?report">report</a>
            <a onclick="return confirm('are you sure you want to log out')" href="logout.php">logout(<?=$_SESSION['uname']?>)</a>

        </div>
        <div class="right">
            <?php
             if (isset($_GET['trades'])) {
                include 'trade.php';
            }elseif (isset($_GET['trainees'])) {
                include 'trainees.php';
            }elseif (isset($_GET['modules'])) {
                include 'module.php';
            }
            elseif (isset($_GET['marks'])) {
                include 'marks.php';
            }
            elseif (isset($_GET['report'])) {
                include 'report.php';
            }
            elseif (isset($_GET['view'])) {
                include 'view.php';
            }
            else {
                include 'trade.php';
            }?>
        </div>
    </div>
    <div class="footer">
    trainee information management information system&copy2024
    </div>
</body>
</html>