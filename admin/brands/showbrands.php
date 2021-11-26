<?php
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $products = $connect->query("select * from products where brandid=$id");
      if (mysqli_num_rows($products)!=0) {
        $connect->query("update brands set status=0 where id=$id");
      }else{
        $connect->query("delete from brands where id=$id");
      }
    }
?>
<?php
    $query = "select * from brands";
    $result = $connect->query($query);
?>
<h1>HÃNG SẢN XUẤT</h1>
<section style="text-align: center"><a class="btn btn-success" href="?option=brandadd">Tạo hãng sản xuất </a></section><br>
<table class="table table-bordered">
    <thead>
        <tr>
            <td>STT</td>
            <td>ID</td>
            <td>Name</td>
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
            <td><?= $item['status']==1?'Actice':'Unactice' ?></td>
            <td>
              <a class="btn btn-sm btn-info" href="?option=brandupdate&id=<?= $item['id'] ?>">Update</a>
              <a class="btn btn-sm btn-danger" href="?option=brand&id=<?= $item['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
