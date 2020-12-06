<?php
    include_once "../base.php";

    $sql="update 
            `invoices` 
          set  
            `code`='{$_POST['code']}',
            `number`='{$_POST['number']}',
            `date`='{$_POST['date']}',
            `payment`='{$_POST['payment']}' 
          where 
            `id`={$_POST['id']}";


    $pdo->exec($sql);
        //不需要回傳資料，只需要更新，用EXEC
        //用query也可以，但是QUERY會回傳資料，但在這裡是會回傳一個空的陣列

    $tep=$_POST['date'];
    if(isset($tep)){
    $temp[]=explode("-",$tep);
    }
    $period=ceil($temp[0][1]/2);
    //如果再詳細一點的做法，可以在這裡在加上一個判斷式，如果修改有成功再回到HEADER，如果沒有成功就再留在這個頁面    
    header("location:../main.php?do=invoice_list&pd=2020-".$period."&page=1");
  
    //再搞剛一點的作法，會在HERDER後面加上&id={$_POST['id']},讓導回去之後，該筆會有提示效果，表示修改的是那一筆

?>