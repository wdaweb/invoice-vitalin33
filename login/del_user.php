<?php
    $title="刪除使用者";
    include_once('header.php');
?>


<?php
  //刪除使用者

    $dsn="mysql:host=localhost;dbname=member;charset=utf8";
    $pdo=new PDO($dsn,'root','');



    $user_id=$_GET['id'];
    $sql1="delete from `login` where `id`='$user_id'";  //現在是兩張關聯的表，如果只刪除A表，B表中關聯的使用者還在，所以要關聯的資料都要一起做處理

    $sql2="delete from `member` where `login_id`='$user_id'";

    //建立提示畫面，因為delete是危險動作

    echo "您確定要刪除ID=".$user_id."的資料嗎？";
    ?>
        <a href='?id=<?=$user_id;?>&ask=true'><button class="btn btn-danger">確定</button></a>  <!--當前頁再跑一次ID並回傳選的是確定還是取消的值-->
        <a href='?id=<?=$user_id;?>&ask=false'><button class="btn btn-warning">取消</button></a>



    <?php
    //判斷是否真的要刪資料

        if(isset($_GET['ask'])){         //這邊不能用EMPTY

                switch($_GET['ask']){   

                    case 'true':  //如果得到{確認取消}的指令，則確認刪除
                        $pdo->exec($sql1);
                        $pdo->exec($sql2);
                        header("location:admin.php");
                    break;

                    case 'false':
                        header("location:admin.php");
                break;

                }

        }

?>

<?php
    include_once('footer.php');
?>
