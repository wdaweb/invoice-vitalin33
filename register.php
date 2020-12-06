<?php
$title="註冊帳號";
include_once "base.php";
?>

<style>

    .container{
        margin:auto;
        height:100vh;
        background-image:url("https://images.unsplash.com/photo-1487260211189-670c54da558d?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=634&q=80");
        padding:0;
        background-size:90vh;
        background-position:center;
    }

  .regi_forg{
       
    width: 850px;
    height: 100vh;
    display: flex;
    position: absolute;
    left: 250px;
    top: 0;
    
 
  }

  .form_regi{

    border:4px double rgba(192,180,156,1);


   }

</style>
<body>


    <div class="container">  <!--//會自動往中間對齊-->
    <h2 class="text-center my-5">註冊帳號</h2>

    <form action="./api/add_user.php" method="post" class="col-6 mx-auto">

    <div class="list-group" >
    <li class="list-group-item form_regi" style="background-color:transparent;">帳號：<input type="text" name='acc'></li>    <!--因為要回傳值，所以一定要設定name-->
    <li class="list-group-item form_regi" style="background-color:transparent;">密碼：<input type="password" name='pw'></li>
    <li class="list-group-item form_regi" style="background-color:transparent;">姓名：<input type="text" name='name'></li>
    <li class="list-group-item form_regi" style="background-color:transparent;">生日：<input type="date" name='birthday'></li>
    <li class="list-group-item form_regi" style="background-color:transparent;">地址：<input type="text" name='addr'></li>
    <li class="list-group-item form_regi" style="background-color:transparent;">email：<input type="email" name='email'></li>
    <li class="list-group-item form_regi" style="background-color:transparent;">學歷：   <!--建立選單-->
        <select name="education" >
    <option value="國中">國中</option>
    <option value="高中">高中</option>
    <option value="大學/專科">大學/專科</option>
    <option value="碩士">碩士</option>
    <option value="博士">博士</option>
        </select></li>

    </div>

    <div class="d-flex justify-content-center">
    <input type="submit" value="確認新增" class="btn login_btn my-3 ">　　
    <input type="reset" value="重置" class="btn login_btn my-3">
    </div>

    </form>
    </div>
</body>
<?php
include_once('footer.php');
?>