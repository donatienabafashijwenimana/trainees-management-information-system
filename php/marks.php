<?php
include '../connect.php';
$select = $conn->query("select*from marks,trade,trainee,modules,user 
 where sid=traineeid and tid=marks.tradeid and uid=userid and mid=marks.moduleid");
$selcttrade = $conn->query("select*from trade");
$selecttrainee = $conn->query("select*from trainee");
$selectmodule = $conn->query("select*from modules");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <label for="">marks</label>
        <div class="report">
    <form action="#" method="post">
        <select name="trade" id="">
            <?php
            foreach($selcttrade as $y){?>
            <option value="<?=$y['tid']?>"><?=$y['level'].' '.$y['tname']?></option>
            <?php }?>
        </select>
        <input type="submit" value="generate" name='generate'>
    </form>
   </div>
   <?php if(isset($_POST['generate'])){
    $select = $conn->query("select*from trainee left join trade on trade.tid=tradeid left join 
    marks on marks.traineeid=sid left join modules on mid=moduleid left join user on uid=userid where tid='{$_POST['trade']}';
      ");
    if (mysqli_num_rows($select)<=0) {

    ?>
    <h1>!! no result found</h1>
    <?php }else{?>
    <div class="table">
       <table border='1' width='100%'>
        <thead>
            <th>id</th>
            <th>user</th>
            <th>trainee</th>
            <th>module</th>
            <th>trade</th>
            
            <th>FA</th>
            <th>SA </th>
            <th>CA</th>
            <th colspan='2'>action</th>
        </thead>
        <?php $y=1; foreach($select as $x){?>
            <tr>
                <td><?=$y++?></td>
                <td><?=$x['uname']==null?"none":$x['uname'];?></td>
                <td><?=$x['firstname'].' '.$x['lastname']?></td>
                <td><?=$x['mname']==null?"none":$x['mname'];?></td>
                <td><?=$x['level'].' '.$x['tname']?></td>
                
                <td><?=$x['fass']==null?"none":$x['fass'];?></td>
                <td><?=$x['sass']==null?"none":$x['sass'];?></td>
                <td><?=$x['cass']==null?"none":$x['cass'];?></td>
                <td><a href="?marks&&add=<?=$x['sid']?>"><button>add</button></a></td>
                <td><a href="?marks&&up=<?=$x['markdid']?>"><button>update</button></a></td>
                <td><a onclick="return confirm('are you sure want to delete marks of <?=$x['firstname'].' '.$x['lastname']?>')" href="delete.php?mark=<?=$x['markdid']?>"><button>delete</button></a></td>
            </tr>
            <?php }?>
       </table>
    </div>
       
<?php 
    }
}else{?>
<h1>?select trade to view marks</h1>
<?php } ?>
    <div class='<?=isset($_GET['add'])?"form":"formh"?>'>
        <?php
        $select2 = $conn->query("select* from trainee,trade where tradeid=tid and sid='{$_GET['add']}'") ;
        $z= mysqli_fetch_array($select2);
        ?>
         
        <form action="add.php" method="post">
            <a href='?marks' class="close">&times;</a>
            <div class="hf">add marks</div>
            <label for="">trainee</label>
            <select name="trainee" id="">
                    <option value="<?=$z['sid']?>"><?=$z['firstname'].' '.$z['lastname']?></option>
            </select>
            <label for="">trade</label>
            <select name="trade" id="">
                    <option value="<?=$z['tid']?>"><?=$z['level'].' '.$z['tname']?></option>
            </select>
            <label for="">module</label>
            <select name="module" id="">
            <?php foreach ($selectmodule as $y){?>
                    <option value="<?=$y['mid']?>"><?=$y['mname']?></option>
                <?php }?>
            </select>
            <label for="">formative assessment</label>
            <input type="number" name="fass" id=""max='100' min='0' required>
            <label for="">summative assessment</label>
            <input type="number" name="sass" id=""max='100' min='0' required>
            <label for="">comprhesive assessment</label>
            <input type="number" name="cass" id="" max='100' min='0' required>
            <input type="submit" value="add marks" name='addmarks'>
        </form>
    </div>


    <div class='<?=isset($_GET['up'])?"form":"formh"?>'>
         <?php 
          $select2 =$conn->query("select*from marks,trade,trainee,modules,user 
          where sid=traineeid and tid=marks.tradeid and uid=userid and mid=marks.moduleid and markdid='{$_GET['up']}'");
         $z= mysqli_fetch_array($select2);
         ?>
         
         <form action="add.php" method="post">
            <a href='?marks' class="close">&times;</a>
            <div class="hf">add marks</div>
            <input type="hidden" name="id" value='<?=$_GET['up']?>'>
            <label for="">trainee</label>
            <select name="trainee" id="">
            <option value="<?=$z['sid']?>"><?=$z['firstname'].' '.$z['lastname']?></option>
            </select>
            <label for="">trade</label>
            <select name="trade" id="">
            <option value="<?=$z['tid']?>"><?=$z['level'].' '.$z['tname']?></option>
            </select>
            <label for="">module</label>
            <select name="module" id="">
            <option value="<?=$z['mid']?>"><?=$y['mname']?></option>
            <?php foreach ($selectmodule as $y){?>
                    <option value="<?=$y['mid']?>"><?=$y['mname']?></option>
                <?php }?>
            </select>
            <label for="">formative assessment</label>
            <input type="number" name="fass" id=""max='100' min='0' required value="<?=$z['fass']?>">
            <label for="">summative assessment</label>
            <input type="number" name="sass" id=""max='100' min='0' required value="<?=$z['sass']?>">
            <label for="">comprhesive assessment</label>
            <input type="number" name="cass" id="" max='100' min='0' required value="<?=$z['cass']?>">
            <input type="submit" value="updte marks" name='updatemarks'>
        </form>
    </div>
</body>

</html>

