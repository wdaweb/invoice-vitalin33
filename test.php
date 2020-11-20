<?php

    include_once "base.php";

    
    /*寫法一*/
    echo find('invoices',"id='9'")['code'];  //函式本身如果有RETURN值的話，函式本就是一個變數，如果要取用變數的話，就再使用中括號指定希望echo的欄位資料。

    /**寫法二
    * $row=find('invoices',"id='9'");
    * echo $row['code'];
    * echo $row['number'];
    */


    function find($table,$def){  //本語法預設只會取回一筆資料
        global $pdo;
        $sql="select * from $table where $def";
        $row=$pdo->query($sql)->fetch();

        return $row;


    }



?>