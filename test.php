<?php

    include_once "base.php";

    
    /*寫法一*/
    echo find('invoices',"id='9'")['code'];  //函式本身如果有RETURN值的話，函式本就是一個變數，如果要取用變數的話，就再使用中括號指定希望echo的欄位資料。

    /**寫法二
    * $row=find('invoices',"id='9'");
    * echo $row['code'];
    * echo $row['number'];
    */


    /**第一階段：最簡單的函式套用
    *function find($table,$def){  //本語法預設只會取回一筆資料
    *    global $pdo;
    *    $sql="select * from $table where $def";
    *    $row=$pdo->query($sql)->fetch();
    *    return $row;
    }
    */

    

    /**第二階段：進階函式套用
    /*↓↓↓↓↓↓↓↓在一個function裡同時放數字也可放條件，讓使用範圍更加廣：增加條件判斷式↓↓↓↓↓↓↓*/
    function find($table,$id){  //本語法預設只會取回一筆資料
            global $pdo;
            if(is_numeric($id)){
            $sql="select * from $table where `id`='$id'"; //如果是數字的話就用這一段
            }else{
            $sql="select * from $table where $id";  //如果輸入的不是數字的話就用這一段       
            }
            $row=$pdo->query($sql)->fetch();
            return $row;
        }



     $row=find('invoices',"code='AB' && number='69874947'");
     echo $row['code'].$row['number'];
     
     $row=find('invoices',16);
     echo $row['code'].$row['number'];
     
     $row=find('invoices',33);
     echo $row['code'].$row['number'];












?>