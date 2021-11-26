<?php
    if (isset($_POST['status'])) {
        $connect->query("update orders set status=".$_POST['status']." where id =".$_GET['id']);
        header("Refresh:0");
    }
    if (isset($_GET['action'])) {
        $condition=" where orderid=".$_GET['orderid']." and productid=".$_GET['productid'];
        if ($_GET['type']=='asc') {
            $query="update orderdetail set number=number+1".$condition;
        } else{
            $query="update orderdetail set number=number-1".$condition;
        }
        $connect->query($query);
        header("Location: ?option=orderdetail&id=".$_GET['id']);
    }
?>
<?php
    $query = "select a.fullname, a.mobile as 'mobilemember',a.address as 'addressmember', a.email as 'emailmember',b.*,
    c.name as 'nameordermethod' from member a join orders b on a.id=b.memberid join ordermethod c on b.ordermethodid=c.id where b.id=".$_GET['id'];
    $order = mysqli_fetch_array($connect->query($query));
?>
<h1>CHI TIẾT ĐƠN HÀNG <br>(Mã đơn hàng: <?= $order['id'] ?>)</h1>
<h2>THÔNG TIN NGƯỜI ĐẶT HÀNG</h2>
<table class="table">
    <tbody>
        <tr>
            <td>Họ tên: </td>
            <td><?= $order['fullname'] ?></td>
        </tr>
        <tr>
            <td>Điện thoại: </td>
            <td><?= $order['mobilemember'] ?></td>
        </tr>
        <tr>
            <td>Địa chỉ: </td>
            <td><?= $order['addressmember'] ?></td>
        </tr>
        <tr>
            <td>Email: </td>
            <td><?= $order['emailmember'] ?></td>
        </tr>
        <tr>
            <td>Note: </td>
            <td><?= $order['note'] ?></td>
        </tr>
    </tbody>
</table>
<h2>THÔNG TIN NGƯỜI NHẬN HÀNG</h2>
<table class="table">
    <tbody>
        <tr>
            <td>Họ tên: </td>
            <td><?= $order['name'] ?></td>
        </tr>
        <tr>
            <td>Điện thoại: </td>
            <td><?= $order['mobile'] ?></td>
        </tr>
        <tr>
            <td>Địa chỉ: </td>
            <td><?= $order['address'] ?></td>
        </tr>
        <tr>
            <td>Email: </td>
            <td><?= $order['email'] ?></td>
        </tr>
    </tbody>
</table>
<h2>PHƯƠNG THỨC THANH TOÁN</h2>
<section><?= $order['nameordermethod'] ?></section><br>

<?php
    $query = "select a.status,b.*,c.name, c.image from orders a join orderdetail b on a.id=b.orderid join products c on b.productid=c.id where a.id=".$order['id'];
    $orderdetails = $connect->query($query);
?>
<form method="post">
    <h2>CÁC SẢN PHẨM ĐẶT MUA</h2>
    <table class="table table-bordered">
        <?php $count=1; ?>
        <thead>
            <tr>
                <td>STT</td>
                <td>Name</td>
                <td>Image</td>
                <td>Price</td>
                <td>Amount</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($orderdetails as $item):?>
            <tr>
                <td><?= $count++ ?></td>
                <td><?= $item['name'] ?></td>
                <td width="30%"><img src="../images/<?=$item['image']?>" width="20%"></td>
                <td><?=number_format($item['price'],0,',','.')?></td>
                <td><?= $item['number'] ?>
                    <input type="button" value="+" onclick="location='?option=orderdetail&id=<?=$_GET['id']?>&action=update&type=asc&orderid=<?=$item['orderid']?>&productid=<?=$item['productid']?>';">
                    <input <?= $item['number']==0?'disable':''?> type="button" value="-" onclick="location='?option=orderdetail&id=<?=$_GET['id']?>&action=update&type=desc&orderid=<?=$item['orderid']?>&productid=<?=$item['productid']?>';">
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h2>TRẠNG THÁI ĐƠN HÀNG</h2>
    <p style="display: <?=$order['status']==2 || $order['status']==3?'none':''?>">
        <input type="radio" name="status" value="1" <?= $order['status']==1?'checked':'' ?>>Chưa xử lý
    </p>
    <p style="display: <?= $order['status']==3?'none':''?>">
        <input type="radio" name="status" value="2" <?= $order['status']==2?'checked':'' ?>>Đang xử lý
    </p>
    <p><input type="radio" name="status" value="3" <?= $order['status']==3?'checked':'' ?>>Đã xử lý
    </p>
    <p style="display: <?= $order['status']==3?'none':''?>">
        <input type="radio" name="status" value="4" <?= $order['status']==4?'checked':'' ?>>Hủy
    </p>
    <section><input <?= $order['status']==3?'disable':''?> type="submit" value="Update đơn hàng" class="btn btn-primary">
    <a href="?option=order&status=1" class="btn btn-outline-secondary">&lt; Back</a>
    </section>
</form>
