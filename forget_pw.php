<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>忘記密碼</title>
</head>
<body>
<?php
    if(isset($_POST['email'])){
        $dsn="mysql:host=localhost;dbname=member;charset=ust8";
        $pdo=new PDO($dsn,'root','');
        $sql="select * from login where email='{$_POST['email']}'"; //在外面工作時{$_POST['email']}不能直接放入SQL語法
        //我們不能期待使用者都會KEY入正確的資料，所以在POST資料進資料庫的時候，需要先將資料做檢查，將傷害降到最小
        $chk=$pdo->query($sql)->fetch();
        if(!empty($chk)){

            $res=$chk['pw'];
        }else{
            $res="查無此人";
        }
        

    }

?>



    <form action="?" method="POST">  <!--透過這個POST的資料去查詢密碼是否存在-->
        <input type="text" name="email" id="">
        <input type="submit" value="查詢">
    
    
    </form>

    <span>
        <?php 
                if(isset($res)){

                    echo $res;
                } 
        ?>
        </span>

</body>
</html>