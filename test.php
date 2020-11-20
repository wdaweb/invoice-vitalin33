<?php

    include_once "base.php";

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


        function all($table, ...$arg){      
            global $pdo;


           //echo gettype($arg); //gettype()函式可以讓你知道這個陣列的資料型態
        
            $sql="select * from $table ";

            if(isset($arg[0])){
            if(is_array($arg[0])){
              
                if(!empty($arg[0])){
                    foreach($arg[0] as $key => $value){
    
                        $tmp[]=sprintf("`%s`='%s'",$key,$value);        //寫法二：sprintf：可以先決定字串的函式，%s是字串，%d是數字
                    }
                 $sql=$sql."where".implode(' && ',$tmp);
                }

            }else{
                //製作非陣列的語句接在SQL後面
                // echo "arg[0]不存在或arg[0]不是陣列";
                $sql=$sql.$arg[0];

            }
        }

            if(isset($arg[1])){
                //製作接在最後面的句子字串
                // $sql=$sql."order by date desc";
                $sql=$sql.$arg[1];
            }
        
            echo $sql."<br>";
            return $pdo->query($sql)->fetchAll();
        }
    
        
        //print_r(all('invoices')[0]);   //最後的那個[0]，在測試跑資料時就試跑一筆，如果要改撈全部資料，就把[0] 拿掉0
        

        /*舉不同例子
        print_r(all('invoices'));                                         //輸出全部資料
        print_r(all('invoices',['code'=>'GD','period'=>6]));              //輸出指定欄位資料
        print_r(all('invoices',['code'=>'AB','period'=>1]), "order by date desc");  ///輸出資料之後，再加上ORDER BY "參數"
        print_r(all('invoices',"limit 5"));                               //輸出限定參數的資料，例如limit 5就是前五筆
        */

        echo "<hr>";                                         
        all('invoices');
        echo "<hr>";                                         
        all('invoices',['code'=>'GD','period'=>6]);             
        echo "<hr>";                                         
        all('invoices',['code'=>'AB','period'=>1], "order by date desc");  
        echo "<hr>";                                         
        all('invoices',"limit 5");  
        echo "<hr>";                                         









?>