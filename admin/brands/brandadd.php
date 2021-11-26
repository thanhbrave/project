<?php
    if (isset($_POST['name'])) {
      $name = $_POST['name'];
      $query = "select * from brands where name='$name'";
      $result = $connect->query($query);
      if (mysqli_num_rows($result)!=0) {
        $alert="Ten hang da ton tai";
      }else{
        $status = $_POST['status'];
        $query = "insert brands(name,status) values ('$name','$status')";
        $connect->query($query);
        header("Location: ?option=brand");
      }
    }
?>
<h1>TẠO HÃNG SẢN XUẤT</h1>
<section class="container col-md-6">
<section style="color:red; font-weight: bold;"><?=isset($alert)?$alert: ""?></section>
    <form action="" method="post" enctype='multipart/form-data'>
      <section class="form-group">
        <label for="">Name: </label><br>
        <input type="text" name="name" id="">
      </section>
      <section class="form-group">
        <label for="">Status </label><br>
        <input type="radio" name="status" value="1" checked=""> Active
        <input type="radio" name="status" value="0"> Unactive
      </section>
      <section>
        <input type="submit" value="add" class="btn btn-primary">
      </section>
    </form>
</section>
