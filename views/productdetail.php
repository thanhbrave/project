<?php
      if (isset($_POST['content'])):
        $content=$_POST['content'];
        $productid = $_GET['id'];
        if (isset($_SESSION['member'])):
          $memberid = mysqli_fetch_array($connect->query("select*from member where username='".$_SESSION['member']."'"));
          $memberid = $memberid['id'];
          $connect->query("insert comments(memberid,productid,date,content) values ($memberid,$productid,now(),'$content')");
          echo"<script>alert('Your comment is submitted and it will be showed soon!')</script>";
        else:
          $_SESSION['content'] = $content;
          echo"<script>alert('Your must signin to comment'); location='?option=signin&productid=$productid';</script>";
        endif;
      endif;
?>
<?php
      $id = $_GET['id'];
      $query = "select * from products where id=$id";
      $result = $connect->query($query);
      $item = mysqli_fetch_array($result);
?>
<h2>THÔNG TIN CHI TIẾT SẢN PHẨM </h2>
  <section class="productdetail">
    <section class="img"><img src="images/<?=$item['image']?>"></section>
    <section class="name"><b> <?=$item['name']?></b></section>
    <section class="price"><?=number_format($item['price'],0,',','.')?></section>
    <section><input type="button" value="BUY" onclick="location='?option=cart&action=add&id=<?=$item['id']?>';"></section>
  </section>
<hr>
<?= $item['description'] ?>
<hr>
<section>
  <h2>Comments: </h2>
  <?php
      $comments = $connect->query("select*from member a join comments b on a.id=b.memberid join products c on b.productid=c.id where b.status and productid=".$_GET['id']);
      if(mysqli_num_rows($comments)==0):
        echo"<section style='color:green'>No comments!</section>";
      else:
        foreach($comments as $comment):
  ?>
      <section style="font-weight: bold;"> <?= $comment['username'] ?></section>
      <section style="padding-left: 2%;"> <?= $comment['content'] ?></section>
      <?php
          endforeach;
        endif;
  ?>
  <form method="post">
    <section>
      <textarea name="content" style="width: 100%" class="form-control" rows="5"></textarea>
    </section>
    <section><input type="submit" value="Submit" class="btn btn-primary"></section>
  </form>
</section>
