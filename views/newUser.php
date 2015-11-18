<?php isset($flash)?Flight::util()->success($flash['word'],$flash['action']):""; ?>
<form method="POST" action="<?php Flight::link('/createUser') ?>">
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
  <?php if(isset($error['team']['type']))Flight::util()->error($error['teams']); ?>
  <div class="input-group">
    <span class="input-group-addon" id="team">Team</span>
    <select name="teams[]" multiple class="form-control" aria-describedby="teams" required>
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
