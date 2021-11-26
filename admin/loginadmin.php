 <h1>Admin Log in</h1>
  <section class="member-form"style="color:red"><?=isset($alert)?$alert: ""?></section>
  <section class="member-form col-4">
    <form action="" method="post">
      <section class="form-group">
        <label for="">Username: </label>
        <input type="text" name="username" id="" class="form-control">
      </section>
      <section class="form-group">
        <label for="">Password: </label>
        <input type="text" name="password" id="" class="form-control">
      </section>
      <br>
      <section class="form-group">
        <input type="submit" value="Log in"class="form-control btn btn-primary">
      </section>
    </form>
  </section>
