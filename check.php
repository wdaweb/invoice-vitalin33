<?php
/******登入檢查******
 * 1. 連線資料庫
 * 2. 取得表單傳遞的帳密資料
 * 3. 比對會員資料表中是否有相符的資料
 * 4. 取得會員資料
 * 5. 檢查會員身份及權限
 * 6. 依據會員身份導向不同的頁面
 */
include_once "base.php";

$acc=$_POST['acc'];
$pw=$_POST['pw'];

$sql="select * from `login` where `acc`='$acc' && `pw`='$pw'";
// $sql="select count(*) from `login` where `acc`='$acc' && `pw`='$pw'";  //如果只是要判斷資料有沒有進去的話，可以用count的方式寫比較安全，使用者的個資比較不會外流

$check=$pdo->query($sql)->fetch();     //把資料取出後存進$check:在資料庫已經比對過了
                                             //理論上$check是一個陣列的格式


                                                // print_r($check);   //所以是用print_r
                                                // $db_acc=$check['acc'];
                                                // $db_pw=$check['pw'];

                                                    // if($acc==$db_acc && $pw==$db_pw){
                                                    //     echo "帳密正確";
                                                    // }else{
                                                    //     echo "帳密不正確";
                                                    // }

    if(!empty($check)){
            echo "登入成功";  
            $member_sql="select * from `member` where login_id='{$check['id']}'"; //取得會員個人資料
            $member=$pdo->query($member_sql)->fetch();  //理論上只有一筆資料
            $role=$member['role'];
            $_SESSION['login']=$acc;

    }else{
        header("location:main_normal.php?do=login_main＆meg=帳密不正確，請重新登入或註冊新帳號");
    }

    switch($role){   
        case '會員';
        header('location:main.php');
        break;

        default:
        header('location:main_normal.php');
    }

?>