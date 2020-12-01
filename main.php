<?php

    include_once "base.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" ></script> -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"> <!--animated.css-->
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/87c0ff4c0f.js" crossorigin="anonymous"></script>
    
<style>
    body{
        background-color: rgb(84, 71, 21);
        padding: 0;
        margin: 0;
    }

    .styleSideMenu a{

        font-size: 1.3rem;
        list-style: none;
        margin-top:10px;
        margin-bottom:10px;
        text-decoration: none !important;
        line-height: 65px;
        color: rgb(77, 65, 0);
        box-sizing: border-box;
        font-weight: 800
        
    }

    
    .sidebar{
        position: fixed;
        width: 250px;
        height: 100vh;
        background: rgb(9, 22, 65);
        background-image: url(https://images.unsplash.com/photo-1606583686915-912e005f6058?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=634&q=80);
        background-position: center;
        filter: sepia(0.5);
        margin: 0;
        padding: 0;
    }

    .signSet a{

        justify-content:center;
        text-decoration: none !important;
        color: rgb(114, 88, 0);
        border: 1px solid transparent;
        background-color: rgb(211, 128, 4);
        padding: 5px 10px 5px 10px;
        border-radius: 20px;
        margin-top: 10px;
        font-weight: 800;

    }

    
    .sidebar header {
        font-size: 1.4rem;
        color: aliceblue;
        text-align: center;
        margin-top: 20px;
 
    }

    .styleSideMenu a:hover {

        padding: 5px;
        color: rgb(109, 101, 67);
        text-decoration: none;
        -webkit-text-stroke: 0.5px rgb(49, 46, 14);
    }

    .signSet a:hover{

  
        color: rgb(11, 1, 37);
        text-decoration: none;
        font-weight: 600;
        background:linear-gradient(90deg, rgba(226,192,0,1) 0%, rgba(245,255,70,1) 57%, rgba(255,255,255,1) 68%, rgba(255,229,53,1) 78%);
    }

    li{
        list-style: none;
    }


    .object_01{
        width: 1000px;
        height: 100vh;
        background-color: rgb(196, 194, 154);
        padding: 0;
        margin: 0;
        left: 250px;
        overflow: hidden;
    }
    .frame_1{
        width:900px;
        background:#333;
    }
</style>

</head>
<body>

    <div class="container mainmenu ">
        
        <div class="col-12 sidebar">
            <header><i class="fas fa-crown fa-3x pb-2" style=" -webkit-text-stroke: 2px rgb(114, 105, 4);"></i><br>統一發票管理系統</header>
                <ul class="p-0">
                    <div class="row justify-content-center signSet">
                    <p><a href="#" class=" d-flex d-inline-block small">SIGN UP</a></p>
                    <p><a href="#" class=" ml-3 d-flex d-inline-block small">SIGN IN</a></p>
                    </div>


                    <div class="styleSideMenu p-0 text-center">
                    <li><a href="?do=award_numbers" target="mainindex">本期中獎號碼</a></li>
                    <li><a href="?do=invoice_list" target="mainindex">已登錄發票清單</a></li>
                    <li><a href="?do=add_awards" target="mainindex">新增中獎號碼</a></li>
                    <li><a href="?do=invoice" target="mainindex">新增統一發票</a></li>
                    </div>
                </ul>
        </div>


        <div class="frame_1 float-right ">
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