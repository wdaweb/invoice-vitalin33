<?php

    include
//登出，把cookie做成過期就好

//怎麼在陣列裡面註銷變數
    session_start();
    $_SESSION['login']=NULL;  //清空值，但是變數/陣列還在

    unset($_SESSION['login']);  //清空變數/陣列，整個說掰掰


    header("location:index.php");
?>