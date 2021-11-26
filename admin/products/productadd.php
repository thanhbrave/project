<?php
    if(isset($_POST['name'])) {
      $name = $_POST['name'];
      $query = "select * from products where name='$name'";
      $result = $connect->query($query);
      if(mysqli_num_rows($result)!=0) {
        $alert="Ten hang da ton tai";
      }else{
        $brandid = $_POST['brandid'];
        $description = $_POST['description'];
        $status = $_POST['status'];
        $price = $_POST['price'];
        // Save image
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
        $query = "insert products(name,brandid,price,description,image,status) values ('$name','$brandid','$price','$description','$imageName','$status')";
        $connect->query($query);
        header("Location: ?option=product");
      }
    }
?>
<?php
  $brands =$connect->query("select * from brands");
?>
<h1>TẠO SẢN PHẨM</h1>
<section class="container col-md-6">
<section style="color:red; font-weight: bold;"><?=isset($alert)?$alert: ""?></section>
    <form action="" method="post" enctype='multipart/form-data'>
      <section class="form-group">
        <label for="">Hãng: </label><br>
        <select name="brandid" id="" class="form-control">
          <option hidden>--Chọn hãng--</option>
          <?php foreach($brands as $item): ?>
            <option value="<?=$item['id']?>"><?= $item['name']?></option>
          <?php endforeach; ?>
        </select>
      </section>
      <section class="form-group">
        <label for="">Name: </label><br>
        <input type="text" name="name" id="" class="form-control">
      </section>
      <section class="form-group">
        <label for="">Gía: </label><br>
        <input name="price" class="form-control">
      </section>
      <section class="form-group">
        <label for="">Image: </label><br>
        <input type="file" name="image" id="" class="form-control">
      </section>
      <section class="form-group">
        <label for="">Description: </label><br>
        <textarea name="description" id="description"></textarea>
        <script>CKEDITOR.replace("description");</script>
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
