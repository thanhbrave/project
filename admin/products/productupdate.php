<?php
  $product=mysqli_fetch_array($connect->query("select * from products where id=".$_GET['id']));
?>
<?php
    if(isset($_POST['name'])) {
      $name = $_POST['name'];
      $query = "select * from products where name='$name' and id!=".$product['id'];
      $result = $connect->query($query);
      if(mysqli_num_rows($result)!=0) {
        $alert="Da da ton tai san pham nay";
      }else{
        $brandid = $_POST['brandid'];
        $description = $_POST['description'];
        $status = $_POST['status'];
        $price = $_POST['price'];
        $store="../images/";
        $imageName = $_FILES['image']['name'];
        $imageTemp = $_FILES['image']['tmp_name'];
        $exp3 = substr($imageName, strlen($imageName)-3);
        $exp4 = substr($imageName, strlen($imageName)-4);
        if ($exp3=='jpg'||$exp3=='png'||$exp4=='jpeg') {
          $imageName = time().'_'.$imageName;
          move_uploaded_file($imageTemp, $store.$imageName);
          unlink($store.$product['image']);
        }
        if(empty($imageName)) {
          $imageName = $product['image'];
        }
        $query = "update products set name='$name',brandid='$brandid',price='$price',description='$description',image='$imageName',status='$status' where id=".$product['id'];
        $connect->query($query);
        header("Location: ?option=product");
      }
    }
?>
<?php
  $brands =$connect->query("select * from brands");
?>
<h1>SỬA THÔNG TIN SẢN PHẨM</h1>
<section style="color:red; font-weight: bold;"><?=isset($alert)?$alert: ""?></section>
<section class="container col-md-6">
    <form action="" method="post" enctype='multipart/form-data'>
      <section class="form-group">
        <label for="">Hãng: </label><br>
        <select name="brandid" id="" class="form-control">
          <option hidden>--Chọn hãng--</option>
          <?php foreach($brands as $item): ?>
            <option value="<?=$item['id']?>" <?=$item['id']==$product['brandid']?'selected':''?>><?= $item['name']?></option>
          <?php endforeach; ?>
        </select>
      </section>
      <section class="form-group">
        <label for="">Name: </label><br>
        <input type="text" name="name"  value="<?= $product['name'] ?>" class="form-control">
      </section>
      <section class="form-group">
        <label for="">Gía: </label><br>
        <input name="price" value="<?= $product['price'] ?>" class="form-control">
      </section>
      <section class="form-group">
        <label for="">Image: </label><br>
        <img src="../images/<?= $product['image'] ?>">
        <input type="file" name="image" class="form-control">
      </section>
      <section class="form-group">
        <label for="">Description: </label><br>
        <textarea name="description" id="description"><?= $product['description'] ?></textarea>
        <script>CKEDITOR.replace("description");</script>
      </section>
      <section class="form-group">
        <label for="">Status </label><br>
        <input type="radio" name="status" value="1"  <?= $product['status']==1? 'checked':''?>> Active
        <input type="radio" name="status" value="0"> Unactive
      </section>
      <section>
        <input type="submit" value="add" class="btn btn-primary">
      </section>
    </form>
</section>
