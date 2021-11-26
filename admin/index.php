<?php $connect = new MySQLi('localhost', 'root', '','project'); ?>
<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ADMIN</title>
    <link rel="stylesheet" tyle="text/css" href="css.css">
    <script src="../ckeditor/ckeditor.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<?php
    if (isset($_POST['username'])) {
      $username = $_POST['username'];
      $password = md5($_POST['password']);
      $query = "select * from admin where username='$username' and password = '$password'";
      $result = $connect->query($query);
      if (mysqli_num_rows($result)==0) {
        $alert="Sai ten dang nhap hoac mat khau";
      }else{
        $result=mysqli_fetch_array($result);
        if ($result['status']==0) {
          $alert="Tai khoan cua ban bi khoa";
        }else{
          $_SESSION['admin']=$username;
          header("Refresh:0");
        }
      }
    }
?>

<section>
 <?php
   if(isset($_SESSION['admin'])){
      include"admincontrolpanel.php";
   }else{
      include"loginadmin.php";
   }
 ?>
</section>
</body>
</html>
