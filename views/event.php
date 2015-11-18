<div class="row">
  <?php $players = []; ?>
  <h1><?php $event->getIcon();?> <?php echo $event->title; ?></h1>
  <h4><?php echo $event->start; ?> - <?php echo $event->end; ?></h4>
  <pre><?php echo $event->text ?></pre>

  <?php $absences = $team->getAbsencesInTimerange($event->start,$event->end); ?>

  <?php if(count($absences)>0): ?>
    <h4>Absences</h4>
    <table class="table">
      <tr><th>Reason</th><th>Name</th><th width="20px">Delete</th></tr>
      <?php foreach($absences as $absence): ?>
        <?php $players[] = $absence->player; ?>
        <tr><td><?php echo $absence->getIcon(); ?></td><td><?php $player = Flight::players()->getPlayerWithId($absence->player); echo $player->forename. " ".$player->surname;?></td><td style="text-align:center"><a href="<?php FLight::link('/deleteAbsence/'.$absence->id) ?>"><i class="fa fa-trash-o"></i></a></td></tr>
      <?php endforeach; ?>
    </table>
  <?php else: ?>
    <h4>No Absences for this Event</h4>
  <?php endif;?>
    <a href="<?php Flight::link('/createAbsence/'.$event->team.'/'.$event->id) ?>"><button class="btn btn-success">Add new Absence</button></a>
    <a href="<?php Flight::link('/deleteEvent/'.$event->id) ?>"><button class="btn btn-danger">Remove Event</button></a>
  <a target="_blank" href='mailto:<?php foreach($team->getReadyPlayersInTimerange($players) as $player){echo $player->email.";";} ?>?subject=<?php echo urlencode($event->title); ?>&body=<?php echo urlencode($event->text); ?> %0D%0A %0D%0AStart: <?php echo $event->start;?> %0D%0AEnd: <?php echo $event->end;?>'><button class="btn btn-primary">Send Mail</button></a>
</div>
