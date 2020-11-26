<?php
include_once "base.php";

$period=ceil(date("m")/2);  //只顯示當月發票：step:1   --2020/11/18新增


//$sql="select * from `invoices` where `period`='$period' order by date";  //可以在此加入排序清單
                                                //ORDER BY用途：order by date [由小到大] .... order by date desc [由大到小]

//$row=$pdo->query($sql)->fetchALL();   
$rows=all('invoices', ['period'=>$period], ' order by date desc');

?>
<div class="row justify-content-around" style="list-style-type: none;padding:0;">
<li><a href="">1、2月</a></li>
<li><a href="">3、4月</a></li>
<li><a href="">5、6月</a></li>
<li><a href="">7、8月</a></li>
<li><a href="">9、10月</a></li>
<li><a href="">11、12月</a></li>
</div>


<table class="table text-center ">
    <tr>
        <td>發票號碼：</td>
        <td>消費日期：</td>
        <td>消費金額：</td>
        <td>操作</td>
    </tr>

    <?php                //建兩個PHP，因為要用迴圈包住要填入的資料，所以要注意括號的位置
    foreach($row as $row){
    ?>
    <tr >
        <td><?=$row['code'].$row['number'];?></td>
        <td><?=$row['date'];?></td>
        <td><?=$row['payment'];?></td>
        <td>
            <button class="btn btn-primary btn-sm text-light">
                <a href="?do=edit_invoice&id=<?=$row['id'];?>" class="text-light text-decoration-none">編輯</a></button> <!-- 在按下編輯的時候， 可以將頁面導向編輯頁面-->
            <button class="btn btn-danger btn-sm"><a href="?do=del_invoice&id=<?=$row['id'];?>" class="text-light text-decoration-none">刪除</a></button>

            <button class="btn btn-success btn-sm"><a href="?do=award&id=<?=$row['id'];?>" class="text-light text-decoration-none">對獎</a></button>


        </td>
    </tr>

    <?php

    }
    ?>

</table>