<?php
session_start();
include '../connect.php';
if(isset($_POST['addtrade'])){
    $uname=$_POST['tname'];
    $sector = $_POST['sector'];
    $level = $_POST['level'];
    $select = $conn->query("select*from trade where tname='$uname' and level='$level'");
    if (!preg_match('/^[a-zA-Z0-9 ]*$/',$uname)) {
        ?>
        <script>
           alert('incorect trade name')
           window.history.back()

        </script><?php

    }elseif(mysqli_num_rows($select)>0){
        ?>
        <script>
            alert('trade name exist')
            window.history.back()
        </script><?php
    }else{
        $insert = $conn->query("insert into trade values(null,'$uname','$level','$sector')");
        if ($insert) {
            ?>
        <script>
            alert('trade added')
            window.location.href='home.php?trade'
        </script><?php
        }

    }
}

if(isset($_POST['updatetrade'])){
    $uname=$_POST['tname'];
    $id=$_POST['id'];
    
    $sector = $_POST['sector'];
    $level = $_POST['level'];
    $select = $conn->query("select*from trade where tname='$uname' and level='$level' and tid<>$id");
    if (!preg_match('/^[a-zA-Z0-9 ]*$/',$uname)) {
        ?>
        <script>
           alert('incorect trade name')
           window.history.back()

        </script><?php

    }elseif(mysqli_num_rows($select)>0){
        ?>
        <script>
            alert('trade name exist')
            window.history.back()
        </script><?php
    }else{
        $insert = $conn->query("update trade set tname='$uname',level='$level',sector='$sector' where tid='$id'");
        if ($insert) {
            ?>
        <script>
            alert('trade updated')
            window.location.href='home.php?trade'
        </script><?php
        }

    }
}

if(isset($_POST['addtrainee'])){
    $fname=$_POST['fname'];
    $lname = $_POST['lname'];
    $gender= $_POST['gender'];
    $tradeid = $_POST['tradeid'];
    if (!preg_match('/^[a-zA-Z ]*$/',$fname)) {
        ?>
        <script>
           alert('incorect first namename')
           window.history.back()

        </script><?php  
    }elseif (!preg_match('/^[a-zA-Z ]*$/',$lname)) {
        ?>
        <script>
           alert('incorect last name')
           window.history.back()

        </script><?php

    }else{
        $insert = $conn->query("insert into trainee values(null,'$fname','$lname','$gender','$tradeid')");
        if ($insert) {
            ?>
        <script>
            alert('traineee added')
            window.location.href='home.php?trainees'
        </script><?php
        }

    }
}

if(isset($_POST['updatetrainee'])){
    $fname=$_POST['fname'];
    $lname = $_POST['lname'];
    $gender= $_POST['gender'];
    $id = $_POST['id'];
    $tradeid = $_POST['tradeid'];
    if (!preg_match('/^[a-zA-Z ]*$/',$fname)) {
        ?>
        <script>
           alert('incorect first namename')
           window.history.back()

        </script><?php  
    }
    elseif (!preg_match('/^[a-zA-Z ]*$/',$lname)) {
        ?>
        <script>
           alert('incorect last name')
           window.history.back()

        </script><?php

    }else{
        $insert = $conn->query("update trainee set firstname='$fname',lastname='$lname',gender='$gender',tradeid='$tradeid' where sid='$id'");
        if ($insert) {
            ?>
        <script>
            alert('traineee updated')
            window.location.href='home.php?trainees'
        </script><?php
        }

    }
}

if(isset($_POST['addmodule'])){
    $mname=$_POST['mname'];
    $credit = $_POST['credit'];
    $select = $conn->query("select*from modules where mname='$mname'");
    if (!preg_match('/^[a-zA-Z ]*$/',$mname)) {
        ?>
        <script>
           alert('incorect module name')
           window.history.back()

        </script><?php

    }elseif(mysqli_num_rows($select)>0){
        ?>
        <script>
            alert('module name exist')
            window.history.back()
        </script><?php
    }else{
        $insert = $conn->query("insert into modules values(null,'$mname','$credit')");
        if ($insert) {
            ?>
        <script>
            alert('module added')
            window.location.href='home.php?modules'
        </script><?php
        }

    }
}

if(isset($_POST['updatemodule'])){
    $mname=$_POST['mname'];
    $credit = $_POST['credit'];
    $id= $_POST['id'];
    $select = $conn->query("select*from modules where mid<>'$id' and mname='$mname'");
    if (!preg_match('/^[a-zA-Z ]*$/',$mname)) {
        ?>
        <script>
           alert('incorect module name')
           window.history.back()

        </script><?php

    }elseif(mysqli_num_rows($select)>0){
        ?>
        <script>
            alert('module name exist')
            window.history.back()
        </script><?php
    }else{
        $insert = $conn->query("update modules set mname='$mname',mcredit='$credit' where mid='$id'");
        if ($insert) {
            ?>
        <script>
            alert('module updated')
            window.location.href='home.php?modules'
        </script><?php
        }

    }
}


if(isset($_POST['addmarks'])){
    $trainee=$_POST['trainee'];
    $trade = $_POST['trade'];
    $module =$_POST['module'];
    $user = $_SESSION['id'];
    $fass= $_POST['fass'];
    $sass = $_POST['sass'];
    $cass = $_POST['cass']; 
     $tot =($fass+$sass+$cass)/300*100;
    $select = $conn->query("select*from marks where traineeid='$trainee' and tradeid='$trade' and moduleid='$module'");
    if(mysqli_num_rows($select)>0){
        ?>
        <script>
           alert('this marks notrecorded becouse was recorded')
           window.history.back()

        </script><?php
    }else{
        // var_dump("insert into marks values(null,'$trainee','$trade','$module','$user','$fass','$sass','$cass','$tot')");die();  
        $insert = $conn->query("insert into marks values(null,'$trainee','$trade','$module','$user','$fass','$sass','$cass','$tot')");
        if ($insert) {
            ?>
        <script>
            alert('marks added')
            window.location.href='home.php?marks'
        </script><?php
        }
    }
    
}

if(isset($_POST['updatemarks'])){
    $id = $_POST['id'];
    $trainee=$_POST['trainee'];
    $trade = $_POST['trade'];
    $module =$_POST['module'];
    $user = $_SESSION['id'];
    $fass= $_POST['fass'];
    $sass = $_POST['sass'];
    $cass = $_POST['cass']; 
     $tot =($fass+$sass+$cass)/300*100;
    $select = $conn->query("select*from marks where markdid<>'$id' and traineeid='$trainee' and tradeid='$trade' and moduleid='$module'");
    if(mysqli_num_rows($select)>0){
        ?>
        <script>
           alert('this marks notrecorded becouse was recorded')
           window.history.back()

        </script><?php
    }else{
        // var_dump("insert into marks values(null,'$trainee','$trade','$module','$user','$fass','$sass','$cass','$tot')");die();  
        $insert = $conn->query("update marks set traineeid='$trainee',tradeid='$trade',moduleid='$module',userid='$user',
        fass='$fass',sass='$sass',cass='$cass',total='$tot' where markdid='$id'");
        if ($insert) {
            ?>
        <script>
            alert('marks updated')
            window.location.href='home.php?marks'
        </script><?php
        }
    }
    
}
?>