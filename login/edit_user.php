<?php
    $title="編輯會員資料";
    include_once('header.php');
?>

<body>
<?php
//用來編輯會員資料用的

    $dsn="mysql:host=localhost;dbname=member;charset=utf8";
    $pdo=new PDO($dsn,'root','');

    $user_id=$_GET['id'];  //拿到USER ID就可以拿到USER資料
    // echo "$user_id";
    $user_sql="select * from `login`,`member` where `login`.`id`=`member`.`login_id` AND `login`.`id`='$user_id'";
    // echo "$user_sql";
    $user=$pdo->query($user_sql)->fetch(); 



?>

        <div class="container">  <!--//會自動往中間對齊-->
            <h2>編輯資料</h2>

            <form action="save_user.php" method="post" class="col-6">

            <div class="list-group">
            <input type="hidden" name="id" value='<?=$user['id'];?>'>

            <li class="list-group-item">帳號：<input type="text" name='acc' value='<?=$user['acc'];?>'></li>    
            <li class="list-group-item">密碼：<input type="password" name='pw' value='<?=$user['pw'];?>'>></li>
            <li class="list-group-item">姓名：<input type="text" name='name' value='<?=$user['name'];?>'></li>
            <li class="list-group-item">生日：<input type="date" name='birthday'value='<?=$user['birthday'];?>'></li>
            <li class="list-group-item">地址：<input type="text" name='addr' value='<?=$user['addr'];?>'></li>
            <li class="list-group-item">email：<input type="email" name='email' value='<?=$user['email'];?>'></li>
            <li class="list-group-item">學歷：  
                <select name="education" >    <!--寫法一：三元運算式/寫法一：IF ELSE -->
            <option value="國中" <?=($user['education']=='國中')?"selected":"";?>>國中</option>  <!--?(IF) __要做的事____ :(ELSE)__要做的事-->___
            <option value="高中" <?=($user['education']=='高中')?"selected":"";?>>高中</option>
            <option value="大學/專科" <?=($user['education']=='大學/專科')?"selected":"";?>>大學/專科</option>
            <option value="碩士" <?=($user['education']=='碩士')?"selected":"";?>>碩士</option>
            <option value="博士" <?=($user['education']=='博士')?"selected":"";?>>博士</option>
                </select></li>
                <li class="list-group-item">
                <select name="role" >
                    <option value="會員" <?=($user['role']=='會員')?"selected":"";?> >會員</option>
                    <option value="VIP" <?=($user['role']=='VIP')?"selected":"";?>>VIP</option>
                    <option value="管理員" <?=($user['role']=='管理員')?"selected":"";?>>管理員</option>
                </select>


                </li>

            </div>

            <input type="submit" value="確認新增" class="btn btn-secondary my-3">
            <input type="reset" value="重置" class="btn btn-danger my-3">


            </form>
            </div>

    </body>
    <?php
                include_once('footer.php');
                ?>