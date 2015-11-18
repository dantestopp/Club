<?php isset($flash)?Flight::util()->success($flash['word'],$flash['action']):""; ?>
<form method="POST" action="createPlayer">
  <input type="hidden" value="player" name="type">
  <div class="row">

  <?php if(isset($error['surname']['type']))Flight::util()->error($error['surname']); ?>
  <div class="input-group">
    <span class="input-group-addon" id="surname">Surname</span>
    <input type="text" value="<?php echo isset($error['surname'])?$error['surname']['value']:''?>" name="surname" class="form-control" aria-describedby="surname" required>
  </div>
    <?php if(isset($error['forename']['type']))Flight::util()->error($error['forename']); ?>
  <div class="input-group">
    <span class="input-group-addon" id="forename">Forename</span>
    <input type="text" value="<?php echo isset($error['forename'])?$error['forename']['value']:''?>" name="forename" class="form-control" aria-describedby="forename" required>
  </div>
    <?php if(isset($error['email']['type']))Flight::util()->error($error['email']); ?>
  <div class="input-group">
    <span class="input-group-addon" id="email">Email</span>
    <input type="email" value="<?php echo isset($error['email'])?$error['email']['value']:''?>" name="email" class="form-control" aria-describedby="email" required>
  </div>
  <?php if(isset($error['phone_mobile']['type']))Flight::util()->error($error['phone_mobile']); ?>
  <div class="input-group">
    <span class="input-group-addon" id="phone_mobile">Phone Mobile</span>
    <input type="tel" value="<?php echo isset($error['phone_mobile'])?$error['phone_mobile']['value']:''?>" name="phone_mobile" class="form-control" aria-describedby="phone_mobile">
  </div>
  <?php if(isset($error['phone_home']['type']))Flight::util()->error($error['phone_home']); ?>
  <div class="input-group">
    <span class="input-group-addon" id="phone_home">Phone Home</span>
    <input type="tel" value="<?php echo isset($error['phone_home'])?$error['phone_home']['value']:''?>" name="phone_home" class="form-control" aria-describedby="phone_home">
  </div>
  <?php if(isset($error['team']['type']))Flight::util()->error($error['team']); ?>
  <div class="input-group">
    <span class="input-group-addon" id="team">Team</span>
    <select name="team" class="form-control" aria-describedby="team" required>
      <?php
        foreach($teams as $team){
          echo "<option value='".$team->id."'>".$team->name."</option>";
        }
        ?>
      </select>
  </div>
  <button type="submit" class="btn btn-success">Create</button>
</div>
</form>
