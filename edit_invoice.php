

<?php 

    include_once "base.php";

    $sql="select * from `invoices` where `id`={$_GET['id']}";

    $inv=$pdo->query($sql)->fetch();

// echo "<pre>";
//     print_r($inv);  
// echo "</pre>";

   

?>


<style>

    .edit_bg{
        background-image:url("https://images.unsplash.com/photo-1527567018838-584d3468eb85?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80");
        padding:45px;
        margin:0;
        width:850px;
        background-size:100vh;

    }

    .edit_border{
        border:2px solid transparent;
        background-color:linear-gradient(137deg, rgba(235,167,32,1) 0%, rgba(237,201,137,1) 55%, rgba(237,205,150,1) 62%, rgba(237,215,182,1) 79%, rgba(238,228,222,0.7763480392156863) 100%);

    }

    .revise_btn{
        background:linear-gradient(231deg, rgba(176,219,240,1) 5%, rgba(234,240,255,1) 25%, rgba(233,246,255,1) 56%, rgba(157,220,255,1) 100%);
    }

    .revise_btn input:hover{
        background:linear-gradient(231deg, rgba(63,189,250,1) 5%, rgba(234,240,255,1) 25%, rgba(172,230,254,1) 56%, rgba(83,189,249,1) 100%);
    }
</style>


<body>
    <div class="float-right vh-100 mx-auto edit_bg">
        <p class="pb-3" style="font-size:1.6rem; color:#333;text-align:center; font-weight:600; ">● 發票編輯 ●</p>
        <div class="p-2 d-flex justify-content-center" >
        <form action="./api/update_invoice.php" method="post" class="" > 
            <div><input type="hidden" name="id" value="<?=$inv['id'];?>"> <!--通常會隱藏ID的欄位，避免被人有心修改不同ID的資料--></div>
            <div class="">發票號碼：<input type="text" name="code" style="width: 50px;" value="<?=$inv['code'];?>"> <input type="number" name="number" style="width: 120px;" value="<?=$inv['number'];?>"></div>
            <div>消費日期：<input type="date" name="date" value="<?=$inv['date'];?>"></div>
            <div>消費金額：<input type="text" name="payment" value="<?=$inv['payment'];?>"></div>

            <div class="d-flex justify-content-center mt-5">
            <input type="submit" class="login_btn py-2 revise_btn" svalue="修改">　　
            <input type="reset"  class="login_btn py-2" value="重置">
            </div>

            
</form>

<!-- </div> -->
</div>
</body>