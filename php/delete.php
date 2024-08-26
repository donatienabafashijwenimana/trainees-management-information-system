<?php
include '../connect.php';
if(isset($_GET['trade'])){
    $delete = $conn->query("delete from trade where tid='{$_GET['trade']}'");
    ?>
        <script>
            alert('trade deleted')
            window.location.href='home.php?trades'
        </script><?php
}
if(isset($_GET['trainee'])){
    $delete = $conn->query("delete from trainee where sid='{$_GET['trainee']}'");
    ?>
        <script>
            alert('trainee deleted')
            window.location.href='home.php?trainees'
        </script><?php
}
if(isset($_GET['modules'])){
    $delete = $conn->query("delete from modules where mid='{$_GET['modules']}'");
    ?>
        <script>
            alert('module deleted')
            window.location.href='home.php?modules'
        </script><?php
}
if(isset($_GET['mark'])){
    $delete = $conn->query("delete from marks where markdid='{$_GET['mark']}'");
    ?>
        <script>
            alert('marks deleted')
            window.location.href='home.php?marks'
        </script><?php
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
            window.location.href='home.php'
        </script><?php
        }
    }
    
}