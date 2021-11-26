<?php
    $chuaXuLy=mysqli_num_rows($connect->query("select * from orders where status=1"));
    $dangXuLy=mysqli_num_rows($connect->query("select * from orders where status=2"));
    $daXuLy=mysqli_num_rows($connect->query("select * from orders where status=3"));
    $huy=mysqli_num_rows($connect->query("select * from orders where status=4"));
?>

<table class="table table-bordered tbl-admin">
    <thead>
        <tr>
            <td width="15%" height="100">Hello: <?=$_SESSION['admin']?><br>[<a href="?option=logout">Log out</a>]</td>
            <td align="center"><h1>TRANG QUẢN TRỊ HỆ THỐNG</h1></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <section><a href="?option=brand">>>>> Hãng sản xuất </a></section>
                <section><a href="?option=product">>>>> Sản phẩm </a></section>
                <section>>>>> Đơn hàng
                    <section><a href="?option=order&status=1">&nbsp;&nbsp;&nbsp;>> Đơn hàng chưa xử lý [<span style="color:red"><?=$chuaXuLy?></span>]</a></section>
                    <section><a href="?option=order&status=2">&nbsp;&nbsp;&nbsp;>> Đơn hàng đang xử lý [<span style="color:red"><?=$dangXuLy?></span>]</a></section>
                    <section><a href="?option=order&status=3">&nbsp;&nbsp;&nbsp;>> Đơn hàng đã xử lý [<span style="color:red"><?=$daXuLy?></span>]</a></section>
                    <section><a href="?option=order&status=4">&nbsp;&nbsp;&nbsp;>> Đơn hàng đã hủy[<span style="color:red"><?=$huy?></span>]</a></section>
                </section>
            </td>
            <td>
                <?php
                if (isset($_GET['option'])) {
                    switch ($_GET['option']) {
                        case 'logout':
                            unset($_SESSION['admin']);
                            header("Location: .");
                            break;
                        case 'brand':
                            include"brands/showbrands.php";
                            break;
                        case 'brandadd':
                            include"brands/brandadd.php";
                            break;
                        case 'brandupdate':
                            include"brands/brandupdate.php";
                            break;
                        case 'product':
                            include"products/showproducts.php";
                            break;
                        case 'productadd':
                            include"products/productadd.php";
                            break;
                        case 'productupdate':
                            include"products/productupdate.php";
                            break;
                        case 'order':
                            include"orders/showorders.php";
                            break;
                        case 'orderdetail':
                            include"orders/orderdetail.php";
                            break;
                    }
                }
                ?>
            </td>
        </tr>
    </tbody>
</table>
