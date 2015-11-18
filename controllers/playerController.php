<?php

class playerController{

  public function getPlayerWithId($id){
    $sql = "SELECT * FROM player WHERE id = '$id'";
    $result = Flight::db()->query($sql);
    return new player($result->fetch_assoc());
  }

  public function getAllPlayers(){
    $sql = "SELECT * FROM player ORDER BY team DESC";
    $result = Flight::db()->query($sql);
    $players = array();
    while($row = $result->fetch_assoc()){
      $players[] = new player($row);
    }
    return $players;
  }

  public function saveNewPlayer(){
    Flight::auth()->check(20);

    $response = Flight::util()->validate('player',Flight::request()->data);
    if(is_array($response)){
      Flight::util()->render('newPlayer',array("teams"=>Flight::teams()->getAllTeams(),"error"=>$response));
      return;
    }
    $player = new player(Flight::request()->data);
    if($player->store()){
      Flight::util()->render('newPlayer',array("teams"=>Flight::teams()->getAllTeams(),"flash"=>array("word"=>"Player","action"=>"created")));
    }
  }

  public function showNewPlayer(){
    Flight::auth()->check(20);
    Flight::util()->render('newPlayer',array("teams"=>Flight::teams()->getAllTeams()));
  }

  public function updatePlayer($id){
    Flight::auth()->check();
    $response = Flight::util()->validate('player',Flight::request()->data);
    if(is_array($response)){
    Flight::util()->render('editPlayer',array('player'=>Flight::players()->getPlayerWithId($id),
                                              'teams'=>Flight::teams()->getAllTeams(),
                                              'error'=>$response
                                              ));
    return;
    }
    $player = new player(Flight::request()->data);
    $player->update();
    Flight::redirect('/player/'.$id);
  }

  public function showUpdatePlayer($id){
    Flight::auth()->check();
    Flight::util()->render('editPlayer',array('player'=>Flight::players()->getPlayerWithId($id),
                                              'teams'=>Flight::teams()->getAllTeams()
                                              ));
  }

  public function showPlayer($id){
    Flight::auth()->check();
    Flight::util()->render('player',array('player'=>Flight::players()->getPlayerWithId($id)));
  }

  public function showAllPlayers(){
    Flight::auth()->check(20);
    Flight::util()->render('players',array("players"=>Flight::players()->getAllPlayers()));
  }

  public function deletePlayer($id){
    Flight::auth()->check(20);
    $player = Flight::players()->getPlayerWithId($id);
    $team_id = $player->team;
    $player->delete();
    Flight::redirect('/team/'.$team_id);
  }
}
