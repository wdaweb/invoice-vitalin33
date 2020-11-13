

<?php 

    include_once "base.php";

$sql="select * from `invoices` where `id`={$_GET['id']}";

$inv=$pdo->query($sql)->fetch();

// echo "<pre>";
//     print_r($inv);  
// echo "</pre>";

?>
<div class="p-2">
<form action="api/update_invoice.php" method="post"> 
    <div><input type="hidden" name="id" value="<?=$inv['id'];?>"> <!--通常會隱藏ID的欄位，避免被人有心修改不同ID的資料--></div>
    <div class="">發票號碼：<input type="text" name="code" style="width: 50px;" value="<?=$inv['code'];?>"> <input type="number" name="number" style="width: 120px;" value="<?=$inv['number'];?>"></div>
    <div>消費日期：<input type="date" name="date" value="<?=$inv['date'];?>"></div>
    <div>消費金額：<input type="text" name="payment" value="<?=$inv['payment'];?>"></div>

    <div>
    <input type="submit" value="修改">
    <input type="reset" value="重置">
    </div>
</form>
</div>