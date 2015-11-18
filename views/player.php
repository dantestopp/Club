<div class="row">
<h1><?php echo $player->forename." ".$player->surname;?></h1>
<div class="row">
  <div class="col-sm-2">Email:</div>
  <div class="col-sm-8"><a target="_blank" href="mailto:<?php echo $player->email; ?>"><?php echo $player->email; ?></a></div>
</div>
<div class="row">
  <div class="col-sm-2">Phone Home:</div>
  <div class="col-sm-8"><?php echo $player->phone_home; ?></div>
</div>
<div class="row">
  <div class="col-sm-2">Phone Mobile:</div>
  <div class="col-sm-8"><?php echo $player->phone_mobile; ?></div>
</div>
<div class="row">
  <a href="<?php Flight::link('/player/'.$player->id.'/update') ?>"><button type="button" class="btn btn-success">Update</button></a>
  <?php if(Flight::auth()->currentUser->role == 20):?>
    <a href="<?php Flight::link('/player/'.$player->id.'/delete') ?>"><button type="button" class="btn btn-danger">Delete</button></a>
  <?php endif;?>
</div>
