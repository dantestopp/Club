<form method="post" action="<?php Flight::link('/login') ?>">
<div class="row">
  <?php echo isset($error_string)? '<div class="alert alert-danger">Something went wrong.</div>':'';?>
  <div class="col-lg-5">
    <?php if(isset($error['email']['type']))Flight::util()->error($error['email']); ?>
    <div class="input-group">
      <span class="input-group-addon" id="email">Email</span>
      <input type="email" name="email" value="<?php echo isset(Flight::request()->data->email)?Flight::request()->data->email:''?>" class="form-control" aria-describedby="email">
    </div>
  </div>

  <div class="col-lg-5">
    <?php if(isset($error['password']['type']))Flight::util()->error($error['password']); ?>
    <div class="input-group">
      <span class="input-group-addon" id="password">password</span>
      <input type="password" name="password" class="form-control" aria-describedby="password">
    </div>
  </div>

  <div class="col-lg-2">
    <div class="input-group">
      <button type="submit" value="Send" class="btn btn-success" id="submit" >Login</button>
    </div>
  </div>
</div>
</form>
