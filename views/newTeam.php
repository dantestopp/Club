<form method="post" action="createTeam" class="form-inline">
  <?php if(isset($error['name']['name']))Flight::util()->error($error['name']); ?>
  <div class="form-group">
    <label for="name">Teamname</label>
    <input type="text" class="form-control" value="<?php echo isset($error['name'])?$error['name']['value']:''?>" name="name" id="name" placeholder="Ea">
  </div>
  <button type="submit" class="btn btn-success">Create Team</button>
</form>
