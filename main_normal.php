<?php

    include_once "base.php";
    $period=ceil(date("m")/2); 
?>

    <style>
        body{
            background-image:url("https://images.unsplash.com/photo-1570747408017-38b4c5959378?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80");
            background-size: cover;
            padding: 0;
            margin: 0;
        }

   
        .frame_1{
        width: 850px;
        display: flex;
        position: absolute;
        left: 250px;
        top: 0;
        }


</style>

<body>
    <div class="container mainmenu" >
        <div class="sidebar">
            <header style="color:#836e61;"><i class="fas fa-carrot fa-3x pb-2" style=" -webkit-text-stroke: 2px rgb(114, 105, 4);"></i><br>統一發票管理系統</header>
                <ul class="p-0">
                    <div class="row justify-content-center signSet">
                    <p><a href="?do=register" class=" d-flex d-inline-block small">SIGN UP</a></p>
                    <p><a href="?do=login_main" class=" ml-3 d-flex d-inline-block small">SIGN IN</a></p>

        </div>


        <div class="styleSideMenu p-0 text-center">
                    <li><a href="?do=award_numbers" target="mainindex">本期中獎號碼</a></li>
                    <li><a href="?do=login_main" target="mainindex">已登錄發票清單</a></li>
                    <li><a href="?do=login_main" target="mainindex">新增統一發票</a></li>
                    <li><a href="?do=login_main" target="mainindex">新增中獎號碼</a></li>
        </div>
                </ul>
        

        <div class="frame_1 bg-white">
            <?php 

            if(isset($_GET['do'])){

                $file=$_GET['do'].".php";
                include $file;


            }else{
                include "award_numbers.php";
            }
            ?>
        </div>      

  
    </div>

</body>
</html>