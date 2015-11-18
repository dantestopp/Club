<?php isset($flash)?Flight::util()->success($flash['word'],$flash['action']):""; ?>
<form method="POST" action="<?php Flight::link('/player/'.$player->id.'/update') ?>">
  <div class="row">
    <input type="hidden" value="<?php echo $player->id; ?>" name="id">
  </div>
  <div class="row">
        <?php if(isset($error['surname']['type']))Flight::util()->error($error['surname']); ?>
    <div class="input-group">
      <span class="input-group-addon" id="surname">Nachname</span>
      <input type="text" name="surname" value="<?php echo $player->surname;?>" class="form-control" aria-describedby="surname" required>
    </div>
  </div>
  <div class="row">
        <?php if(isset($error['forename']['type']))Flight::util()->error($error['forename']); ?>
    <div class="input-group">
      <span class="input-group-addon" id="forename">Vorname</span>
      <input type="text" name="forename" value="<?php echo $player->forename;?>" class="form-control" aria-describedby="forename" required>
    </div>
  </div>
  <div class="row">
        <?php if(isset($error['email']['type']))Flight::util()->error($error['email']); ?>
    <div class="input-group">
      <span class="input-group-addon" id="email">Email</span>
      <input type="email" name="email" value="<?php echo $player->email;?>" class="form-control" aria-describedby="email" required>
    </div>
  </div>
  <div class="row">
        <?php if(isset($error['phone_mobile']['type']))Flight::util()->error($error['phone_mobile']); ?>
    <div class="input-group">
      <span class="input-group-addon" id="phone_mobile">Phone Mobile</span>
      <input type="tel" name="phone_mobile" value="<?php echo $player->phone_mobile;?>" class="form-control" aria-describedby="phone_mobile">
    </div>
  </div>
  <div class="row">
        <?php if(isset($error['phone_home']['type']))Flight::util()->error($error['phone_home']); ?>
    <div class="input-group">
      <span class="input-group-addon" id="phone_home">Phone Home</span>
      <input type="tel" name="phone_home" value="<?php echo $player->phone_home;?>" class="form-control" aria-describedby="phone_home">
    </div>
  </div>
  <div class="row">
        <?php if(isset($error['team']['type']))Flight::util()->error($error['team']); ?>
    <select name="team" class="form-control" required>
      <?php
        foreach($teams as $team){
          echo "<option ".($team->id==$player->team?"selected='selected'":"")." value='".$team->id."'>".$team->name."</option>";
        }
        ?>
    </select>
  </div>
  <button type="submit" class="btn btn-success">Update</button>
</div>
</form>
