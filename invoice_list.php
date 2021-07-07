
    <?php
    include_once "base.php";
    

    if(isset($_GET['pd'])){
        $period=mb_substr($_GET['pd'],-1);
    }else{
        $period=ceil(date("m")/2); 
    }

    
    if(isset($_GET['page'])){                       //先加判斷式，如果一開始沒有跑頁數資料，則為首頁；如果有，則為GET回傳數值
        $page=intval($_GET['page']); 
    } 
    else{ 
        $page=1; 
    }  
    
    $sql="select * from `invoices` where `period`='$period' order by date desc"; 
    $result=$pdo->query($sql)->fetchALL();   
    $totalAmount=count($result);             //該期數總共有多少資料
    $totalpages=ceil($totalAmount/10);       //總頁數
    $perpage=10;                             //每頁筆數
    
    ?>





<body> 
    <div class="float-right bg-white vh-100 " style="width:45vw; padding:40px 5% 0 5%">
        <p class="pb-3" style="font-size:1.6rem; color:#333;text-align:center; font-weight:600; ">● 您已登錄的發票清單 ●</p>
             <p class="pb-3" style="font-size:1.6rem; color:#333;text-align:center;"><?=date("Y")?>年</p>
            <div class="row justify-content-around" style="list-style-type: none;padding:0;">
                <li><button class="btn btn-warning mb-2"><a href="?do=invoice_list&pd=2020-1&page=1">1、2月</a></button></li>                
                <li><button class="btn btn-warning mb-2"><a href="?do=invoice_list&pd=2020-2&page=1">3、4月</a></button></li>
                <li><button class="btn btn-warning mb-2"><a href="?do=invoice_list&pd=2020-3&page=1">5、6月</a></button></li>
                <li><button class="btn btn-warning mb-2"><a href="?do=invoice_list&pd=2020-4&page=1">7、8月</a></button></li>
                <li><button class="btn btn-warning mb-2"><a href="?do=invoice_list&pd=2020-5&page=1">9、10月</a></button></li>
                <li><button class="btn btn-warning mb-2"><a href="?do=invoice_list&pd=2020-6&page=1">11、12月</a></button></li>
    </div>


<table class="table text-center float-right ">
    <tr>
        <td>序號</td>
        <td>發票號碼</td>
        <td>消費日期</td>
        <td>消費金額</td>
        <td>操作</td>
    </tr>

    <?php                
    
    if($page==1){                               //如果是首頁，取出資料則從第0筆開始
        $everyFirstPage=0;
    }else{
        $everyFirstPage=$page*$perpage;         //如果非首頁，取出資料則從頁數*每頁預設筆數開始
    }
    
   if($page>1){
    $k=($_GET['page']-1)*10+1;                 //序號：從頁碼-1*10(十位數數值)+1 (起始值)
   }else{
    $k=1;
   }

    $sql="select * from `invoices` where `period`='$period' order by date desc LIMIT $everyFirstPage, $perpage"; //再次取出資料，這次加上每頁起始及筆數限制
    $rows=$pdo->query($sql)->fetchALL();   
  
    foreach($rows as $row){ 
    ?>
    <tr >
        <td><?=$k;?></td>
        <td><?=$row['code'].$row['number'];?></td>
        <td><?=$row['date'];?></td>
        <td><?=$row['payment'];?></td>
        <td>
            <button class="btn btn-primary btn-sm text-light">
                <a href="?do=edit_invoice&id=<?=$row['id'];?>"  class="text-light text-decoration-none">編輯</a></button> <!-- 在按下編輯的時候， 可以將頁面導向編輯頁面-->
            <button class="btn btn-danger btn-sm"><a href="?do=del_invoice&id=<?=$row['id'];?>"  class="text-light text-decoration-none">刪除</a></button>

            <button class="btn btn-success btn-sm"><a href="?do=award&id=<?=$row['id'];?>" class="text-light text-decoration-none">對獎</a></button>

        </td>
    </tr>
    <?php
            $k++;   //序號向前走~
    }  
    ?>

</table>

        <div class='row d-flex justify-content-center'>

        <?php
        $prepage=$_GET['page']-1;
        if($prepage>1){
        echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;<a href='?do=invoice_list&pd=2020-".$period."&page=".$prepage."'>&lt;上一頁</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>";
        }
        if($page>10){
        $pre10page=$_GET['page']-10;
        echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;<a href='?do=invoice_list&pd=2020-".$period."&page=".$pre10page."'>&#171;前10頁</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>";
        }

        if($page>6){
            //如果訪問的當前頁碼>=7的，應該7-5=2開始，最大顯示到7+4=11；
            for($i=($page-4);$i<=($page+5);$i++){
                echo "<a href='?do=invoice_list&pd=2020-".$period."&page=".$i."'>".$i."</a>&nbsp;&nbsp;&nbsp;";
            }
        }else{
            //當前頁碼小於6，判斷頁總數是否大於10，如果10，最多顯示10個頁碼，否則等於$page_count個頁碼
            if($totalAmount<=10){
                $size=$totalAmount;
            }else{
                $size=10;
            }
            for($i=1;$i<=$size;$i++){
                echo "<a href='?do=invoice_list&pd=2020-".$period."&page=".$i."'>".$i."</a>&nbsp;&nbsp;&nbsp;";
            }
        }		

        $nextpage=$_GET['page']+1;
        if($nextpage<$totalpages && $nextpage>=1 ){
        echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;<a href='?do=invoice_list&pd=2020-".$period."&page=".$nextpage."'>下一頁</a>&gt;&nbsp;&nbsp;&nbsp;</p>";
        }
        if($page>10){
            $next10page=$_GET['page']+10;
        echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;<a href='?do=invoice_list&pd=2020-".$period."&page=".$next10page."'>後10頁</a>&#187;&nbsp;&nbsp;&nbsp;</p>";
        }

        echo "<br>";
        
        ?>
        </div>

        <div class="d-flex justify-content-center" >
        <?php
        echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;<a href='?do=invoice_list&pd=2020-".$period."&page=1'>回第一頁</a>&nbsp;&nbsp;&nbsp;</p>";
        echo "<p>第".$_GET['page']."頁 / 共".$totalpages."頁</p>";

        ?>
        </div>
   
        <form action="edit_invoice.php" method="post">
            <?php
            $period=$period;
            $page=$_GET['page'];
            // echo $page;
            ?>
        </form>

</body>
</html>