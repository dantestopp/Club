<form method="POST" action="<?php Flight::link('/createEvent') ?>">
  <div class="row">
  <input type="hidden" name="team" value="<?php echo $team_id;?>">
  <?php if(isset($error['title']['type']))Flight::util()->error($error['title']); ?>
  <div class="input-group">
    <span class="input-group-addon" id="title">Title</span>
    <input type="text" name="title" class="form-control" aria-describedby="title" required>
  </div>

  <?php if(isset($error['start']['type']))Flight::util()->error($error['start']); ?>
  <div class="input-group">
    <span class="input-group-addon" id="start">From</span>
    <input type="datetime-local" name="start" class="form-control" aria-describedby="from" required>
  </div>
  <?php if(isset($error['end']['type']))Flight::util()->error($error['end']); ?>
  <div class="input-group">
    <span class="input-group-addon" id="end">To</span>
    <input type="datetime-local" name="end" class="form-control" aria-describedby="to" required>
  </div>
  <?php if(isset($error['type']['type']))Flight::util()->error($error['type']); ?>
  <div class="input-group">
    <span class="input-group-addon" id="type">Type</span>
    <select name="type" class="form-control" aria-describedby="type">
      <option selected value="10">Match</option>
      <option value="20">Training</option>
    </select>
  </div>
  <?php if(isset($error['text']['type']))Flight::util()->error($error['text']); ?>
  <div class="input-group">
    <span class="input-group-addon" id="text">Text</span>
    <textarea area-describedby="text" value="<?php echo isset($error['text'])?$error['text']['value']:''?>" class="form-control" name="text"></textarea>
  </div>
  <button type="submit" class="btn btn-success">Create</button>
</div>
</form>
