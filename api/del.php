<?php
    include_once "../base.php";

    // $pdo->exec("delete from `invoices` where `id`='{$_GET['id']}'");


    del('invoices',$_GET['id']);
    to("../index.php?do=invoice_list");

?>