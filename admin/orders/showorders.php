<?php
if (isset($_GET['id'])) {
    $id=$_GET['id'];
    $connect->query("delete from orderdetail where orderid=$id");
    $connect->query("delete from orders where status=$id");
    header("Location: ?option=order&status=4");
}

?>
<?php
    $status=$_GET['status'];
    $query = "select * from orders where status=".$_GET['status'];
    $result = $connect->query($query);
?>
<h1>ĐƠN HÀNG <?= $status==1?'Chưa xử lý':($status==2?'Đang xử lý':($status==3?'Đã xử lý':'HỦY'))?></h1>
<table class="table table-bordered">
    <thead>
        <tr>
            <td>STT</td>
            <td>ID</td>
            <td>Date</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        <?php $count=1; ?>
        <?php foreach($result as $item):?>
        <tr>
            <td><?= $count++ ?></td>
            <td><?= $item['id']?></td>
            <td><?= $item['orderdate'] ?></td>
            <td>
              <a class="btn btn-sm btn-info" href="?option=orderdetail&id=<?= $item['id'] ?>">Detail</a>
              <a class="btn btn-sm btn-danger" style="display:<?= $status==4?'':'none' ?>" href="?option=order&id=<?= $item['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
