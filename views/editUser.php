<?php isset($flash)?Flight::util()->success($flash['word'],$flash['action']):""; ?>
<form method="POST" action="<?php Flight::link('/editUser/')?>">
  <input type="hidden" value="<?php echo $user->id; ?>" name="id">
  <input type="hidden" value="<?php echo $user->role;?>"  name="role">
  <div class="row">

  <?php if(isset($error['surname']['type']))Flight::util()->error($error['surname']); ?>
  <div class="input-group">
    <span class="input-group-addon" id="surname">Surname</span>
    <input type="text" value="<?php echo $user->surname ?>" name="surname" class="form-control" aria-describedby="surname" required>
  </div>
    <?php if(isset($error['forename']['type']))Flight::util()->error($error['forename']); ?>
  <div class="input-group">
    <span class="input-group-addon" id="forename">Forename</span>
    <input type="text" value="<?php echo $user->forename ?>" name="forename" class="form-control" aria-describedby="forename" required>
  </div>
    <?php if(isset($error['email']['type']))Flight::util()->error($error['email']); ?>
  <div class="input-group">
    <span class="input-group-addon" id="email">Email</span>
    <input type="email" value="<?php echo $user->email ?>" name="email" class="form-control" aria-describedby="email" required>
  </div>
  <?php if(isset($error['team']['type']))Flight::util()->error($error['teams']); ?>
  <div style='<?php echo Flight::auth()->currentUser->role!=20||$user->id == Flight::auth()->currentUser->id?"display:none":""?>' class="input-group">
    <span class="input-group-addon" id="team">Team</span>
    <select name="teams[]" multiple class="form-control" aria-describedby="teams" required>
      <?php
        $user_teams = $user->getTeams();
        $user_team_ids = array_map(function($team){
          return $team->id;
        },$user_teams);
        foreach($teams as $team):?>
          <option <?php echo in_array($team->id,$user_team_ids)?"selected='selected'":""; ?> value='<?php echo $team->id ?>'><?php echo $team->name; ?></option>
        <?php endforeach; ?>
      </select>
  </div>
  <button type="submit" class="btn btn-success">Update</button>
</div>
</form>
