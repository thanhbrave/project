<?php
      $query = "select * from brands";
      $result = $connect->query($query);
?>

  <?php foreach ($result as $item):?>
  <section class="left">
    <section><a href="?option=showproducts&brandid=<?= $item['id']?>"><?= $item['name'] ?></a></section>
  </section>
  <?php endforeach;?>
