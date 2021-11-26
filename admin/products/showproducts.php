<?php
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $products = $connect->query("select * from orderdetail where productid=$id");
      if (mysqli_num_rows($products)!=0) {
        $connect->query("update products set status=0 where id=$id");
      }else{
        $connect->query("delete from products where id=$id");
        //unlink("../images/".$_GET['image']);
      }
    }
?>
<?php
    $query = "select * from products";
    $result = $connect->query($query);
?>
<h1>DANH MỤC SẢN PHẨM</h1>
<section style="text-align: center"><a class="btn btn-success" href="?option=productadd">Thêm sản phẩm</a></section><br>
<table class="table table-bordered">
    <thead>
        <tr>
            <td>STT</td>
            <td>ID</td>
            <td>Name</td>
            <td>Price</td>
            <td>Image</td>
            <td>Status</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        <?php $count=1; ?>
        <?php foreach($result as $item):?>
        <tr>
            <td><?= $count++ ?></td>
            <td><?= $item['id']?></td>
            <td><?= $item['name'] ?></td>
            <td><?=number_format($item['price'],0,',','.')?></td>
            <td width="30%"><img src="../images/<?=$item['image']?>" width="20%"></td>
            <td><?= $item['status']==1?'Actice':'Unactice' ?></td>
            <td>
              <a class="btn btn-sm btn-info" href="?option=productupdate&id=<?= $item['id'] ?>">Update</a>
              <a class="btn btn-sm btn-danger" href="?option=product&id=<?= $item['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
