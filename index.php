<?php $connect = new MySQLi('localhost', 'root', '','project'); ?>
<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" tyle="text/css" href="css/main.css">
</head>
<body>
<section class="wrapper">
    <header><?php include"views/layout/header.php";?></header>
    <nav><?php include"views/layout/menu-top.php";?></nav>
    <section class="body">
        <aside><?php include"views/layout/left.php";?></aside>
        <article><?php include"views/layout/article.php";?></article>
        <aside><?php include"views/layout/right.php";?></aside>
    </section>
    <footer>Created by Ly A Thanh 2021</footer>
</section>    
</body>
</html>
