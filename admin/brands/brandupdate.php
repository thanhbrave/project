<?php
    $brand=mysqli_fetch_array($connect->query("select * from brands where id=".$_GET['id']));
?>
<?php
    if (isset($_POST['name'])) {
      $name = $_POST['name'];
      $query = "select * from brands where name='$name' and id!=".$brand['id'];
      $result = $connect->query($query);
      if (mysqli_num_rows($result)!=0) {
        $alert="Ten hang da ton tai";
      }else{
        $status = $_POST['status'];
        $query = "update brands set name='$name', status='$status' where id=".$brand['id'];
        $connect->query($query);
        header("Location: ?option=brand");
      }
    }
?>
<h1>SỬA THÔNG TIN HÃNG SẢN XUẤT</h1>
<section style="color:red; font-weight: bold;"><?=isset($alert)?$alert: ""?></section>
<section class="container col-md-6">
    <form action="" method="post">
      <section class="form-group">
        <label for="">Name: </label><br>
        <input type="text" name="name" value="<?= $brand['name'] ?>" class="form-control">
      </section>
      <section class="form-group">
        <label for="">Status </label><br>
        <input type="radio" name="status" value="1" <?= $brand['status']==1? 'checked':''?>> Active
        <input type="radio" name="status" value="0"> Unactive
      </section>
      <section>
        <input type="submit" value="add" class="btn btn-primary">
      </section>
    </form>
</section>
