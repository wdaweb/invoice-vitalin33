<?php

    
//撰寫新增消費發票的程式碼

// echo "<pre>";
// print_r(array_keys($_POST));
// echo "</pre>";

// echo "<pre>";
// print_r($tmp);
// echo "</pre>";



//將發票的號碼及相關資訊寫入資料庫
// foreach($_POST as $key => $value){  //解晰KEY跟POST的內容
    // echo "欄位".$key."==值".$value."<br>";
//    $tmp[]=$key;    
// }
// foreach($_POST as $key => $value){ 
//    // echo "欄位".$key."==值".$value."<br>";    
//    $tmp2[]=$value;
// }
//--------------------------上面是解析演進史-----------------------

    include_once "../base.php";
    
    echo "<pre>";
    print_r(array_keys($_POST));
    echo "</pre>";

    save('invoices',$_POST);
    
   /* $sql="insert into invoices (`".implode("`,`",array_keys($_POST))."`) values('".implode("','",$_POST)."')";
    echo $sql;
    $pdo->exec($sql);  //新增的話不用用FETCH
*/
    echo "新增完成";
    header("location:../index.php?do=invoice_list");


?>