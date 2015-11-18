<h4>Players</h4>
  <?php if(count($players)>0): ?>
    <table class='table'>
    <tr><th>Forename</th><th>Surname</th><th>Team</th><th>Detail</th></tr>
    <?php foreach($players as $player): ?>
      <tr></td><td><?php echo $player->forename; ?></td><td><?php echo $player->surname ?></td><td><?php echo Flight::teams()->getTeamNameWithId($player->team) ?></td><td><a href='<?php Flight::link('/player/'.$player->id) ?>'>View Details</a></tr>
      <?php endforeach; ?>
    </table>
    <?php else: ?>
      <h5>No Players in this Team <a href="<?php Flight::link('/asignPlayer') ?>">asign</a> or <a href="<?php Flight::link('/createPlayer') ?>">create</a> one</h5>
    <?php endif; ?>
