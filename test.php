<?php
    /**function製作：
     * find   => select 單筆資料
     * all    => select 符合條件的所有資料
     * del    => delete 資料
     * update => update 資料 (以id為索引欄位)
     * insert => insert 資料 
     * save   => 整合insert & update 功能
    */






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
            $row=$pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
            return $row;
        }


        function all($table, ...$arg){      
            global $pdo;
           //echo gettype($arg); //gettype()函式可以讓你知道這個陣列的資料型態
            $sql="select * from $table ";
            if(isset($arg[0])){
            if(is_array($arg[0])){
                    foreach($arg[0] as $key => $value){
    
                        $tmp[]=sprintf("`%s`='%s'",$key,$value);        //寫法二：sprintf：可以先決定字串的函式，%s是字串，%d是數字
                    }
                 $sql=$sql."where".implode(' && ',$tmp);
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
        


        function del($table,$id){
            global $pdo;
            $sql="delete from $table where";
            if(is_array($id)){ 
                foreach($id as $key => $value){
                    $tmp[]=sprintf("`%s`='%s'",$key,$value);    
                }
                $sql=$sql.implode('&&',$tmp);  
            }else{
                $sql=$sql." id = '$id' "; 
            }
            $row=$pdo->exec($sql);  //因為不需要回傳值，EXEC就可以
            return $row;
        }
        

        function update($table, $array){  /*update的set後面是要接key值，格式像是：set  `key1`='v1',     */
            global $pdo;                                                        /*   `key2`='v2',     */
            $sql="update $table set";                                           /*   `key3`='v3',     */
            foreach($array as $key => $value){                                 /*形式類式又要做很多遍的事，要直接聯想到迴圈*/
                if($key!='id'){
                $tmp[]=sprintf("`%s`='%s'",$key,$value);           //$tmp[]="`".$key."`='".$value."'";  最原始的寫法，但較複雜
                }          
            }
            $sql=$sql.implode(",",$tmp) . " where `id`='{$array['id']}'";
            echo $sql; 
            // $pdo->exec($sql);     執行(將資料寫入資料庫)    
        }

        /**只要拿到欄位值：
         * $pdo->exec($sql)->fetch(PDO::FETCH_ASSOC);
         * 原生寫法：mysqli_fetch_assoc(丟進連線的參數)
         * 
         * 只要拿到key值：
         * $pdo->exec($sql)->fetch(PDO::FETCH_ASSOC);
         * 原生寫法：mysqli_fetch_num(丟進連線的參數)
        */


        function insert($table, $array){  /*insert 是key跟name分開來看*/
            global $pdo;
            $sql="insert into $table(`".implode("`,`",array_keys($array))."`) values('".implode("','",$array)."')";  /*key值相對於是欄位*/

            $pdo->exec($sql);
        }



        //-------------------------------------------  合併update&insert ---------------------------------------------------//
        function save($table,$array) {   //同時做新增又可以更新

                if(isset($array['id'])){      //is_array($array)[可省略]判斷是不是陣列，再判斷裡面有沒有id(id存不存在)則使用 isset
                    //update
                    update($table,$array);    //有id則進行UPDATE
                }else{
                    //insert
                    insert($table,$array);    //沒有id則新增資料 (因為ID是在新增資料之後才生成)
                }
        }

        /**select執行程式
            //以不同取出資料的方式舉例
            print_r(all('invoices'));                                         //輸出全部資料
            print_r(all('invoices',['code'=>'GD','period'=>6]));              //輸出指定欄位資料
            print_r(all('invoices',['code'=>'AB','period'=>1]), "order by date desc");  ///輸出資料之後，再加上ORDER BY "參數"
            print_r(all('invoices',"limit 5"));                               //輸出限定參數的資料，例如limit 5就是前五筆
            

            echo "<hr>";                                         
            all('invoices');
            echo "<hr>";                                         
            all('invoices',['code'=>'GD','period'=>6]);             
            echo "<hr>";                                         
            all('invoices',['code'=>'AB','period'=>1], "order by date desc");  
            echo "<hr>";                                         
            all('invoices',"limit 5");  
            echo "<hr>";   
        */   



        /**update的執行程式 
            $row=find('invoices',12);
            echo "<pre>";
            print_r($row);
            echo "</pre>";
            $row['code']='KK';
            $row['payment']=32123;
            update('invoices',$row);        //先執行下方的 $pdo->exec($sql);，執行完之後關掉這行程式，就會顯示更新後的資料
        */


        /**delete的執行程式 
           echo del('invoices',3); //如果使用echo，因為 return $row的關係，畫面上會出現刪除了幾筆資料
           $def=['code'=>'XX'];     //除了指定id數字，也可以指定其他欄位，但指定其它欄位的時候建議先設變數
           echo del('invoices',$def);
        */



?>