<?php
include_once "base.php";

$sql="select * from `invoices`";
$row=$pdo->query($sql)->fetchALL();

foreach($row as $row){

    echo $row['code'].$row['number']."<br>";
}



?>