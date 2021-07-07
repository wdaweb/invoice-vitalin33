
<?php

//撰寫建立各期中獎號碼的程式
//將表單傳送過來的中獎號碼寫入資料庫
    include_once "../base.php";

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    // echo "<pre>";
    // print_r(array_keys($_POST));
    // echo "</pre>";

    $year=$_POST['year'];
    $period=$_POST['period'];

    //特別獎的新增 type=1
    
    
    $sql="insert into 
    award_numbers 
    (`year`,`period`,`number`,`type`)
    
    values('$year','$period','{$_POST['special_prize']}','1')";
    
    $pdo->exec($sql);
    //特別獎的新增 type=2
    //都用$sql沒關係，因為跑完，儲存完前一個就用不到了
    $sql="insert into 
    award_numbers 
    (`year`,`period`,`number`,`type`)
    
    values('$year','$period','{$_POST['grand_prize']}','2')";
    $pdo->exec($sql);

    //頭獎的新增 type=3
    //要根據變數的種類改變做法
    foreach($_POST['first_prize'] as $first){
        if(!empty($first)){ //$first有值才做儲存這件事，沒有的話就不要儲存
            $sql="insert into 
            award_numbers 
            (`year`,`period`,`number`,`type`)
            
            values('$year','$period','$first','3')";   //$變數加不加 {} 都沒關係，但如果是陣列的話一定要加 {}
            $pdo->exec($sql);
        }
    }
    //特別獎的新增 type=4
    foreach($_POST['addSix_prize'] as $six){
        if(!empty($six)){ //$six有值才做儲存這件事，沒有的話就不要儲存
            $sql="insert into 
            award_numbers 
            (`year`,`period`,`number`,`type`)
            
            values('$year','$period','$six','4')";   //$變數加不加 {} 都沒關係，但如果是陣列的話一定要加 {}
            $pdo->exec($sql);
        }
    }


    echo "新增完成";
    header("location:../main.php?do=award_numbers&pd=".$year."-".$period);

?>