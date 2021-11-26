<?php
      $query = "select * from member where username='".$_SESSION['member']."'";
      $member = mysqli_fetch_array($connect->query($query));
?>
<?php
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $note = $_POST['note'];
        $ordermethodid = $_POST['ordermethodid'];
        $memberid = $member['id'];
        $query = "insert orders(ordermethodid,memberid,name,mobile,address,email,note) values ('$ordermethodid','$memberid','$name','$mobile','$address','$email','$note')";
        $connect->query($query);
        $query = "select id from orders order by id desc limit 1";
        $orderid = mysqli_fetch_array($connect->query($query))['id'];
        foreach ($_SESSION['cart'] as $key => $value) {
          $productid=$key;
          $number=$value;
          $query="select price from products where id=$key";
          $price = mysqli_fetch_array($connect->query($query))['price'];
          $query="insert orderdetail values($productid, $orderid, $number, $price)";
          $connect->query($query);
        }
        unset($_SESSION['cart']);
        header("location: ?option=ordersuccess");
    }
?>


<h2>Đặt hàng</h2>
<h3>Thông tin người nhận</h3>

<form action="" method="post">
  <section>
    <section class="form-group">
    <label for="">Name: </label>
    <input type="text" name="name" value="<?= $member['fullname'] ?>">
    </section>
    <section class="form-group">
      <label for="">Mobile: </label>
      <input type="tel" name="mobile" id="" pattern="(0|\+84)\d{9}" value="<?= $member['mobile'] ?>">
    </section>
    <section class="form-group">
      <label for="">Address: </label>
      <textarea name="address" value="<?= $member['address'] ?>"></textarea>
    </section>
    <section class="form-group">
      <label for="">Email: </label>
      <input type="email" name="email" value="<?= $member['email'] ?>">
    </section>
    <section class="form-group">
      <label for="">Note: </label>
      <textarea name="note"></textarea>
    </section>
  </section>
  <h3>Chọn phương thức thanh toán</h3>
  <?php
    $query="select*from ordermethod where status";
    $result=$connect->query($query);
  ?>
  <select name="ordermethodid" id="">
    <?php foreach($result as $item): ?>
      <option value="<?= $item['id'] ?>"><?= $item['name']?></option>
    <?php endforeach; ?>
  </select>
<br>
<br>
  <section>
      <input type="submit" value="Đặt hàng">
  </section>
</form>

