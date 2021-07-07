<?php
    include_once "base.php";
?>


<?php
//處理新增使用者功能

    $acc=$_POST['acc'];
    $pw=$_POST['pw'];
    $name=$_POST['name'];
    $birthday=$_POST['birthday'];
    $addr=$_POST['addr'];
    $email=$_POST['email'];
    $education=$_POST['education'];

    //會收到七筆資料，資料要拆到兩張不同的資料表
    //寫入的順序很重要，先將login的id做完後，再去寫入預設的MEMBER資料庫

    $insertToLogin="insert into `login`(`acc`,`pw`,`email`) values('$acc','$pw','$email')";
    // echo $insertToLogin;
    // $pdo->query();    //要宣告資料庫的連線，query會回傳執行指另的結果[是否成功]
    $pdo->exec($insertToLogin);      //exec通常用於寫入資料，但是不會將資料印出，跟query不一樣

    // echo $insertToLogin;
    // echo $pdo->query($insertToLogin);

    //因為要關連資料庫，要知道新增資料的$login_id

    $selectLoginUser="select * from `login` where `acc`='$acc' && `pw`='$pw'";
    $loginUser=$pdo->query($selectLoginUser)->fetch();
    $login_id=$loginUser['id'];
    // echo "<br>使用者ID是";
    // echo $login_id;

    //寫入使用者資料表(關連)：
    $insertToMember="insert into `member`(`name`,`birthday`,`role`,`addr`,`education`,`login_id`) values('$name','$birthday','會員','$addr','$education','$login_id')";
    // echo "新增完成";

    //寫入發票號碼資料表(關連)：
    //因為要關連資料庫，要知道新增資料的$login_id
    $selectLoginUser="select * from `login` where `acc`='$acc' && `pw`='$pw'";
    $loginUser=$pdo->query($selectLoginUser)->fetch();
    $login_id=$loginUser['id'];

    $insertToInvoices="insert into `invoices`(`acc`,`login_id`) values('$acc','$login_id')";
    $result1=$pdo->exec($insertToInvoices);
    $result=$pdo->exec($insertToMember);
    if($result || $result1){
        header("location:main_normal.php?meg=新增成功");  //如果成功的話會將使用者導回首頁
    }else{
        header("location:main_normal?meg=新增失敗");  //如果失敗的話也會將使用者導回首頁

    }


?>

<?php
    include_once('footer.php');
?>