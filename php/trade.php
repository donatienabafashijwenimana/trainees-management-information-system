<?php
include '../connect.php';
$select = $conn->query("select*from trade");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="table">
        <label for="">trade</label>
        <a href="?trades&&add" class='add'><button>add</button></a>
       <table border='1' width='100%'>
        <thead>
            <td>tradeid</td>
            <th>tradename</th>
            <th>sector</th>
            <th colspan='2'>action</th>
        </thead>
        <?php $y=1; foreach($select as $x){?>
            <tr>
                <td><?=$y++?></td>
                <td><?=$x['level']." ".$x['tname']?></td>
                <td><?=$x['sector']?></td>
                <td><a href="?trades&&up=<?=$x['tid']?>"><button>update</button></a></td>
                <td><a onclick="return confirm('are you sure you want to delete <?=$x['level'].' '.$x['tname']?>')" href="delete.php?trade=<?=$x['tid']?>"><button>delete</button></a></td>
            </tr>
            <?php }?>
       </table>
    </div>
    <div class='<?=isset($_GET['add'])?"form":"formh"?>'>
         
        <form action="add.php" method="post">
            <a href='?trades' class="close">&times;</a>
            <div class="hf">add trade</div>
            <label for="">trade name</label>
            <input type="text" name="tname" id="">
            <label for="">level</label>
            <select name="level" id="">
                <option value="level3">level3</option>
                <option value="level4">level4</option>
                <option value="level5">level5</option>
            </select>
            <label for="">sector</label>
            <select name="sector" id="">
                <option value="ict and multimedia">ict and multimedia</option>
                <option value="hospitality and tourism">hospitality and tourism</option>
            </select>
            <input type="submit" value="add trade" name='addtrade'>
        </form>
    </div>
    <div class='<?=isset($_GET['up'])?"form":"formh"?>'>
         <?php 
         $select2 = $conn->query("select*from trade where tid='{$_GET['up']}'") ;
         $z= mysqli_fetch_array($select2);
         ?>
        <form action="add.php" method="post">
            <a href='?trades' class="close">&times;</a>
            <input type="hidden" name="id" value="<?=$_GET['up']?>">
            <div class="hf">add trade</div>
            <label for="">trade name</label>
            <input type="text" name="tname" id="" value='<?=$z['tname']?>'>
            <label for="">level</label>
            <select name="level" id="">
                <option value="<?=$z['level']?>"><?=$z['level']?></option>
                <option value="level3">level3</option>
                <option value="level4">level4</option>
                <option value="level5">level5</option>
            </select>
            <label for="">sector</label>
            <select name="sector" id="">
                <option value="<?=$z['sector']?>"><?=$z['sector']?></option>
                <option value="ict and multimedia">ict and multimedia</option>
                <option value="hospitality and tourism">hospitality and tourism</option>
            </select>
            <input type="submit" value="update trade" name='updatetrade'>
        </form>
    </div>
</body>
</html>

