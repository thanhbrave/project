<?php
    if (isset($_POST['username'])) {
      $username = $_POST['username'];
      $query = "select * from member where username='$username'";
      $result = $connect->query($query);
      if (mysqli_num_rows($result)==0) {
        $alert="Ten dang nhap da ton tai";
      }else{
        $password = md5($_POST['password']);
        $fullname = $_POST['fullname'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $query = "insert member(username,password,fullname,mobile,address,email) values ('$username','$password','$fullname','$mobile','$address','$email')";
        $connect->query($query);
        echo "<<script>alert('Ban da dang ky thanb cong');location='?option=home'</script>";
      }
    }
?>

<section class="member-form col-4">
  <h1>Register</h1>
  <section style="color:red"><?=isset($alert)?$alert: ""?></section>
  <section>
    <form action="" method="post" onsubmit="if(repassword.value!=password.value){alert('Xac nhan mat khau khong khop')}">
      <section class="form-group">
        <label for="">Username: </label>
        <input type="text" name="username" id="" class="form-control">
      </section>
      <section class="form-group">
        <label for="">Password: </label>
        <input type="password" name="password" id="" class="form-control">
      </section>
      <section class="form-group">
        <label for="">Re-Password: </label>
        <input type="password" name="repassword" id="" class="form-control">
      </section>
      <section class="form-group">
        <label for="">Fullname: </label>
        <input type="text" name="password" id="" class="form-control">
      </section>
      <section class="form-group">
        <label for="">Mobile: </label>
        <input type="tel" name="mobile" id="" pattern="(0|\+84)\d{9}" class="form-control">
      </section>
      <section class="form-group">
        <label for="">Address: </label>
        <textarea name="address" class="form-control"></textarea>
      </section>
      <section class="form-group">
        <label for="">Email: </label>
        <input type="email" name="email" id="" class="form-control">
      </section>
      <br>
      <section class="form-group">
        <input type="submit" value="Register" class="form-control btn btn-primary">
      </section>
    </form>
  </section>
</section>
