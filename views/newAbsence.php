<form method="POST" action="<?php Flight::link('/createAbsence/'.$team->id.'/'.(isset($event)?$event->id:'')) ?>">
  <div class="row">

  <div class="input-group">
    <span class="input-group-addon" id="start">From</span>
    <input type=<?php echo isset($event)?"datetime":"datetime-local";?>  <?php echo isset($event)?'readonly':''; ?> name="start" value="<?php echo isset($event)?$event->start:''; ?>" class="form-control" aria-describedby="from" required>
  </div>
  <div class="input-group">
    <span class="input-group-addon" id="end">To</span>
    <input type=<?php echo isset($event)?"datetime":"datetime-local";?> <?php echo isset($event)?'readonly':''; ?> name="end" value="<?php echo isset($event)?$event->end:''; ?>" class="form-control" aria-describedby="to" required>
  </div>
  <div class="input-group">
    <span class="input-group-addon" id="reason">Reason</span>
    <select name="reason" class="form-control" aria-describedby="reason">
      <option value="10">Injury</option>
      <option value="20">Ill</option>
      <option value="30">Unknown</option>
    </select>
  </div>
  <div class="input-group">
    <span class="input-group-addon" id="player">Player</span>
  <select name="player" class="form-control" aria-describedby="player" required>
    <?php
      $players = $team->getPlayers();
      foreach($team->getPlayers() as $player){
        echo "<option value='".$player->id."'>".$player->forename." ".$player->surname."</option>";
      }
      ?>
  </select>
</div>
  <button type="submit" class="btn btn-success">Create</button>
</form>
