<?php
include_once "base.php";
?>

<?php
 
      if(isset($_SESSION['login'])){

        $sql_user="select `member`.`role`,`login`.`acc` from `member`,`login` where `member`.`login_id`=`login`.`id` && acc='{$_SESSION['login']}'";
        // echo $sql_user;
        $user=$pdo->query($sql_user)->fetch(PDO::FETCH_ASSOC);
        
        
        // echo "<pre>";
        // print_r($user);
        // echo "</pre>";

          switch($role){   
            case '會員';
            header('location:main.php');
            break;

            default:
            header('location:main_normal.php');
        }

        }

      ?>




<body>
     <div class="container mt-5 ">
       <div class="d-block " style="padding:40px 10% 0 10%; padding-top:40px; height:100vh;">
         <div class="col-6 border bg-light m-auto" style="height:300px;box-shadow:1px 1px 10px #185761">
            <div class="text-center">
                <?php
                  if(isset($_GET['meg'])){
                    echo $_GET['meg'];
                  }
                ?>

            </div> 
        <h5 class="text-center py-3 border-bottom">會員登入</h5>
          <form action="check.php" class="mt-4 col-12 mx-auto" method="post">
              <p class="">帳號：<input type="text" name="acc"></p>
              <p class="">密碼：<input type="password" name="pw"></p>
              <p class="d-flex justify-content-around" style="font-size:0.87rem">
                <a href="?do=forget_pw">忘記密碼?</a>
                <a href="?do=register">註冊新帳號</a>
              </p>
            <p class="text-center "><input type="submit" class="btn login_btn"  value="登入"></p>
         </form>
            </div>
         </div>
      </div>
    </body>


  <?php
include_once('footer.php')
?>