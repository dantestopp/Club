<div class="row">
<h1><?php echo $team->name; ?></h1>

<h2>Coaches: <?php foreach($coaches as $coach):?>
                <?php if(Flight::auth()->currentUser->role == 20): ?>
                        <a href="<?php Flight::link('/editUser/'.$coach->id) ?>"><?php echo $coach->forename;?> <?php echo $coach->surname; ?></a>
                <?php else: ?>
                        <?php echo $coach->forename;?> <?php echo $coach->surname; ?>,
                <?php endif; ?>
          <?php endforeach; ?>
</h2>
</div>
<div class="row">
  <div class="col-md-6">
  <h4>Events</h4>
    <?php if(count($events)>0): ?>
      <table class="table">
        <tr><th>Type</th><th>Title</th><th>Start</th></tr>
      <?php foreach($events as $event):?>
        <tr><td><?php echo $event->getIcon(); ?></td><td><a href="<?php Flight::link('/event/'.$event->id)?>"><?php echo $event->title; ?></a></td><td><?php echo $event->start; ?></td></tr>
      <?php endforeach; ?>
      </table>
    <?php else: ?>
      <h5>No Events</h5>
    <?php endif;?>
  </div>
  <div class="col-md-6">
<h4>Players</h4>
  <?php if(count($players)>0):?>
    <table class='table'>
      <tr><th>Forename</th><th>Surname</th><th>Detail</th></tr>
      <?php foreach($players as $player): ?>
        <tr></td><td><?php echo $player->forename; ?></td><td><?php echo $player->surname ?></td><td><a href='<?php Flight::link('/player/'.$player->id) ?>'>View Details</a></tr>
      <?php endforeach; ?>
    </table>
    <?php else: ?>
        <h5>No Players in this Team <a href="<?php Flight::link('/players') ?>">asign</a> or <a href="<?php Flight::link('/createPlayer') ?>">create</a> one</h5>
    <?php endif; ?>
</div>
</div>
<div class="row">
  <a href="<?php Flight::link('/createEvent/'.$team->id) ?>"><button type="submit" class="btn btn-success">Create Event</button></a>
  <a href="<?php Flight::link('/createAbsence/'.$team->id) ?>"><button type="submit" class="btn btn-success">Create Absence</button></a>
  <?php if(Flight::auth()->currentUser->role == 20): ?>
    <a href="<?php Flight::link('/deleteTeam/'.$team->id); ?>"><button type="submit" class="btn btn-danger">Delete Team</button></a>
  <?php endif; ?>
</div>
