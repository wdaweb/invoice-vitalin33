<?php

    include_once "base.php";

    
    /*寫法一*/
    //echo find('invoices',"id='9'")['code'];  //函式本身如果有RETURN值的話，函式本就是一個變數，如果要取用變數的話，就再使用中括號指定希望echo的欄位資料。

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



    /**第二階段：進階函式套用*/
    /*↓↓↓↓↓↓↓↓在一個function裡同時放數字也可放條件，讓使用範圍更加廣：增加條件判斷式↓↓↓↓↓↓↓*/
    function find($table,$id){  //本語法預設只會取回一筆資料
            global $pdo;
            $sql="select * from $table where";
            if(is_array($id)){  //可以用is_numertic判斷是否是數字，或是用is_array判斷是否為陣列

                foreach($id as $key => $value){
                    // echo $key."='".$value."'&&";    這樣做的話會在最後又跑出"&&"，也不能用，所以優化如下          
                    //↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
                    //$tmp[]=$key."='".$value."'";        //利用一個暫時的陣列來存放語句的片段
                    $tmp[]=sprintf("`%s`='%s'",$key,$value);        //寫法二：sprintf：可以先決定字串的函式，%s是字串，%d是數字
                }
                $sql=$sql.implode('&&',$tmp);  //如果輸入的不是數字/是陣列的話就用這一段       
            }else{
                $sql=$sql." id = '$id' "; //如果是數字/不是陣列的話就用這一段
            }
            
            $row=$pdo->query($sql)->fetch();
            return $row;
        }

    /**第三階段：增加查詢資料量 ===========> 陣列跟資料互轉
     * 保留第二階段製作的function，並增加字串產生方式如下述：
     * 有n個欄位 a="B" && 【______】 && 【______】 && ... (使用&&)變成陣列型態，使用implode將字串組起來
     * 產出陣列的方式：
     * 'A'='B', 'C'='D','E'='F'.....
     */

    /**演示 
    echo implode("&&",['欄位1'=>'值1','欄位2'=>'值2','id'=>'9']); //implode只會將串起來的符號放在兩個字串的正中間
    echo "<br>";
    echo "'欄位1'=>'值1' && '欄位2'=>'值2' && 'id'=>'9'";
    echo "<hr>";
    $array=['欄位1'=>'值1','欄位2'=>'值2','id'=>'9'];  //透過陣列的方式，讓迴圈幫忙跑出在SQL中需要的字串格式
    echo "<hr>";
    */


    //print_r($tmp);
   // echo "<br>";
    //echo implode("&&",$tmp);                //使用implode把暫時陣列中的片串再串成SQL會用到的語句
    
    echo "<br>";

     $row=find('invoices',['code'=>'AB', 'number'=>'69874947']);
     echo $row['code'].$row['number']."<br>";
     
     $row=find('invoices',16);
     echo $row['code'].$row['number']."<br>";
     
     $row=find('invoices',33);
     echo $row['code'].$row['number']."<br>";












?>