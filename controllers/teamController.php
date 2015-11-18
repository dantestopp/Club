<?php

class teamController{

public function getTeamWithId($id){
      $sql = "SELECT * FROM team WHERE id = '$id'";
      $result = Flight::db()->query($sql);
      return new team($result->fetch_assoc());
  }

public function getAllTeams(){
      $sql = "SELECT * FROM team";
      $result = Flight::db()->query($sql);
      $teams = array();
      while($row = $result->fetch_assoc()){
        $teams[] = new team($row);
      }
      return $teams;
  }

public function getTeamNameWithId($id){
    $sql = "SELECT name FROM team WHERE id = '$id'";
    $result = Flight::db()->query($sql);
    return $result->fetch_assoc()['name'];
  }

public function showTeamList(){
    Flight::auth()->check();

    $teams = Flight::auth()->currentUser->getTeams();
    if(count($teams) == 1){
      Flight::redirect('/team/'.$teams[0]->id);
    }

    Flight::util()->render('teams',array("team_count"=>count($teams),"teams"=>$teams));
  }

public function showTeam($id){
    Flight::auth()->check();

    $team = Flight::teams()->getTeamWithId($id);
    Flight::util()->render('team',array("team"=>$team,
                                        "coaches"=>$team->getCoaches(),
                                        "players"=>$team->getPlayers(),
                                        "events"=>$team->getEvents()
                                      ));
  }

public function saveNewTeam(){
    Flight::auth()->check(20);
    $response = Flight::util()->validate('team',Flight::request()->data);
    if(is_array($response)){
      Flight::util()->render('newTeam',array("error"=>$response));
      return;
    }
    $team = new team(Flight::request()->data);
    $last_id = $team->store();
    Flight::redirect('/team/'.$last_id);
  }

public function showNewTeam(){
    Flight::auth()->check(20);
    Flight::util()->render('newTeam');
  }

public function deleteTeam($id){
    Flight::auth()->check(20);
    $team = Flight::teams()->getTeamWithId($id);
    $team->delete();

    Flight::redirect('/teams');
  }
}
