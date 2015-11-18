<!DOCTYPE html>
<html>
<header>
  <title>Club</title>
  <link href="<?php Flight::link('/public/lib/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?php Flight::link('/public/main.css') ?>" rel="stylesheet">
</header>
<body>

  <nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
      <div class="navbar-header">
          <a class="navbar-brand" href="<?php Flight::link('/') ?>"><i class="fa fa-futbol-o"></i> Club</a>
      </div>

      <?php if(Flight::auth()->online()): ?>
      <ul class="nav navbar-nav navbar-right">
        <?php if(Flight::auth()->currentUser->role==20): ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Create <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php FLight::link('/createUser') ?>">User</a></li>
            <li><a href="<?php Flight::link('createPlayer') ?>">Player</a></li>
            <li><a href="<?php Flight::link('/createTeam') ?>">Team</a></li>
          </ul>
        </li>
      <?php endif; ?>
       <li class="dropdown">
         <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Teams <span class="caret"></span></a>
         <ul class="dropdown-menu">
           <?php
           $teams = Flight::auth()->currentUser->getTeams();
           foreach($teams as $team): ?>
              <li><a href="<?php Flight::link('/team/'.$team->id) ?>"><?php echo $team->name; ?></a></li>
           <?php endforeach; ?>
         </ul>
       </li>
       <li class="dropdown">
       <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo Flight::auth()->currentUser->forename; ?><span class="caret"></span></a>
         <ul class="dropdown-menu">
           <li><a href="<?php Flight::link('/editUser/') ?>">Edit Profile</a></li>
            <li role="separator" class="divider"></li>
           <li><a href="<?php Flight::link('/logout/') ?>">Logout</a></li>
         </ul>
      </li>
     </ul>
   <?php endif; ?>
  </div>
  </nav>
  <div class="container">
  <?php
    echo $body_content;
   ?>
 </div>
<script src="<?php Flight::link('/public/lib/jquery/jquery-2.1.4.min.js') ?>"></script>
 <script src="<?php FLight::link('/public/lib/bootstrap/js/bootstrap.min.js') ?>"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</body>
</html>
