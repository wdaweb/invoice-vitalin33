<?php
    include_once "../base.php";
    $pdo->exec("delete from `invoices` where `id`='{$_GET['id']}'");


    header("location:../main.php?do=invoice_list&pd=2020-".ceil(date("m")/2)."&page=1");

?>