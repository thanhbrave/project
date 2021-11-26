<?php
    if (isset($_POST['username'])) {
      $username = $_POST['username'];
      $password = md5($_POST['password']);
      $query = "select * from member where username='$username' and password = '$password'";
      $result = $connect->query($query);
      if (mysqli_num_rows($result)==0) {
        $alert="Sai ten dang nhap hoac mat khau";
      }else{
        $result=mysqli_fetch_array($result);
        if ($result['status']==0) {
          $alert="Tai khoan cua ban bi khoa";
        }else{
          $_SESSION['member']=$username;
          if(isset($_GET['order'])){
            header("location: ?option=order");
          }elseif($_GET['productid']) {
            $memberid = $result['id'];
            $productid = $_GET['productid'];
            $content = $_SESSION['content'];
            $connect->query("insert comments(memberid,productid,date,content) values ($memberid,$productid,now(),'$content')");
            echo"<script>alert('Your comment is submitted and it will be showed soon!'); location='?option=productdetail&id=$productid';</script>";
          }else
          header("location: ?option=home");
        }
      }
    }
?>

<section class="member-form col-4">
  <h2>Log in</h2>
  <section style="color:red"><?=isset($alert)?$alert: ""?></section>
  <section>
    <form action="" method="post">
      <section class="form-group">
        <label for="">Username: </label>
        <input type="text" name="username" id="" class="form-control">
      </section>
      <section class="form-group">
        <label for="">Password: </label>
        <input type="text" name="password" id="" class="form-control">
      </section>
      <br>
      <section class="form-group">
        <input type="submit" value="Log in"class="form-control btn btn-primary">
      </section>
    </form>
  </section>
</section>
