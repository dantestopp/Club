<div class="row">
<h1><?php echo $team_count == 0?"No Teams found":"Teams";?></h1>
  <?php if($team_count > 0){
    echo "<ul>";
    foreach($teams as $team){
      echo "<li><a href='team/".$team->id."'>".$team->name."</a></li>";
    }
    echo "</ul>";
  }
  ?>
</div>
